<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DishInvoice extends Model
{
    protected $table = 'dish_invoice';
    
    protected $fillable  = ['invoice_id', 'dish_id', 'quantity'];
    
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
    
    public function dish()
    {
        return $this->hasOne(Dish::class);
    }
}