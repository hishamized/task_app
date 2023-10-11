<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('task_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks');
            $table->foreignId('project_id')->constrained('projects');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('admin_id')->constrained('admins');
            $table->enum('status', ['Active', 'Expired', 'Redirected'])->default('Active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('task_assignments');
    }
};
