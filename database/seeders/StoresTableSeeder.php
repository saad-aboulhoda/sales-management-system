<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stores')->insert([
            [
                'name' => 'شارع محمد الخامس',
                'status' => '1',
                'adresse' => 'المخزن الأساسي',
                'notes' => null,
            ]
        ]);
    }
}
