<?php

namespace App\Traits;

trait GetCuisinesStrings {
	
	public function getRestaurantCuisinesString($restaurant) {
		
		//dd( $restaurant->cuisine[0] );
		
		if( isset( $restaurant->cuisine[0] )) {
			
			$restaurant_cuisines = array($restaurant->cuisine[0]);
			
			if( isset($restaurant->cuisine[1]) ) {
				array_push( $restaurant_cuisines, $restaurant->cuisine[1] );
			}
			if( isset($restaurant->cuisine[2]) ) {
				array_push( $restaurant_cuisines, $restaurant->cuisine[2] );
			}
			
			
			$restaurant_cuisines_str = implode(', ', $restaurant_cuisines);
			return $restaurant_cuisines_str;
		}
		return null;
	}
	
}