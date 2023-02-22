<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionDashboardSeeder extends Seeder
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
                'en'=> 'getDashboardStats',
                'ar'=> 'عرض_تفاصيل الصفحة الرئيسية'
            ],

        ];

        $group_name = 'تفاصيل الصفحة الرئيسية';

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
