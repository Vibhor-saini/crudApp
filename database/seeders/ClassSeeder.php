<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ClassModel;
class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = ['1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th'];

        foreach ($classes as $class) {
            ClassModel::create([
                'class' => $class
            ]);
        }
    }
}
