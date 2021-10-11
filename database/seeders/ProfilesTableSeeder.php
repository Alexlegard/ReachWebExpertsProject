<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Profile;
use App\User;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * User profiles are created as the user is created. Here I just change the billing and shipping address.
     * 
     * @return void
     */
    public function run()
    {
        $user = User::find(1);
        $user->profile->billing_address = ["streetaddress" => "1234 Example Street", "city" => "Toronto", "stateprovince" => "Ontario", "country" => "Canada",];
        $user->profile->shipping_address = ["streetaddress" => "1234 Example Street", "city" => "Toronto", "stateprovince" => "Ontario", "country" => "Canada",];
        $user->profile->save();
    }
}
