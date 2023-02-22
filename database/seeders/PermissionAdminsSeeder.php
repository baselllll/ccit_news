<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionAdminsSeeder extends Seeder
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
                'en'=> 'list_admin',
                'ar'=> 'عرض_المستخدمين'
            ],
            [
                'en'=> 'create_admin',
                'ar'=> 'إنشاء_المستخدمين'
            ],
            [
                'en'=> 'edit_admin',
                'ar'=> 'تعديل_المستخدمين'
            ],
            [
                'en'=> 'delete_admin',
                'ar'=> 'حذف_المستخدمين'
            ],
        ];

        $group_name = 'مستخدمين النظام';

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
