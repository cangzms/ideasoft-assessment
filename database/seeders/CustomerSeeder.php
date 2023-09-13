<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'name' => 'Türker Jöntürk',
            'since' => '2014-06-28',
            'revenue' => '492.12',
        ]);

        Customer::create([
            'name' => 'Kaptan Devopuz',
            'since' => '2015-01-15',
            'revenue' => '1505.95',
        ]);

        Customer::create([
            'name' => 'İsa Sonuyumaz',
            'since' => '2016-02-11',
            'revenue' => '0.00',
        ]);
    }
}
