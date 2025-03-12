<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicClassesTable extends Migration
{
    public function up()
    {
        Schema::create('academic_classes', function (Blueprint $table) {
            $table->id();
            $table->string('class_name');
            $table->string('class_level');
            $table->text('class_description')->nullable();
            $table->foreignId('class_teacher_id')->nullable()->constrained('teachers');
            $table->integer('capacity')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            // ... other fields
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('academic_classes');
    }
}
