<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\User;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $roles = ['user', 'admin'];
    $permissions = [
      'humas',
      'protocol'
    ];

    foreach ($roles as $role) {
      Role::create(['name' => $role]);
    }

    foreach ($permissions as $permission) {
      Permission::create(['name' => $permission]);
    }


    // set role in users.
    $users = User::all();

    $users->first()
      ->assignRole('user');

    $users->find(2)
      ->assignRole('admin');

    $users->find(3)
      ->assignRole('admin');

    // set permisionn in users;

    $users->find(2)
      ->syncPermissions('kominfo');

    $users->find(3)
      ->syncPermissions('humas');

    $users->find(4)
      ->syncPermissions('protocol');

  }
}
