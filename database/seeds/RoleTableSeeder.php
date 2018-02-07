<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
class RoleTableSeeder extends Seeder
{
  public function run()
  {
    $role_admin = new Role();
    $role_admin->name = 'admin';
    $role_admin->description = 'Admin User';
    $role_admin->save();

    $role_editor = new Role();
    $role_editor->name = 'editor';
    $role_editor->description = 'Editor User';
    $role_editor->save();

    $role_author = new Role();
    $role_author->name = 'author';
    $role_author->description = 'Author User';
    $role_author->save();

    $role_subscriber = new Role();
    $role_subscriber->name = 'subscriber';
    $role_subscriber->description = 'Subscriber User';
    $role_subscriber->save();
  }
}
