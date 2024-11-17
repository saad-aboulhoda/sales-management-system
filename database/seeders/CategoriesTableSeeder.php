<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            ['name' => 'Yaourt', 'image' => '1730893827_672b58034a65a.jpg', 'slug' => 'yaourt', 'status' => '1'],
            ['name' => 'Sauce', 'image' => '1730899166_672b6cde23597.jpg', 'slug' => 'sauce', 'status' => '1'],
            ['name' => 'Boisson', 'image' => '1730899197_672b6cfd99194.jpg', 'slug' => 'boisson', 'status' => '1'],
            ['name' => 'Petfood', 'image' => '1730899219_672b6d13ec257.jpeg', 'slug' => 'petfood', 'status' => '1'],
            ['name' => 'Chocolat', 'image' => '1730899243_672b6d2b1a32e.jpg', 'slug' => 'chocolat', 'status' => '1'],
            ['name' => 'Pates', 'image' => '1730899275_672b6d4b09b88.jpg', 'slug' => 'pates', 'status' => '1'],
            ['name' => 'Riz', 'image' => '1730899345_672b6d91e3e63.webp', 'slug' => 'riz', 'status' => '1'],
            ['name' => 'Tuna', 'image' => '1730899361_672b6da1a84ee.jpg', 'slug' => 'tuna', 'status' => '1'],
            ['name' => 'Café', 'image' => '1730899497_672b6e291d77e.jpg', 'slug' => 'café', 'status' => '1']
        ]);
    }
}
