<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialSeeder extends Seeder
{
    public function run()
    {
        DB::table('materials')->insert([
            [
                'course_id' => 1,
                'cpmk_id' => 1,
                'title' => 'Introduction to Programming',
                'description' => 'Basic concepts of programming including variables, loops, and conditions.',
                'file_path' => 'materials/programming_intro.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 1,
                'cpmk_id' => 2,
                'title' => 'Data Structures',
                'description' => 'Understanding arrays, linked lists, stacks, and queues.',
                'file_path' => 'materials/data_structures.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 2,
                'cpmk_id' => 3,
                'title' => 'Object-Oriented Programming',
                'description' => 'Concepts of OOP including classes, objects, and inheritance.',
                'file_path' => 'materials/oop_basics.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 2,
                'cpmk_id' => 2,
                'title' => 'Database Fundamentals',
                'description' => 'Introduction to relational databases and SQL queries.',
                'file_path' => 'materials/database_fundamentals.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 2,
                'cpmk_id' => 2,
                'title' => 'Web Development Basics',
                'description' => 'HTML, CSS, and JavaScript for front-end web development.',
                'file_path' => 'materials/web_dev_basics.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 2,
                'cpmk_id' => 2,
                'title' => 'Backend Development with Laravel',
                'description' => 'Building web applications using Laravel framework.',
                'file_path' => 'materials/laravel_backend.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 2,
                'cpmk_id' => 3,
                'title' => 'Software Engineering Principles',
                'description' => 'Agile methodologies, software lifecycle, and project management.',
                'file_path' => 'materials/software_engineering.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 1,
                'cpmk_id' => 3,
                'title' => 'Machine Learning Basics',
                'description' => 'Introduction to machine learning algorithms and Python libraries.',
                'file_path' => 'materials/machine_learning.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 1,
                'cpmk_id' => 3,
                'title' => 'Cybersecurity Fundamentals',
                'description' => 'Overview of cybersecurity threats and protection strategies.',
                'file_path' => 'materials/cybersecurity.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 1,
                'cpmk_id' => 3,
                'title' => 'Cloud Computing',
                'description' => 'Concepts of cloud computing and services like AWS and Azure.',
                'file_path' => 'materials/cloud_computing.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
