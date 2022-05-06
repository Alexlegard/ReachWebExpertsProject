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

    	$this->authorize('show', $order);

    	//dd($order->dishes);

    	//foreach($order->dishes as $dish) {
    	//	dd($dish->name);
    	//}
		
		return view("profile/orders/show", [
			"user" => Auth()->user(),
			"order" => $order,
			"dishes" => $order->dishes,
			"billing_address" => $billing_address,
			"shipping_address" => $shipping_address
		]);
	}
}
