<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'category'=>'pen',
            'status'=>1,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        DB::table('categories')->insert([
            'category'=>'mouse',
            'status'=>1,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        DB::table('categories')->insert([
            'category'=>'keyboard',
            'status'=>1,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        DB::table('categories')->insert([
            'category'=>'glass',
            'status'=>1,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        DB::table('categories')->insert([
            'category'=>'charger',
            'status'=>1,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        DB::table('categories')->insert([
            'category'=>'watch',
            'status'=>1,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
    }
}
