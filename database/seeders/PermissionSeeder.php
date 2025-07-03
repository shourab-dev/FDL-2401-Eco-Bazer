<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
           'category'=> [
                'create-category',
                'show-category',
                'edit-category',
                'delete-category',
            ],
           'product' =>[
                'create-product',
                'show-product',
                'edit-product',
                'delete-product',
            ],
           'brand'=> [
                'create-brand',
                'show-brand',
                'edit-brand',
                'delete-brand',
            ],
           'banner'=> [
                'banner-manage'
            ]
        ];


        foreach ($permissions as $key=>$permission){
            foreach($permission as $item){
                Permission::create([
                    'name' => $item,
                    'group_name' => $key
                ]);
            }
        }


    }
}
