<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Invoice;

class InvoicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Invoice::create([
            'order_id'                  => 1,
            'admin_id'                  => 1,
            'time_issued'               => '2020-07-13 06:13:17',
            'customer_email'            => 'alexlegard3@gmail.com',
            'customer_name'             => 'Alex Legard',
            'customer_streetaddress'    => '1234 Example Street',
            'customer_streetaddresstwo' => null,
            'customer_city'             => 'Toronto',
            'customer_state_province'   => 'Ontario',
            'customer_country'          => 'Canada',
            'customer_postalcode'       => 'q4q4q4',
            'customer_name_on_card'     => 'Alex Legard',
            'subtotal'                  => '10.97',
            'tax'                       => '1.42',
            'total'                     => '12.39',
            'commission'                => '2.48',
            'shipped'                   => false
        ]);
    }
}
