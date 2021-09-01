<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      // generate 10 users.
      User::factory(10)->create();

      $this->call([
        RoomSeeder::class,
        ScheduleSeeder::class,
        ParticipantSeeder::class,
        RoleSeeder::class,
      ]);
    }
}
