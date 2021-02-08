<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Traits\GetAddressStrings;

class OrdersController extends Controller
{
	use GetAddressStrings;
	
    public function list() {
		
		return view("profile/orders/list", [
			"user" => Auth()->user(),
		]);
	}
	
	public function show(Order $order) {
		
		$billing_address = $this->getBillingAddressString(Auth()->user()->profile, $order->billing_postalcode);
		$shipping_address = $this->getShippingAddressString(Auth()->user()->profile);

		//if(Auth()->user()->id != $order->user->id) {
		//	return redirect('profile/orders');
    	//}
    	$this->authorize('show', $order);
		
		return view("profile/orders/show", [
			"user" => Auth()->user(),
			"order" => $order,
			"billing_address" => $billing_address,
			"shipping_address" => $shipping_address
		]);
	}
}
