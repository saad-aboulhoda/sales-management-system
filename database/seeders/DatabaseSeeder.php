<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    private $sedders = [
        RolesTableSeeder::class,
        UsersTableSeeder::class,
        CategoriesTableSeeder::class,
        CustomersTableSeeder::class,
        StoresTableSeeder::class,
        SuppliersTableSeeder::class,
        ProductsTableSeeder::class,
        SettingsTableSeeder::class
    ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach ($this->sedders as $sedder) {
            $this->call($sedder);
        }
    }
}
