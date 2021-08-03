<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $rooms = [
        [
          'name' => 'darwin',
          'created_at' => now()
        ],
        [
          'name' => 'vsiligen',
          'created_at' => now()
        ]
      ];


      Room::insert($rooms);
    }
}
