<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Users
        // DB::table('users')->insert([
        //     ['id' => 1, 'name' => 'Sarah Connor', 'email' => 'sarah.admin@school.com', 'role' => 'admin'],
        //     ['id' => 2, 'name' => 'John Keating', 'email' => 'keating.teacher@school.com', 'role' => 'teacher'],
        //     ['id' => 3, 'name' => 'Minerva McGonagall', 'email' => 'mcgonagall.teacher@school.com', 'role' => 'teacher'],
        //     ['id' => 4, 'name' => 'Peter Parker', 'email' => 'peter.student@school.com', 'role' => 'student'],
        //     ['id' => 5, 'name' => 'Hermione Granger', 'email' => 'hermione.student@school.com', 'role' => 'student'],
        // ]);

        // 2. Profiles (1-to-1)
        DB::table('profiles')->insert([
            ['user_id' => 1, 'phone' => '+1234567890', 'bio' => 'Head Admin & Coordinator', 'address' => '123 School Rd'],
            ['user_id' => 2, 'phone' => '+1987654321', 'bio' => 'English & Philosophy Teacher', 'address' => '456 Poetry Ln'],
            ['user_id' => 3, 'phone' => '+1122334455', 'bio' => 'Head of Science Department', 'address' => '789 Science Way'],
            ['user_id' => 4, 'phone' => '+1555666777', 'bio' => 'High school senior with great responsibility', 'address' => '20 Ingram St'],
            ['user_id' => 5, 'phone' => '+1999888777', 'bio' => 'Top student of class 2026', 'address' => '10 Gryffindor Tower'],
        ]);

        // 3. Teachers & Students
        DB::table('teachers')->insert([
            ['id' => 1, 'user_id' => 2, 'employee_code' => 'EMP-001', 'specialization' => 'Literature'],
            ['id' => 2, 'user_id' => 3, 'employee_code' => 'EMP-002', 'specialization' => 'Advanced Physics'],
        ]);

        // DB::table('students')->insert([
        //     ['id' => 1, 'user_id' => 4, 'roll_number' => 'STU-1001', 'grade_level' => 12],
        //     ['id' => 2, 'user_id' => 5, 'roll_number' => 'STU-1002', 'grade_level' => 12],
        // ]);

        // 4. Classrooms & Subjects
        DB::table('classrooms')->insert([
            ['id' => 1, 'name' => 'Grade 12 Alpha', 'room_number' => 'Room 301'],
            ['id' => 2, 'name' => 'Lab Beta', 'room_number' => 'Room 102'],
        ]);

        DB::table('subjects')->insert([
            ['id' => 1, 'name' => 'English Literature', 'code' => 'ENG101'],
            ['id' => 2, 'name' => 'Physics', 'code' => 'PHY201'],
        ]);

        // 5. Courses
        DB::table('courses')->insert([
            ['id' => 1, 'teacher_id' => 1, 'subject_id' => 1, 'classroom_id' => 1, 'academic_year' => '2026-2027'],
            ['id' => 2, 'teacher_id' => 2, 'subject_id' => 2, 'classroom_id' => 2, 'academic_year' => '2026-2027'],
        ]);

        // Pivot: Course Enrollments (Many-to-Many)
        DB::table('course_student')->insert([
            ['course_id' => 1, 'student_id' => 1],
            ['course_id' => 1, 'student_id' => 2],
            ['course_id' => 2, 'student_id' => 2],
        ]);

        // Results
        DB::table('results')->insert([
            ['student_id' => 1, 'course_id' => 1, 'marks_obtained' => 88.50, 'grade' => 'A'],
            ['student_id' => 2, 'course_id' => 1, 'marks_obtained' => 99.00, 'grade' => 'A+'],
            ['student_id' => 2, 'course_id' => 2, 'marks_obtained' => 100.00, 'grade' => 'A+'],
        ]);

        // 6. Morph One Data
        DB::table('activity_logs')->insert([
            ['loggable_type' => 'App\Models\User', 'loggable_id' => 4, 'action' => 'Updated profile picture'],
            ['loggable_type' => 'App\Models\Course', 'loggable_id' => 1, 'action' => 'Course syllabus published'],
        ]);

        // 7. Morph Many Data
        DB::table('comments')->insert([
            ['commentable_type' => 'App\Models\Teacher', 'commentable_id' => 1, 'body' => 'Great teaching style, very inspiring!', 'author_id' => 4],
            ['commentable_type' => 'App\Models\Subject', 'commentable_id' => 2, 'body' => 'This curriculum requires advanced calculus background.', 'author_id' => 3],
        ]);
    }
}