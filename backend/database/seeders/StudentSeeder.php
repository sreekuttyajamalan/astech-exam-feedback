<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        Student::updateOrCreate(
            ['username' => 'john123'],
            [
                'password' => Hash::make('TestPassword123!'),
                'firstname' => 'John',
                'lastname' => 'Smith',
            ]
        );

        Student::updateOrCreate(
            ['username' => 'sreekutty_test'],
            [
                'password' => Hash::make('TestPassword123!'),
                'firstname' => 'Sreekutty',
                'lastname' => 'Test',
            ]
        );

        Student::updateOrCreate(
            ['username' => 'sarah123'],
            [
                'password' => Hash::make('TestPassword123!'),
                'firstname' => 'Sarah',
                'lastname' => 'Williams',
            ]
        );

        Student::updateOrCreate(
            ['username' => 'david123'],
            [
                'password' => Hash::make('TestPassword123!'),
                'firstname' => 'David',
                'lastname' => 'Brown',
            ]
        );
    }
}