<?php

use Illuminate\Database\Seeder;
use App\Dish;

class DishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		/* For restaurant: Subway */
        Dish::create([
			'menu_id' => 1,
			'name' => 'Sweet Onion Chicken Teriyaki',
			'description' => 'Delicious chicken teriyaki with your choice of bread and toppings.',
			'slug' => 'slug',
			'price' => json_decode('{"currency":"CAD","amount":"7.99"}'),
			'special_price' => json_decode('{"currency":"CAD","amount":"5.99"}'),
			'cuisine' => 'Sandwiches',
			'calories' => 1000,
			'people_served' => 1,
			'stock' => 100,
			'is_beverage' => false,
			'is_alcoholic' => false,
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/SweetOnionChickenTeriyaki.jpg'
		]);
		
		Dish::create([
			'menu_id' => 1,
			'name' => 'Chocolate Cookie',
			'description' => 'Delicious chunky chocolate cookie.',
			'slug' => 'slug',
			'price' => json_decode('{"currency":"CAD","amount":"0.99"}'),
			'special_price' => json_decode('{"currency":"CAD","amount":"0.79"}'),
			'cuisine' => 'Dessert',
			'calories' => 100,
			'people_served' => 1,
			'stock' => 100,
			'is_beverage' => false,
			'is_alcoholic' => false,
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/chocolate-chip-cookie.jpg'
		]);
		
		Dish::create([
			'menu_id' => 1,
			'name' => 'Diet Coke',
			'description' => 'Coke, but without sugar.',
			'slug' => 'slug',
			'price' => json_decode('{"currency":"CAD","amount":"1.99"}'),
			'special_price' => json_decode('{"currency":"CAD","amount":"1.59"}'),
			'cuisine' => 'Soda',
			'calories' => 100,
			'people_served' => 1,
			'stock' => 100,
			'is_beverage' => true,
			'is_alcoholic' => false,
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/dietcoke.png'
		]);
		
		
		/* For restaurant: McDonalds */
		Dish::create([
			'menu_id' => 2,
			'name' => 'Big Mac',
			'description' => 'Mouthwatering perfection starts with two 100% pure beef patties and Big Mac sauce sandwiched between a sesame seed bun.',
			'slug' => 'slug',
			'price' => json_decode('{"currency":"CAD","amount":"7.99"}'),
			'special_price' => json_decode('{"currency":"CAD","amount":"5.99"}'),
			'cuisine' => 'Sandwiches',
			'calories' => 1000000,
			'people_served' => 1,
			'stock' => 100,
			'is_beverage' => false,
			'is_alcoholic' => false,
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/big-mac.jpg'
		]);
		
		Dish::create([
			'menu_id' => 2,
			'name' => 'Quarter Pounder',
			'description' => 'A quarter pound of 100% Canadian beef and two slices of melting processed cheddar cheese on a toasted sesame seed bun.',
			'slug' => 'slug',
			'price' => json_decode('{"currency":"CAD","amount":"7.99"}'),
			'special_price' => json_decode('{"currency":"CAD","amount":"5.99"}'),
			'cuisine' => 'Sandwiches',
			'calories' => 1000000,
			'people_served' => 1,
			'stock' => 100,
			'is_beverage' => false,
			'is_alcoholic' => false,
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/quarter-pounder.jpg'
		]);
		
		Dish::create([
			'menu_id' => 2,
			'name' => 'Coffee',
			'description' => 'Premium Roast Brewed Coffee. Brewed from 100% Arabica beans, flame-roasted for a rich, delicious full-bodied flavour – in your choice of regular or decaf.',
			'slug' => 'slug',
			'price' => json_decode('{"currency":"CAD","amount":"1.99"}'),
			'special_price' => json_decode('{"currency":"CAD","amount":"1.59"}'),
			'cuisine' => 'Coffee',
			'calories' => 100,
			'people_served' => 1,
			'stock' => 100,
			'is_beverage' => true,
			'is_alcoholic' => false,
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/mcdonalds-coffee.jpg'
		]);
		
		/* For restaurant: Tim Hortons */
		Dish::create([
			'menu_id' => 3,
			'name' => 'Coffee',
			'description' => 'There’s nothing like a fresh cup of premium coffee. That’s why starting from the day in 1964 when Tim Horton opened his fabled shop in Hamilton, Ontario, we’ve always had a fresh pot ready.',
			'slug' => 'slug',
			'price' => json_decode('{"currency":"CAD","amount":"1.99"}'),
			'special_price' => json_decode('{"currency":"CAD","amount":"1.59"}'),
			'cuisine' => 'Coffee',
			'calories' => 100,
			'people_served' => 1,
			'stock' => 100,
			'is_beverage' => true,
			'is_alcoholic' => false,
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/tim-hortons.coffee.jpg'
		]);
		
		Dish::create([
			'menu_id' => 3,
			'name' => 'BLT',
			'description' => 'BLT. Savoury bacon, tomato, lettuce and mayo served on a rustic bun.',
			'slug' => 'slug',
			'price' => json_decode('{"currency":"CAD","amount":"7.99"}'),
			'special_price' => json_decode('{"currency":"CAD","amount":"5.99"}'),
			'cuisine' => 'Sandwiches',
			'calories' => 100,
			'people_served' => 1,
			'stock' => 100,
			'is_beverage' => false,
			'is_alcoholic' => false,
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/tim-hortons-blt.png'
		]);
		
		Dish::create([
			'menu_id' => 3,
			'name' => 'Vanilla dip donut',
			'description' => 'Our donuts are sure to be the perfect complement to your cup of coffee.',
			'slug' => 'slug',
			'price' => json_decode('{"currency":"CAD","amount":"1.99"}'),
			'special_price' => json_decode('{"currency":"CAD","amount":"1.59"}'),
			'cuisine' => 'Coffee',
			'calories' => 100,
			'people_served' => 1,
			'stock' => 100,
			'is_beverage' => false,
			'is_alcoholic' => false,
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/vanilla-dip-donut.jpg'
		]);
		
		
		
		
		
		/*********************************************************** Subway test data */
		/*
		Dish::create([
			'menu_id' => 1,
			'name' => 'Dish 4',
			'description' => 'Delicious chicken teriyaki with your choice of bread and toppings.',
			'slug' => 'slug',
			'price' => json_decode('{"currency":"CAD","amount":"7.99"}'),
			'special_price' => json_decode('{"currency":"CAD","amount":"5.99"}'),
			'cuisine' => 'Sandwiches',
			'calories' => 1000,
			'people_served' => 1,
			'stock' => 100,
			'is_beverage' => false,
			'is_alcoholic' => false,
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/SweetOnionChickenTeriyaki.jpg'
		]);
		
		Dish::create([
			'menu_id' => 1,
			'name' => 'Dish 5',
			'description' => 'Delicious chicken teriyaki with your choice of bread and toppings.',
			'slug' => 'slug',
			'price' => json_decode('{"currency":"CAD","amount":"7.99"}'),
			'special_price' => json_decode('{"currency":"CAD","amount":"5.99"}'),
			'cuisine' => 'Sandwiches',
			'calories' => 1000,
			'people_served' => 1,
			'stock' => 100,
			'is_beverage' => false,
			'is_alcoholic' => false,
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/SweetOnionChickenTeriyaki.jpg'
		]);
		
		Dish::create([
			'menu_id' => 1,
			'name' => 'Dish 6',
			'description' => 'Delicious chicken teriyaki with your choice of bread and toppings.',
			'slug' => 'slug',
			'price' => json_decode('{"currency":"CAD","amount":"7.99"}'),
			'special_price' => json_decode('{"currency":"CAD","amount":"5.99"}'),
			'cuisine' => 'Sandwiches',
			'calories' => 1000,
			'people_served' => 1,
			'stock' => 100,
			'is_beverage' => false,
			'is_alcoholic' => false,
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/SweetOnionChickenTeriyaki.jpg'
		]);
		
		Dish::create([
			'menu_id' => 1,
			'name' => 'Dish 7',
			'description' => 'Delicious chicken teriyaki with your choice of bread and toppings.',
			'slug' => 'slug',
			'price' => json_decode('{"currency":"CAD","amount":"7.99"}'),
			'special_price' => json_decode('{"currency":"CAD","amount":"5.99"}'),
			'cuisine' => 'Sandwiches',
			'calories' => 1000,
			'people_served' => 1,
			'stock' => 100,
			'is_beverage' => false,
			'is_alcoholic' => false,
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/SweetOnionChickenTeriyaki.jpg'
		]);
		
		Dish::create([
			'menu_id' => 1,
			'name' => 'Dish 8',
			'description' => 'Delicious chicken teriyaki with your choice of bread and toppings.',
			'slug' => 'slug',
			'price' => json_decode('{"currency":"CAD","amount":"7.99"}'),
			'special_price' => json_decode('{"currency":"CAD","amount":"5.99"}'),
			'cuisine' => 'Sandwiches',
			'calories' => 1000,
			'people_served' => 1,
			'stock' => 100,
			'is_beverage' => false,
			'is_alcoholic' => false,
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/SweetOnionChickenTeriyaki.jpg'
		]);
		
		Dish::create([
			'menu_id' => 1,
			'name' => 'Dish 9',
			'description' => 'Delicious chicken teriyaki with your choice of bread and toppings.',
			'slug' => 'slug',
			'price' => json_decode('{"currency":"CAD","amount":"7.99"}'),
			'special_price' => json_decode('{"currency":"CAD","amount":"5.99"}'),
			'cuisine' => 'Sandwiches',
			'calories' => 1000,
			'people_served' => 1,
			'stock' => 100,
			'is_beverage' => false,
			'is_alcoholic' => false,
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/SweetOnionChickenTeriyaki.jpg'
		]);
		
		Dish::create([
			'menu_id' => 1,
			'name' => 'Dish 10',
			'description' => 'Delicious chicken teriyaki with your choice of bread and toppings.',
			'slug' => 'slug',
			'price' => json_decode('{"currency":"CAD","amount":"7.99"}'),
			'special_price' => json_decode('{"currency":"CAD","amount":"5.99"}'),
			'cuisine' => 'Sandwiches',
			'calories' => 1000,
			'people_served' => 1,
			'stock' => 100,
			'is_beverage' => false,
			'is_alcoholic' => false,
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/SweetOnionChickenTeriyaki.jpg'
		]);
		
		Dish::create([
			'menu_id' => 1,
			'name' => 'Dish 11',
			'description' => 'Delicious chicken teriyaki with your choice of bread and toppings.',
			'slug' => 'slug',
			'price' => json_decode('{"currency":"CAD","amount":"7.99"}'),
			'special_price' => json_decode('{"currency":"CAD","amount":"5.99"}'),
			'cuisine' => 'Sandwiches',
			'calories' => 1000,
			'people_served' => 1,
			'stock' => 100,
			'is_beverage' => false,
			'is_alcoholic' => false,
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/SweetOnionChickenTeriyaki.jpg'
		]);
		
		Dish::create([
			'menu_id' => 1,
			'name' => 'Dish 12',
			'description' => 'Delicious chicken teriyaki with your choice of bread and toppings.',
			'slug' => 'slug',
			'price' => json_decode('{"currency":"CAD","amount":"7.99"}'),
			'special_price' => json_decode('{"currency":"CAD","amount":"5.99"}'),
			'cuisine' => 'Sandwiches',
			'calories' => 1000,
			'people_served' => 1,
			'stock' => 100,
			'is_beverage' => false,
			'is_alcoholic' => false,
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/SweetOnionChickenTeriyaki.jpg'
		]);
		
		Dish::create([
			'menu_id' => 1,
			'name' => 'Dish 13',
			'description' => 'Delicious chicken teriyaki with your choice of bread and toppings.',
			'slug' => 'slug',
			'price' => json_decode('{"currency":"CAD","amount":"7.99"}'),
			'special_price' => json_decode('{"currency":"CAD","amount":"5.99"}'),
			'cuisine' => 'Sandwiches',
			'calories' => 1000,
			'people_served' => 1,
			'stock' => 100,
			'is_beverage' => false,
			'is_alcoholic' => false,
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/SweetOnionChickenTeriyaki.jpg'
		]);
		
		Dish::create([
			'menu_id' => 1,
			'name' => 'Dish 14',
			'description' => 'Delicious chicken teriyaki with your choice of bread and toppings.',
			'slug' => 'slug',
			'price' => json_decode('{"currency":"CAD","amount":"7.99"}'),
			'special_price' => json_decode('{"currency":"CAD","amount":"5.99"}'),
			'cuisine' => 'Sandwiches',
			'calories' => 1000,
			'people_served' => 1,
			'stock' => 100,
			'is_beverage' => false,
			'is_alcoholic' => false,
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/SweetOnionChickenTeriyaki.jpg'
		]);
		
		Dish::create([
			'menu_id' => 1,
			'name' => 'Dish 15',
			'description' => 'Delicious chicken teriyaki with your choice of bread and toppings.',
			'slug' => 'slug',
			'price' => json_decode('{"currency":"CAD","amount":"7.99"}'),
			'special_price' => json_decode('{"currency":"CAD","amount":"5.99"}'),
			'cuisine' => 'Sandwiches',
			'calories' => 1000,
			'people_served' => 1,
			'stock' => 100,
			'is_beverage' => false,
			'is_alcoholic' => false,
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/SweetOnionChickenTeriyaki.jpg'
		]);
		
		Dish::create([
			'menu_id' => 1,
			'name' => 'Dish 16',
			'description' => 'Delicious chicken teriyaki with your choice of bread and toppings.',
			'slug' => 'slug',
			'price' => json_decode('{"currency":"CAD","amount":"7.99"}'),
			'special_price' => json_decode('{"currency":"CAD","amount":"5.99"}'),
			'cuisine' => 'Sandwiches',
			'calories' => 1000,
			'people_served' => 1,
			'stock' => 100,
			'is_beverage' => false,
			'is_alcoholic' => false,
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/SweetOnionChickenTeriyaki.jpg'
		]);
		
		Dish::create([
			'menu_id' => 1,
			'name' => 'Dish 17',
			'description' => 'Delicious chicken teriyaki with your choice of bread and toppings.',
			'slug' => 'slug',
			'price' => json_decode('{"currency":"CAD","amount":"7.99"}'),
			'special_price' => json_decode('{"currency":"CAD","amount":"5.99"}'),
			'cuisine' => 'Sandwiches',
			'calories' => 1000,
			'people_served' => 1,
			'stock' => 100,
			'is_beverage' => false,
			'is_alcoholic' => false,
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/SweetOnionChickenTeriyaki.jpg'
		]);
		
		Dish::create([
			'menu_id' => 1,
			'name' => 'Dish 18',
			'description' => 'Delicious chicken teriyaki with your choice of bread and toppings.',
			'slug' => 'slug',
			'price' => json_decode('{"currency":"CAD","amount":"7.99"}'),
			'special_price' => json_decode('{"currency":"CAD","amount":"5.99"}'),
			'cuisine' => 'Sandwiches',
			'calories' => 1000,
			'people_served' => 1,
			'stock' => 100,
			'is_beverage' => false,
			'is_alcoholic' => false,
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/SweetOnionChickenTeriyaki.jpg'
		]);
		
		Dish::create([
			'menu_id' => 1,
			'name' => 'Dish 19',
			'description' => 'Delicious chicken teriyaki with your choice of bread and toppings.',
			'slug' => 'slug',
			'price' => json_decode('{"currency":"CAD","amount":"7.99"}'),
			'special_price' => json_decode('{"currency":"CAD","amount":"5.99"}'),
			'cuisine' => 'Sandwiches',
			'calories' => 1000,
			'people_served' => 1,
			'stock' => 100,
			'is_beverage' => false,
			'is_alcoholic' => false,
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/SweetOnionChickenTeriyaki.jpg'
		]);
		
		Dish::create([
			'menu_id' => 1,
			'name' => 'Dish 20',
			'description' => 'Delicious chicken teriyaki with your choice of bread and toppings.',
			'slug' => 'slug',
			'price' => json_decode('{"currency":"CAD","amount":"7.99"}'),
			'special_price' => json_decode('{"currency":"CAD","amount":"5.99"}'),
			'cuisine' => 'Sandwiches',
			'calories' => 1000,
			'people_served' => 1,
			'stock' => 100,
			'is_beverage' => false,
			'is_alcoholic' => false,
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/SweetOnionChickenTeriyaki.jpg'
		]);*/
    }
}
