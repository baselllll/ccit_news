<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Admin::truncate();
        Role::truncate();
        Schema::enableForeignKeyConstraints();
        $admin = Admin::create([
            'full_name' => 'الإدارة العامة',
            'email' => 'admin',
            'email_address' => 'super@admin.com',
            'password' => bcrypt('msaf11')
        ]);
        $role = Role::create(['name' => 'SuperAdmin','guard_name'=>'admin']);
        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $admin->assignRole([$role->id]);
    }
}
