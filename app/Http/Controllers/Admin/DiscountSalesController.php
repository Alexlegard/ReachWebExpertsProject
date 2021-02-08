<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;
use App\Http\Requests\DiscountSaleRequest;
use Carbon\Carbon;

class DiscountSalesController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Dish $dish)
    {
        //dd("In create method.");
		
		return view('admin/myDishes/discountSales/create', [
			'dish' => $dish
		]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscountSaleRequest $request, Dish $dish)
    {
        $dish->special_price = array(
			"currency" => $request->currency,
			"amount" => $request->specialprice
		);
		$dish->on_sale = true;
		
		$duration = request('duration');
		
		if( $duration == "oneweek" ) {
			$dish->on_sale_until = Carbon::now()->addWeek();
		} else if( $duration == "twoweeks" ) {
			$dish->on_sale_until = Carbon::now()->addWeeks(2);
		} else if( $duration == "threeweeks" ) {
			$dish->on_sale_until = Carbon::now()->addWeeks(3);
		} else if( $duration == "onemonth" ) {
			$dish->on_sale_until = Carbon::now()->addMonth();
		} else if( $duration == "twomonths" ) {
			$dish->on_sale_until = Carbon::now()->addMonths(2);
		} else if( $duration == "threemonths" ) {
			$dish->on_sale_until = Carbon::now()->addMonths(3);
		}
		
		$dish->save();
		
		return redirect("admin/my-dishes/".$dish->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        $dish->on_sale = false;
		$dish->on_sale_until = null;
		$dish->save();
		
		return redirect("admin/my-dishes/".$dish->id);
    }
}
