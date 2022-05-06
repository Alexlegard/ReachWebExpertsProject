<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest;
use App\Traits\GetAddressStrings;
use App\Restaurant;
use App\OrderDish;
use App\Order;
use App\Sale;
use App\User;
use App\Invoice;
use App\DishInvoice;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe as Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;
use Carbon\Carbon;
use config;
use App\Mail\OrderPlaced;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
	use GetAddressStrings;
	
	public function index()
	{
		$user = Auth()->user();
		$profile = $user->profile;
		$intent = $this->makePaymentIntent();
		$client_secret = $intent->client_secret;
		
		/* Redirect user if cart is empty */
		if(Cart::count() == 0) {
			$restaurants = Restaurant::all();
			
			return redirect('')->with([
				'restaurants' => $restaurants
			]);
			
		}
		
		$billing_address = $this->getBillingAddressString($profile);
		$shipping_address = $this->getShippingAddressString($profile);

		return view("checkout", [
			"user"             => $user,
			"profile"          => $profile,
			"billing_address"  => $billing_address,
			"shipping_address" => $shipping_address,
			"client_secret"    => $client_secret,
			"subtotal"         => Cart::subtotal(),
			"tax"              => Cart::tax(),
			"total"            => Cart::total(),
		]);
	}
	
	public function store(CheckoutRequest $request)
	{
		// Update cart with the new coupon price
		
		$user = Auth()->user();
		$profile = $user->profile;
		$email = Auth()->user()->email;
		
		$contentsjson = Cart::content()->map(function($item) {
			return $item->qty . ' ' . $item->model->name;
		})->values()->toJson();

		$contents = Cart::content();

		

		try { // Try to create a charge
			$charge = Stripe::charges()->create([
				'amount'        => $this->getNumbers()->get('total'),
				'currency'      => 'CAD',
				'source'        => $request->stripeToken,
				'description'   => 'Order',
				'receipt_email' => $email,
				'metadata'      => [
					//Change to order ID after we start using DB
					'contents'  => $contentsjson,
					'quantity'  => Cart::instance('default')->count(),
					'discount'  => collect(session()->get('coupon'))->toJson(),
				],
			]);
			
			
			// Charge was created successfully
			// Calculate commission
			$commission = round(Cart::instance('default')->total() * Order::COMMISSION, 2);

			// Insert into orders table
			$order = Order::create([
				'user_id'                         => Auth()->user()->id,
				'billing_email'                   => $user->email,
				'billing_name'                    => $user->name,
				'billing_streetaddress'           => $request->streetaddress,
				'billing_streetaddresstwo'        => $request->streetaddresstwo ?? null,
				'billing_city'                    => $request->city,
				'billing_state_province'          => $request->stateprovince,
				'billing_country'                 => $request->country,
				'billing_name_on_card'            => $request->card_name,
				'billing_postalcode'              => $request->postal_code,
				'billing_subtotal'                => Cart::subtotal(),
				'billing_tax'                     => Cart::tax(),
				'billing_total'                   => Cart::total(),
				'billing_commission'              => $this->getNumbers()->get('commission'),
				'error'                           => null,
				'time_placed'                     => Carbon::now()
			]);
			
			// Insert into sales table
			$sale = Sale::create([
				'order_id' => $order->id
			]);
			
			// Insert into order_dish table
			foreach(Cart::content() as $item) {
				OrderDish::create([
					'order_id' => $order->id,
					'dish_id'  => $item->model->id,
					'quantity' => $item->qty
				]);
			}

			// This code should create an invoice for each admin.

			$admins = $order->dishes
				->flatMap(function ($dish) { return $dish->menu->restaurant->admins; })
				->unique('id');

			foreach($admins as $admin) {

				// WE NEED TO CALCULATE THE ADMIN SUBTOTAL
				$adminSubtotal = 0;

  				$invoice = Invoice::create([
  					'order_id'                  => $order->id,
  					'admin_id'                  => $admin->id,
  					'time_issued'               => $order->time_placed,
  					'customer_email'            => $order->billing_email,
  					'customer_name'             => $order->billing_name,
  					'customer_streetaddress'    => $order->billing_streetaddress,
  					'customer_streetaddresstwo' => $order->billing_streetaddresstwo ?? null,
  					'customer_city'             => $order->billing_city,
  					'customer_state_province'   => $order->billing_state_province,
  					'customer_country'          => $order->billing_country,
  					'customer_postalcode'       => $order->billing_postalcode,
  					'customer_name_on_card'     => $order->billing_name_on_card,
  					'subtotal'                  => $this->getInvoiceNumbers($admin)->get('subtotal'),
  					'tax'                       => $this->getInvoiceNumbers($admin)->get('tax'),
  					'total'                     => $this->getInvoiceNumbers($admin)->get('total'),
  					'commission'                => $this->getInvoiceNumbers($admin)->get('commission'),
  					'shipped'                   => false
  				]);

  				// Loop through each cart item, and if the cart item belongs to
  				// $admin, add it to the pivot table as well with the right quantity.
  				// Then add the price of the cart item to $adminSubtotal.
  				
				foreach(Cart::content() as $item) {

					if( $item->model->menu->restaurant->admins->contains($admin->id) ) {
						
						DishInvoice::create([
							'invoice_id' => $invoice->id,
							'dish_id'    => $item->model->id,
							'quantity'   => $item->qty
						]);

						$adminSubtotal += $item->price;
					}
				}

				// UPDATE $INVOICE
			}
			
			//Send email
			Mail::to( $user->email )
				->send(new OrderPlaced($order,  $contents));

			session()->forget('coupon');
			
			$thankyoumessage = 
				'Your order has been placed. Please check your email for order
				confirmation and delivery information.';

			Cart::instance('default')->destroy();

			return redirect()
				->route('thankyou')
				->with('success_message', $thankyoumessage);
			
		} catch(CardErrorException $e) {
			return back()->withErrors('Error: ' . $e->getMessage());
		}
	}
	
	public function makePaymentIntent()
	{
		// Set your secret key.
		\Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

		$intent = \Stripe\PaymentIntent::create([
		  'amount' => 1099,
		  'currency' => 'cad',
		  // Verify your integration in this guide by including this parameter
		  'metadata' => ['integration_check' => 'accept_a_payment'],
		]);
		
		return $intent;
	}
	
	// Calculate price values for the entire order.
	private function getNumbers()
	{
		$subtotal    = Cart::total();
		$tax         = config('cart.tax') / 100;
		$total       = round(($subtotal * (1 + $tax)), 2);
		$commission  = round($total * Order::COMMISSION, 2);
		
		return collect([
			'tax'        => $tax,
			'total'      => $total,
			'commission' => $commission
		]);
	}

	// Calculate price values for each merchant's invoice.
	private function getInvoiceNumbers($admin)
	{
		$subtotal = 0;

		// For each item in the cart, if it belongs to $admin,
		// add its price to the running subtotal.
		foreach(Cart::content() as $item) {

			if( $item->model->menu->restaurant->admins->contains($admin->id) ) {
				$subtotal += $item->price;
			}
		}

		$taxRate    = config('cart.tax') / 100;
		$tax        = round($subtotal * $taxRate, 2);
		$total      = $subtotal + $tax;
		$commission = round($total * Order::COMMISSION, 2);
		
		return collect([
			'subtotal'   => $subtotal,
			'tax'        => $tax,
			'total'      => $total,
			'commission' => $commission
		]);

	}
}




