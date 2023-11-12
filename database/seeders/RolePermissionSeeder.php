<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Admin role
        $admin_role = Role::create(['name' => 'admin']);
           $admin = User::create([
               'name'=>'Admin',
               'email'=>'admin@gmail.com',
               'password'=>bcrypt(12345678),
           ]);
        $admin->assignRole($admin_role);
//      User role
        $user_role = Role::create(['name' => 'user']);
        $user = User::create([
            'name'=>'user',
            'email'=>'user@gmail.com',
            'password'=>bcrypt(12345678),
        ]);
        $user->assignRole($user_role);
//      co-ordinator role
        $co_ordinator_role = Role::create(['name' => 'co-ordinator']);
        $co_ordinator = User::create([
            'name'=>'co-ordinator',
            'email'=>'ordinator@gmail.com',
            'password'=>bcrypt(12345678),
        ]);
        $co_ordinator->assignRole($co_ordinator_role);
//      instructor role
        $instructor_role = Role::create(['name' => 'instructor']);
        $instructor = User::create([
            'name'=>'instructor',
            'email'=>'instructor@gmail.com',
            'password'=>bcrypt(12345678),
        ]);
        $instructor->assignRole($instructor_role);
    }
}
