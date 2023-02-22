<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionGeneralSettingsSeeder extends Seeder
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
                'en'=> 'list_settings',
                'ar'=> 'عرض_الإعدادات العامة'
            ],
            [
                'en'=> 'edit_settings',
                'ar'=> 'تعديل_الإعدادات العامة'
            ],

        ];

        $group_name = 'الإعدادات العامة';

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
