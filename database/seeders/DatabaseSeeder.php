<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Task;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('a11221122'),
                'role' => 'admin',
            ],
            [
                'name' => 'kasim',
                'email' => 'kasim@gmail.com',
                'password' => bcrypt('k11221122'),
                'role' => 'user',
            ],
            [
                'name' => 'ganang',
                'email' => 'ganang@gmail.com',
                'password' => bcrypt('g11221122'),
                'role' => 'user',
            ],
            [
                'name' => 'deni',
                'email' => 'deni@gmail.com',
                'password' => bcrypt('11221122'),
                'role' => 'user',
            ],
            [
                'name' => 'dewi',
                'email' => 'dewi@gmail.com',
                'password' => bcrypt('g11221122'),
                'role' => 'user',
            ],
            [
                'name' => 'kakaan',
                'email' => 'kakaan@gmail.com',
                'password' => bcrypt('k11221122'),
                'role' => 'user',
            ],
            [
                'name' => 'jannaa',
                'email' => 'jannaa@gmail.com',
                'password' => bcrypt('11221122'),
                'role' => 'user',
            ],
        ];

        DB::table('users')->insert($userData);
        
        $userIds = DB::table('users')->where('role', 'user')->pluck('id')->toArray();
        $statuses = ['to-do', 'in-progress', 'done'];

        $taskData = [
            [
                'title' => 'Belajar Laravel',
                'description' => 'Belajar Laravel',
                'status' => $statuses[array_rand($statuses)],
                'user_id' => $userIds[array_rand($userIds)],
            ],
            [
                'title' => 'Belajar React',
                'description' => 'Belajar React',
                'status' => $statuses[array_rand($statuses)],
                'user_id' => $userIds[array_rand($userIds)],
            ],
            [
                'title' => 'Belajar React',
                'description' => 'Belajar dasar React JS dan komponen.',
                'status' => $statuses[array_rand($statuses)],
                'user_id' => $userIds[array_rand($userIds)],

            ],
            [
                'title' => 'Belajar Tailwind CSS',
                'description' => 'Mengenal utility-first CSS framework.',
                'status' => $statuses[array_rand($statuses)],
                'user_id' => $userIds[array_rand($userIds)],

            ],
            [
                'title' => 'Deploy ke Hosting',
                'description' => 'Upload project Laravel ke DomaiNesia.',
                'status' => $statuses[array_rand($statuses)],
                'user_id' => $userIds[array_rand($userIds)],
            ],

        ];
    
        DB::table('tasks')->insert($taskData);
    }
}
