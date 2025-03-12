<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    // Inside your CreateUsersTable migration

public function up()
{
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('user_name')->unique();
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->date('date_of_birth')->nullable();
        $table->string('password');
        $table->enum('role', ['Admin', 'Student', 'Teacher'])->default('Student'); 
        $table->string('profile_picture')->nullable(); // New column for profile picture
        $table->string('region')->nullable(); 
        $table->boolean('status')->default(true);
        $table->rememberToken();
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('users');
    }
}
