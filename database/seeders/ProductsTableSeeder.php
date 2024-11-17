<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Dadides - Ketchup',
                'model' => 'Moyenne',
                'category_id' => '1',
                'box_price' => '216',
                'box_qty' => '0',
                'qty' => '0',
                'store_id' => '1',
                'image' => '1731235282_67308dd24f79b.jpg'
            ]
        ]);
    }
}
