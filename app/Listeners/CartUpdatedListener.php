<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Coupon;

class CartUpdatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        /*
        $couponName = session()->get('coupon')['name'];
		
		if($couponName) {
			$coupon = Coupon::where('code', $couponName)->first();
			
			session()->put('coupon', [
				'name' => $coupon->code,
				'discount' => $coupon->discount(Cart::subtotal()),
			]);
		}*/
    }
}
