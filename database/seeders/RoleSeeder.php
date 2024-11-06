<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::Create([
            'name' => 'Admin',
        ]);

        Role::Create([
            'name' => 'User',
        ]);

        Role::Create([
            'name' => 'Initial Approver - A',
        ]);

        Role::Create([
            'name' => 'Initial Approver - B',
        ]);

        Role::Create([
            'name' => 'Final Approver - A',
        ]);

        Role::Create([
            'name' => 'Final Approver - B',
        ]);

        Role::Create([
            'name' => 'Collection Assistance',
        ]);

        Role::Create([
            'name' => 'Collection Manager',
        ]);

        Role::Create([
            'name' => 'Bonds Approver',
        ]);

        Role::Create([
            'name' => 'UW Approver',
        ]);

        Role::Create([
            'name' => 'Inventory Clerk',
        ]);

        Role::Create([
            'name' => 'Treasury Approver',
        ]);

        Role::Create([
            'name' => 'COC Approver',
        ]);

        Role::Create([
            'name' => 'COC Clerk',
        ]);
    }
}
