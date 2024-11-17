<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'f_name' => "Saad",
            'l_name' => "Aboulhoda",
            'email' => 'admin@mail.com',
            'mobile' => '0600000000',
            'password' => bcrypt('admin@mail.com'),
        ]);

        $admin->assignRole('Admin');

        $invoiceManager = User::create([
            'f_name' => "Kaoutar",
            'l_name' => "Aboulhoda",
            'email' => 'invoice.manager@mail.com',
            'mobile' => '0600000001',
            'password' => bcrypt('invoice.manager@mail.com')
        ]);

        $invoiceManager->assignRole('Invoice Manager');
    }
}
