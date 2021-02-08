<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartsController extends Controller
{
    public function show(Cart $cart)
	{
		return view("cart", [
			'cart' => $cart,
			
		]);
	}
	
	public function store(Request $request)
	{
		Cart::add($request->id, $request->name, $request->quantity, $request->price)
			->associate('App\Dish');
		
		$success_message = 'Item was added to your cart!';
		
		return view("cart", [
			'success_message' => $success_message 
		]);
	}
	
	public function updatequantity(Request $request)
	{
		Cart::update($request->rowid, $request->cartquantity);
		
		$success_message = 'Item quantity updated!';
		
		return view("cart", [
			'success_message' => $success_message 
		]);
	}
	
	public function destroy($id)
	{
		Cart::remove($id);
		
		$success_message = "Item has been removed!";
		
		return view("cart", [
			'success_message' => $success_message
		]);
	}
	
	public function empty()
	{
		Cart::destroy();
	}
}
