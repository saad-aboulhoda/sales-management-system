<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{

    private $permissions = [
        'category-list',
        'category-create',
        'category-edit',
        'category-delete',
        'customer-list',
        'customer-create',
        'customer-edit',
        'customer-delete',
        'invoice-list',
        'invoice-create',
        'invoice-show',
        'invoice-cancel',
        'product-list',
        'product-create',
        'product-edit',
        'product-delete',
        'purchase-list',
        'purchase-create',
        'purchase-show',
        'purchase-cancel',
        'sales-list',
        'store-list',
        'store-create',
        'store-edit',
        'store-delete',
        'supplier-list',
        'supplier-create',
        'supplier-edit',
        'supplier-delete',
        'user-list',
        'user-create',
        'user-edit',
        'user-delete',
        'settings'
    ];
    private $invoiceManagerPermissions = [
        'category-list',
        'customer-list',
        'customer-create',
        'product-list',
        'invoice-list',
        'invoice-create',
        'invoice-show',
        'invoice-cancel',
        'product-list'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminPermissions = [];
        foreach ($this->permissions as $permission) {
            $adminPermissions[] = Permission::create(['name' => $permission]);
        }
        $invoiceManagerPermissions = [];
        foreach ($this->invoiceManagerPermissions as $permission) {
            $invoiceManagerPermissions[] = Permission::findByName($permission);
        }

        $adminRole = Role::create(['name' => 'Admin']);
        $invoiceManagerRole = Role::create(['name' => 'Invoice Manager']);

        $adminRole->syncPermissions($adminPermissions);
        $invoiceManagerRole->syncPermissions($invoiceManagerPermissions);
    }
}
