<?php

namespace App\Traits;

use App\Profile;
use App\Restaurant;
use App\RestaurantApplication;

trait GetAddressStrings {
	
	/* Restaurant addresses ******************************************************/
	
	/* Accept either a Restaurant or a RestaurantApplication */
	public function getRestaurantAddressString($restaurant) {
		
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
	
	
	/* User addresses ************************************************************/
    public function getBillingAddressString(Profile $profile, $postalcode = null) {
		
		$addressSet = isset(
			$profile->billing_address['streetaddress'],
			$profile->billing_address['city'],
			$profile->billing_address['stateprovince'],
			$profile->billing_address['country']
		);
		
		if( $addressSet ) {
			$billing_address = $profile->billing_address;
			
			if( isset($postalcode) ) {
				array_push($billing_address, $postalcode);
			}
			$billing_address_str = implode(', ', $billing_address );
			
			return $billing_address_str;
		}
		return null;
	}
	
	public function getShippingAddressString(Profile $profile) {
		
		$addressSet = isset(
			$profile->shipping_address['streetaddress'],
			$profile->shipping_address['city'],
			$profile->shipping_address['stateprovince'],
			$profile->shipping_address['country']
		);
		
		if( $addressSet ) {
			
			$shipping_address = $profile->shipping_address;
			
			
			$shipping_address_str = implode(', ', $shipping_address);
			
			return $shipping_address_str;
		}
		return null;
	}
}