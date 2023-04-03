<?php

namespace Database\Seeders;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customerJsonFile = Storage::get('data/customers.json');
        $customers = json_decode($customerJsonFile);
        foreach ($customers as $customer) {

            Customer::create([
                'name' => $customer->name,
                'since' => $customer->since,
                'revenue' => $customer->revenue,
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
