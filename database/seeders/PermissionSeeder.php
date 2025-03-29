<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perms = [
            'view companies','create companies','edit companies','delete companies',
            'view users','edit users','assign roles',
            'view dashboard','view analytics',
        ];
        foreach($perms as $p){
            Permission::firstOrCreate(['name'=>$p]);
        }

        Role::firstWhere('name','superadmin')->syncPermissions(Permission::all());
        Role::firstWhere('name','admin')->syncPermissions([
            'view companies','create companies','edit companies','view dashboard'
        ]);
        Role::firstWhere('name','user')->syncPermissions(['view companies']);
    
    }
}
