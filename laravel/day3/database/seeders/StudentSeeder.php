<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\User;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        $students = [
            ['name' => 'Ali', 'email' => 'ali@gmail.com', 'user_id' => $user?->id],
            ['name' => 'Abdelrahman', 'email' => 'abdelrahman@gmail.com', 'user_id' => $user?->id],
            ['name' => 'Hassan', 'email' => 'hassan@gmail.com', 'user_id' => $user?->id],
            ['name' => 'Mohammed', 'email' => 'mohammed@gmail.com', 'user_id' => $user?->id],
        ];

        foreach ($students as $s) {
            Student::updateOrCreate(['email' => $s['email']], $s);
        }
    }
}
