<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
            'item_name'=>'Ink Pen',
            'category_id'=>1,
            'price'=>11.99,
            'description'=>"a pen",
            'item_condition'=>'Good',
            'item_type'=>'Sell',
            'status'=>1,
            'owner_name'=>'John',
            'phone_number'=>'09-33-44-55',
            'address'=>'Yangon lt-33 lg-44',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
    }
}
