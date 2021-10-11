<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Observers\RestaurantObserver;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Nicolaslopezj\Searchable\SearchableTrait;
//use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Authenticatable
{
	use SearchableTrait;
	//use Searchable;
	use HasFactory;
	
	
	protected $table = "restaurants";
	
    protected $guarded = [];
	
	
	
	public static function boot()
    {
        parent::boot();

		// Create a restaurant_page and an empty menu.
        static::created(function($restaurant) {
            $restaurant->restaurant_page()->create([
				'restaurant_id' => $restaurant->id,
				'tag' => 'Uncategorised'
			]);
			
			$restaurant->menu()->create([
				'restaurant_id' => $restaurant->id
			]);
        });
		
		// Later, also delete  the corresponding restaurant application
		// in the database.
    }
	
	protected $casts = [
         'address' => 'array',
		 'cuisine' => 'array',
    ];
	
	/**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'restaurants.name' => 10,
			'restaurants.description' => 5
        ],
   
    ];
	
	public function review()
	{
		return $this->hasMany(Review::class);
	}
	
	public function Restaurant_page()
	{
		return $this->hasOne(Restaurant_page::class);
	}
	
	public function menu()
	{
		return $this->hasOne(Menu::class);
	}
	
	public function admins()
	{
		return $this->belongsToMany(Admin::class);
	}
	
	public function AdminRestaurant()
	{
		return $this->belongsTo(AdminRestaurant::class);
	}
	
	public function favorited()
	{
		return $this->belongsToMany(User::class, 'favorites');
	}
}




