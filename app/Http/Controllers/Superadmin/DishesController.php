<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;
use App\Restaurant;

class DishesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$dishes = Dish::all();
		$restaurants = Restaurant::all();
		
        return view('superadmin/dishes/list', [
			'dishes' => $dishes,
			'restaurants' => $restaurants
		]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
		
        return view('superadmin/dishes/show', [
			'dish' => $dish
		]);
    }
}
