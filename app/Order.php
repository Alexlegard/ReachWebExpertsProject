<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
	use HasFactory;

	const COMMISSION = 0.20;
	
    protected $fillable = [
		'user_id', 'billing_email', 'billing_name', 'billing_streetaddress',
		'billing_streetaddresstwo', 'billing_city', 'billing_state_province',
		'billing_country', 'billing_postalcode', 'billing_name_on_card',
		'billing_subtotal', 'billing_tax', 'billing_total', 'billing_commission',
		'error', 'time_placed'
	];
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	
	public function dishes()
	{
		return $this->belongsToMany(Dish::class)->withPivot('quantity');
	}
	
	public function transaction()
	{
		return $this->belongsTo(Transaction::class);
	}
	
	public function OrderDish()
	{
		return $this->belongsTo(OrderDish::class);
	}
	
	public function sale()
	{
		return $this->hasOne(Sale::class);
	}

	public function invoices()
	{
		return $this->hasMany(Invoice::class);
	}
}
