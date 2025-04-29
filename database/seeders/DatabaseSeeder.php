<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ChapterSeeder;
use Database\Seeders\SubjectSeeder;
use Database\Seeders\UserTypeSeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\AcademicClassSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserTypeSeeder::class,
            UserSeeder::class,
            AcademicClassSeeder::class,
            DepartmentSeeder::class,
            SubjectSeeder::class,
            ChapterSeeder::class
        ]);
    }
}
