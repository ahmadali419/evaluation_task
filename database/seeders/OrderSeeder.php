<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orderData = [
            ['username' => 'John','email' => 'john@mail.com','total'=>'600','note'=>'i like  this product and i wanna buy this','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['username' => 'Alex','email' => 'alex@mail.com','total'=>'200','note'=>'i like  this product and i wanna buy this','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ];
        DB::table('orders')->insert($orderData);
    }
}
