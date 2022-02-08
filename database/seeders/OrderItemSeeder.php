<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orderItemData = [
            ['order_id' => '1','product_id' => '1','price'=>'200','qty'=>'2','total'=>'400','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['order_id' => '1','product_id' => '2','price'=>'200','qty'=>'1','total'=>'200','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            
            ['order_id' => '2','product_id' => '2','price'=>'200','qty'=>'1','total'=>'200','created_at' => Carbon::now()->format('Y-m-d H:i:s'),'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ];
        DB::table('order_items')->insert($orderItemData);
    }
}
