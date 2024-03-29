<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'manager', "guard_name" => "web"],
            ['name' => 'staff', "guard_name" => "web"],
            ['name' => 'customer', "guard_name" => "web"],
        ]);

    }
}
