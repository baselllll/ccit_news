<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions = [
            [
                'en'=> 'list_role',
                'ar'=> 'عرض_مجموعات الصلاحيات'
            ],
            [
                'en'=> 'create_role',
                'ar'=> 'إنشاء_مجموعات الصلاحيات'
            ],
            [
                'en'=> 'edit_role',
                'ar'=> 'تعديل_مجموعات الصلاحيات'
            ],
            [
                'en'=> 'delete_role',
                'ar'=> 'حذف_مجموعات الصلاحيات'
            ],
        ];

        $group_name = 'مجموعات الصلاحيات';

        foreach ($permissions as $key => $permission) {
            Permission::create([
                'name' => $permission['en']
                ,'name_ar' => $permission['ar']
                ,'guard_name'=>'admin'
                ,'group_name'=>$group_name
            ]);
        }
    }
}
