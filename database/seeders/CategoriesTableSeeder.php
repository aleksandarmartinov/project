<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Automobili', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Alati i orudja', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Mobilni Telefoni', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Kolekcionarstvo', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'Tehnika', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'name' => 'Muzika i instrumenti', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
    
}
