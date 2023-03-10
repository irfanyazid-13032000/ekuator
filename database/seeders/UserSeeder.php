<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'uuid' => Str::uuid(),
                'name' => 'laptop',
                'email' => 'irfanyazid28@gmail.com',
                'password' => bcrypt('akucintakamu'),
                'role' => 2,
            ],
        ];

        User::insert($users);
    }
}
