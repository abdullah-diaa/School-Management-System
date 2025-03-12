<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('students')) {
            Schema::create('students', function (Blueprint $table) {
                $table->id();
                $table->string('admission_number');
                $table->string('first_name');
                $table->string('last_name');
                $table->string('gender');
                $table->string('address');
                $table->string('phone_number');
                $table->foreignId('academic_classes_id')->constrained();
                $table->foreignId('guardians_id')->nullable()->constrained();
                $table->foreignId('user_id')->constrained();
                $table->string('profile_picture')->nullable();
                
                $table->timestamps();
            });
        }
    }
    

    public function down()
    {
        Schema::dropIfExists('students');
    }
}
