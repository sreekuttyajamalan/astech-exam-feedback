<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        Student::create([
            'username' => 'john123',
            'password' => Hash::make('password123'),
            'firstname' => 'John',
            'lastname' => 'Smith',
        ]);

        Student::create([
            'username' => 'sarah123',
            'password' => Hash::make('password123'),
            'firstname' => 'Sarah',
            'lastname' => 'Williams',
        ]);

        Student::create([
            'username' => 'david123',
            'password' => Hash::make('password123'),
            'firstname' => 'David',
            'lastname' => 'Brown',
        ]);
    }
}