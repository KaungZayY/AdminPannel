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
            'description'=>"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            'item_condition'=>'Good',
            'item_type'=>'Sell',
            'status'=>'Open',
            'owner_name'=>'John',
            'phone_number'=>'09-33-44-55',
            'address'=>'Yangon lt-33 lg-44',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
    }
}
