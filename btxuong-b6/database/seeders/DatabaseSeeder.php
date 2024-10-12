<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Classroom;
use App\Models\Passport;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Tạo lớp học
        Classroom::factory(5)->create()->each(function ($classroom) {
            // Tạo sinh viên trong mỗi lớp học
            Student::factory(10)->create(['classroom_id' => $classroom->id])->each(function ($student) {
                // Tạo hộ chiếu cho mỗi sinh viên
                Passport::factory()->create(['student_id' => $student->id]);
                
                // Gán các môn học cho sinh viên
                $subjects = Subject::factory(3)->create();
                $student->subjects()->attach($subjects->pluck('id')->toArray());
            });
        });
    }
}
