<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicClassSubjectTable extends Migration
{
    public function up()
    {
        Schema::create('academic_class_subject', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('academic_class_id');
            $table->unsignedBigInteger('subject_id');
            // Add any additional columns needed for the relationship here
 
            $table->foreign('academic_class_id')->references('id')->on('academic_classes')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->timestamps();
            
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('academic_class_subject');
    }
}
