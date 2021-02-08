<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Dish;
use App\DishSelection;
use App\Http\Requests\DishSelectionsRequest;

class DishSelectionsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Dish $dish)
    {
        return view("admin/myDishes/options/create", [
			"dish" => $dish
		]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DishSelectionsRequest $request, $id)
    {
        //dd($request);
		
		// Name, options, and radio_or_checkbox
		
		$dishselection = new DishSelection;
		
		$dishselection->dish_id = $id;
		$dishselection->name = request('name');
		// Array
		//dd(array_filter(request('options')));
		$dishselection->options = array_filter(request('options'));
		$dishselection->radio_or_checkbox = request('radio_or_checkbox');
		$dishselection->save();
		//dd("Hello.");
		return redirect("admin/my-dishes/".$id);
    }
	
	public function show(DishSelection $dishselection) {
		
		$dish = $dishselection->dish;
		
		return view("admin/myDishes/options/show", [
			'selection' => $dishselection,
			'dish' => $dish
		]);
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DishSelection $dishselection)
    {
		$dish = $dishselection->dish;
		
        return view('admin/myDishes/options/edit', [
			'selection' => $dishselection,
			'dish' => $dish
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DishSelectionsRequest $request, DishSelection $dishselection)
    {
        //dd($dishselection);
		
		$dishselection->name = request('name');
		// Array
		$dishselection->options = array_filter(request('options'));
		$dishselection->radio_or_checkbox = request('radio_or_checkbox');
		$dishselection->save();
		return redirect("admin/my-selections/".$dishselection->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DishSelection $dishselection)
    {
		$id = $dishselection->dish->id;
		
        $dishselection->delete();
		
		return redirect('admin/my-dishes/'.$id);
    }
}
