<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Requests\CouponRequest;

class CouponsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request)
    {
        $coupon = Coupon::where('code', $request->couponcode)->first();
		
		if(! $coupon) {
			return redirect()->route('checkout.index')->withErrors(['invalidcoupon' => 'Invalid coupon code. Please try again.']);
		}
		
		session()->put('coupon', [
			'name' => $coupon->code,
			'discount' => $coupon->discount(Cart::subtotal()),
		]);

		//Cart::update($request->rowid, $request->cartquantity);
		return redirect()->route('checkout.index')->with('success_message', 'Coupon has been applied!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        session()->forget('coupon');
		
		return redirect()->route('checkout.index')->with('success_message', 'Coupon has been removed.');
    }
}
