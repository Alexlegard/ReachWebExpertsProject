<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public $casts = [
        'time_issued' => 'datetime'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function dishes()
    {
        return $this->belongsToMany(Dish::class)->withPivot('quantity');
    }

    public function dishInvoice()
    {
        return $this->belongsTo(DishInvoice::class);
    }
}
