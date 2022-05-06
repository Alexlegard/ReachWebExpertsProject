<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Dish extends Model
{
	use HasFactory;

	protected $guarded = [];
	
	protected $casts = [
         'price' => 'array',
		 'special_price' => 'array',
    ];
	
	public function menu()
	{
		return $this->belongsTo(Menu::class);
	}
	
	public function orders()
	{
		return $this->belongsToMany(Order::class);
	}

	public function orderDish()
    {
        return $this->belongsTo(OrderDish::class);
    }
	
	public function selections()
	{
		return $this->hasMany(DishSelection::class);
	}

	public function invoices()
	{
		return $this->hasMany(Invoice::class);
	}

	public function dishInvoice()
    {
        return $this->belongsTo(DishInvoice::class);
    }
}