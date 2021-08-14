<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


use Faker\Factory;

use App\Models\Participant;
use App\Models\Schedule;

class ParticipantSeeder extends Seeder
{

  private $faker;


  public function __construct()
  {
    $this->faker = Factory::create(env('FAKER_LOCALE'));
  }

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $schedules = Schedule::confirm()->get();
    $participants = [];
    $gender = collect(['L', 'P']);

    for ($i = 0; $i<500; $i++) {
      $participants[$i] = [
        'name' => $this->faker->name(),
        'phone_number' => $this->faker->phoneNumber(),
        'gender' => $gender->random(),
        'email' => $this->faker->unique()->safeEmail(),
        'schedule_id' => $schedules->random()->id,
        'created_at' => now()
      ];
    }


    Participant::insert($participants);
  }
}
