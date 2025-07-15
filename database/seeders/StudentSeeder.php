<?php

namespace Database\Seeders;

use App\Models\Student;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Student::factory()->count(15)->create();
        // Student::insert([
        //     [
        //         'name' => 'Alice Johnson',
        //         'email' => 'alice.johnson@example.com',
        //         'dob' => '2003-06-15',
        //         'gender' => 'Female',
        //         'country' => 'USA',
        //         'skills' => 'marketing, design, programming',
        //         'image' => 'alice.jpg',
        //     ],
        //     [
        //         'name' => 'Bob Smith',
        //         'email' => 'bob.smith@example.com',
        //         'dob' => '2002-11-02',
        //         'gender' => 'Male',
        //         'country' => 'Canada',
        //         'skills' => 'programming',
        //         'image' => 'bob.jpg',
        //     ],
        //     [
        //         'name' => 'Catherine Lee',
        //         'email' => 'catherine.lee@example.com',
        //         'dob' => '2001-04-28',
        //         'gender' => 'Female',
        //         'country' => 'UK',
        //         'skills' => 'design',
        //         'image' => 'catherine.jpg',
        //     ],
        //     [
        //         'name' => 'David Chen',
        //         'email' => 'david.chen@example.com',
        //         'dob' => '2000-12-10',
        //         'gender' => 'Male',
        //         'country' => 'China',
        //         'skills' => 'marketing',
        //         'image' => 'david.jpg',
        //     ],
        //     [
        //         'name' => 'Emma García',
        //         'email' => 'emma.garcia@example.com',
        //         'dob' => '2004-08-07',
        //         'gender' => 'Female',
        //         'country' => 'Spain',
        //         'skills' => 'design',
        //         'image' => 'emma.jpg',
        //     ],
        //     [
        //         'name' => 'Farhan Ahmed',
        //         'email' => 'farhan.ahmed@example.com',
        //         'dob' => '2001-03-19',
        //         'gender' => 'Male',
        //         'country' => 'Pakistan',
        //         'skills' => 'marketing',
        //         'image' => 'farhan.jpg',
        //     ],
        //     [
        //         'name' => 'Grace Kim',
        //         'email' => 'grace.kim@example.com',
        //         'dob' => '2002-09-23',
        //         'gender' => 'Female',
        //         'country' => 'South Korea',
        //         'skills' => 'design',
        //         'image' => 'grace.jpg',
        //     ],
        // ]);
    }
}
