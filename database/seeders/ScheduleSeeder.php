<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Room;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $users = User::all();
      $rooms = Room::all();


      $schedules = [
        // pending.
        [
          'title' => 'Pembangkitan UMKM bagi anak muda Maluku',
          'desc' => 'ini deskripsi 1',
          'slug' => 'pembangkitan-ukm',
          'started_at' => now(),
          'ended_at' => now()->addHours(2),
          'status' => 'pending',
          'room_id' => $rooms->random()->id,
          'user_id' => $users->random()->id,
          'max_capacity' => random_int(10, 100),
          'created_at' => now()
        ],
        [
          'title' => 'Membangkitkan semangat anak muda Maluku dengan Teknologi Informasi',
          'desc' => 'ini deskripsi 2',
          'slug' => 'membangkitkan-semangat-anak-muda',
          'started_at' => now()->addDay(1),
          'ended_at' => now()->addDay(1)->addHours(2),
          'status' => 'pending',
          'room_id' => $rooms->random()->id,
          'user_id' => $users->random()->id,
          'max_capacity' => random_int(10, 100),
          'created_at' => now()
        ],
        [
          'title' => 'Mendeskripsikan kemajuan sekolah indonesia',
          'desc' => 'ini deskripsi 3',
          'slug' => 'mendeskripsikan-kemajuan-sekolah',
          'started_at' => now()->addHours(3),
          'ended_at' => now()->addHours(5),
          'status' => 'pending',
          'room_id' => $rooms->random()->id,
          'user_id' => $users->random()->id,
          'max_capacity' => random_int(10, 100),
          'created_at' => now()
        ],

        // confirm.
        [
          'title' => 'Ambon menuju Smart City',
          'slug' => 'ambon-menuju-smart-city',
          'desc' => 'ini deskripsi 4',
          'started_at' => now()->addDay(1)->addHours(3),
          'ended_at' => now()->addDay(1)->addHours(5),
          'status' => 'confirm',
          'room_id' => $rooms->random()->id,
          'user_id' => $users->random()->id,
          'max_capacity' => random_int(10, 100),
          'created_at' => now()
        ],
        [
          'title' => 'Membahas kemajuan sekolah dengan Teknologi',
          'desc' => 'ini deskripsi 5',
          'slug' => 'membahas-kemajuan-sekolah-dengan-teknologi',
          'started_at' => now()->addHours(8),
          'ended_at' => now()->addHours(10),
          'status' => 'confirm',
          'room_id' => $rooms->random()->id,
          'user_id' => $users->random()->id,
          'max_capacity' => random_int(10, 100),
          'created_at' => now()
        ],
      ];

      Schedule::insert($schedules);
    }
}
