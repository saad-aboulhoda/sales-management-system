<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            [
                'option_name' => 'Name',
                'option_value' => '',
            ],
            [
                'option_name' => 'Logo',
                'option_value' => '',
            ],
            [
                'option_name' => 'Phone number',
                'option_value' => '',
            ],
            [
                'option_name' => 'Email',
                'option_value' => '',
            ],
            [
                'option_name' => 'Address',
                'option_value' => '',
            ],
        ]);
    }
}
