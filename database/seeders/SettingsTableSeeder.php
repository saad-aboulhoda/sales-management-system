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
                'option_name' => 'name',
                'option_value' => '',
            ],
            [
                'option_name' => 'logo',
                'option_value' => '',
            ],
            [
                'option_name' => 'phone_number',
                'option_value' => '',
            ],
            [
                'option_name' => 'email',
                'option_value' => '',
            ],
            [
                'option_name' => 'address',
                'option_value' => '',
            ],
        ]);
    }
}
