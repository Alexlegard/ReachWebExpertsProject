<?php

use Carbon\Carbon;

/* Presents the restaurant's address in a readable string */
function getAddress($restaurant) {
	
	$addressSet = isset(
		$restaurant->address['streetaddress'],
		$restaurant->address['city'],
		$restaurant->address['stateprovince'],
		$restaurant->address['country']
	);
	if($addressSet) {
		$restaurant_address = implode(', ', $restaurant->address);
		return $restaurant_address;
	}
	return null;
}

/* Presents the price in a readable string */
function presentPrice($price)
{
    if ($price<0) return "-".asDollars(-$price);
	return '$' . number_format($price, 2);
}

/* Return the user's billing address in a readable string */
function getBillingAddress($user) {

	$addressSet = isset(
		$user->profile->billing_address['streetaddress'],
		$user->profile->billing_address['city'],
		$user->profile->billing_address['stateprovince'],
		$user->profile->billing_address['country']
	);

	if($addressSet) {
		$billing_address = implode(', ', $user->profile->billing_address);
		return $billing_address;
	}

	return 'Not set';
}

/* Return the user's shipping address in a readable string */
function getShippingAddress($user) {

	$addressSet = isset(
		$user->profile->shipping_address['streetaddress'],
		$user->profile->shipping_address['city'],
		$user->profile->shipping_address['stateprovince'],
		$user->profile->shipping_address['country']
	);

	if($addressSet) {
		$shipping_address = implode(', ', $user->profile->shipping_address);
		return $shipping_address;
	}
	
	return 'Not set';
}

/* Return the order's billing address in a readable string */
function getOrderBillingAddress($order) {

	$billing_address = implode(', ', [
		$order->billing_streetaddress,
		$order->billing_city,
		$order->billing_state_province,
		$order->billing_country
	]);
}