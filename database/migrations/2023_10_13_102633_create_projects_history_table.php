<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('projects_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('admin_id');
            $table->string('action');
            $table->date('action_date')->nullable();
            $table->date('user_assignment_date')->nullable();
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('admin_id')->references('id')->on('admins');
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects_history');
    }
};
