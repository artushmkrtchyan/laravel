<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
class UserTableSeeder extends Seeder
{
  public function run()
  {
    $role_admin = Role::where('name', 'admin')->first();
    $admin = new User();
    $admin->name = 'Admin';
    $admin->email = 'admin@admin.com';
    $admin->password = bcrypt('admin123');
    $admin->save();
    $admin->roles()->attach($role_admin);
  }
}
