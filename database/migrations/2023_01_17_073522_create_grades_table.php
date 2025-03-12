<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration
{
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students');
            $table->string('student_name');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->decimal('grade', 5, 2); // Assuming a decimal grading system with up to 5 digits and 2 decimal places
            $table->text('remark')->nullable();
            $table->foreignId('academic_class_id')->constrained('academic_classes');
            $table->enum('period', ['1stmonth', '2ndmonth', 'midterm', '3rdmonth','4thmonth','finalexam']);
            $table->timestamps();

            // Add unique constraint to prevent duplicate entries for the same student, subject, academic class, and period
            $table->unique(['student_id', 'subject_id', 'academic_class_id', 'period']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('grades');
    }
}
