<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. BASE USERS
        // Schema::create('users', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->string('email')->unique();
        //     $table->enum('role', ['admin', 'teacher', 'student']);
        //     $table->timestamp('created_at')->useCurrent();
        // });

        // 2. ONE-TO-ONE PROFILE
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('phone', 50)->nullable();
            $table->text('bio')->nullable();
            $table->string('address')->nullable();
            
        });

        // 3. SPECIFIC ENTITIES
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('employee_code', 50)->unique();
            $table->string('specialization', 100)->nullable();
        });

        // Schema::create('students', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
        //     $table->string('roll_number', 50)->unique();
        //     $table->integer('grade_level');
        // });

        // 4. CLASSROOMS & SUBJECTS
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('room_number', 50);
        });

        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('code', 20)->unique();
        });

        // COURSES
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->foreignId('classroom_id')->constrained()->cascadeOnDelete();
            $table->string('academic_year', 20);
        });

        // 5. MANY-TO-MANY PIVOT (Student <-> Course)
        Schema::create('course_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->timestamp('enrolled_at')->useCurrent();
        });

        // RESULTS
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->decimal('marks_obtained', 5, 2);
            $table->string('grade', 5);
        });

        // 6. POLYMORPHIC ONE-TO-ONE (Activity Logs)
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->morphs('loggable'); // Automatically creates loggable_type & loggable_id
            $table->string('action');
            $table->timestamp('created_at')->useCurrent();
        });

        // 7. POLYMORPHIC ONE-TO-MANY (Comments)
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->morphs('commentable'); // Automatically creates commentable_type & commentable_id
            $table->text('body');
            $table->foreignId('author_id')->constrained('users')->cascadeOnDelete();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('results');
        Schema::dropIfExists('course_student');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('classrooms');
        Schema::dropIfExists('students');
        Schema::dropIfExists('teachers');
        Schema::dropIfExists('profiles');
        Schema::dropIfExists('users');
    }
};