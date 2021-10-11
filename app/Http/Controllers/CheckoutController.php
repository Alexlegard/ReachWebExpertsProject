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
			"newSubtotal"      => $this->getNumbers()->get('newSubtotal'),
			"newTax"           => $this->getNumbers()->get('newTax'),
			"newTotal"         => $this->getNumbers()->get('newTotal'),
		]);
	}
	
	public function store(CheckoutRequest $request)
	{
		//Update cart with the new coupon price
		
		$user = Auth()->user();
		$profile = $user->profile;
		$email = Auth()->user()->email;
		
		$contents = Cart::content()->map(function($item) {
			return $item->model->description . ', ' . $item->qty;
		})->values()->toJson();
		
		try {
			$charge = Stripe::charges()->create([
				'amount'        => $this->getNumbers()->get('newTotal'),
				'currency'      => 'CAD',
				'source'        => $request->stripeToken,
				'description'   => 'Order',
				'receipt_email' => $email,
				'metadata'      => [
					//Change to order ID after we start using DB
					'contents'  => $contents,
					'quantity'  => Cart::instance('default')->count(),
					'discount'  => collect(session()->get('coupon'))->toJson(),
				],
			]);
			
			// SUCCESSFUL
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
				'billing_subtotal'                => Cart::instance('default')->subtotal(),
				'billing_subtotal_after_discount' => $this->getNumbers()->get('newSubtotal'),
				'billing_tax'                     => $this->getNumbers()->get('newTax'),
				'billing_total'                   => $this->getNumbers()->get('newTotal'),
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
			
			//Send email
			Mail::to( $user->email )
				->send(new OrderPlaced($order));

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
		// Set your secret key. Remember to switch to your live secret key in production!
		// See your keys here: https://dashboard.stripe.com/account/apikeys
		\Stripe\Stripe::setApiKey('sk_test_51GzYZgEwovnXVY3jx87gzOr7x4BbnxyA0wi6Ewh8VJk9bX4VhN9LO2XepK8t69MxiYXugaRZS1fuLSxT3yW6qavA00dTKiOp7z');

		$intent = \Stripe\PaymentIntent::create([
		  'amount' => 1099,
		  'currency' => 'cad',
		  // Verify your integration in this guide by including this parameter
		  'metadata' => ['integration_check' => 'accept_a_payment'],
		]);
		
		return $intent;
	}
	
	private function getNumbers()
	{
		/* Calculate price values, taking into account
		the coupon if there is one.*/
		$tax         = config('cart.tax') / 100;
		$discount    = session()->get('coupon')['discount'] ?? 0;
		$newSubtotal = (Cart::subtotal() - $discount);
		if($newSubtotal < 0) {
			$newSubtotal = 0;
		}
		$newTax     = round(($newSubtotal * $tax), 2);
		$newTotal   = round(($newSubtotal * (1 + $tax)), 2);
		$commission = round($newTotal * Order::COMMISSION, 2);
		
		return collect([
			'tax'         => $tax,
			'discount'    => $discount,
			'newSubtotal' => $newSubtotal,
			'newTax'      => $newTax,
			'newTotal'    => $newTotal,
			'commission'  => $commission
		]);
	}
}




