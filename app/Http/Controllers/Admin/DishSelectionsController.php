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
     * Show the form for creating a new DishSelection.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Dish $dish)
    {
        $restaurant = $dish->menu->restaurant;

        $this->authorize('owns-restaurant', $restaurant);

        return view("admin/myDishes/options/create", [
			"dish" => $dish
		]);
    }

    /**
     * Store a newly created DishSelection in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DishSelectionsRequest $request, $id)
    {	
		// Name, options, and radio_or_checkbox
		$ds = new DishSelection;
		$ds->dish_id = $id;
		$ds->name = request('name');
		$ds->options = array_filter(request('options'));
		$ds->radio_or_checkbox = request('radio_or_checkbox');
		$ds->save();
		return redirect("admin/my-dishes/".$ds->dish_id);
    }
	
	public function show(DishSelection $dishselection) {
		
        $restaurant = $dishselection->dish->menu->restaurant;

        $this->authorize('owns-restaurant', $restaurant);

		$dish = $dishselection->dish;
		
		return view("admin/myDishes/options/show", [
			'selection' => $dishselection,
			'dish' => $dish
		]);
	}

    /**
     * Show the form for editing the specified DishSelection.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DishSelection $dishselection)
    {
        $restaurant = $dishselection->dish->menu->restaurant;

        $this->authorize('owns-restaurant', $restaurant);

		$dish = $dishselection->dish;
		
        return view('admin/myDishes/options/edit', [
			'selection' => $dishselection,
			'dish' => $dish
		]);
    }

    /**
     * Update the specified DishSelection in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DishSelectionsRequest $request, DishSelection $dishselection)
    {
        $restaurant = $dishselection->dish->menu->restaurant;

        $this->authorize('owns-restaurant', $restaurant);
		
		$dishselection->name = request('name');
		// Array
		$dishselection->options = array_filter(request('options'));
		$dishselection->radio_or_checkbox = request('radio_or_checkbox');
		$dishselection->save();
		return redirect("admin/my-selections/".$dishselection->id);
    }

    /**
     * Remove the specified DishSelection from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DishSelection $dishselection)
    {
        $restaurant = $dishselection->dish->menu->restaurant;

        $this->authorize('owns-restaurant', $restaurant);
        
		$id = $dishselection->dish->id;
		
        $dishselection->delete();
		
		return redirect('admin/my-dishes/'.$id);
    }
}
