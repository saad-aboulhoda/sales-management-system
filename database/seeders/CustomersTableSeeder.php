<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            [
                'name' => 'الزبون الأول',
                'mobile' => '0601020304',
                'address' => 'شارع محمد الخامس',
                'email' => 'customer@mail.com',
                'notes' => null
            ]
        ]);
    }
}
