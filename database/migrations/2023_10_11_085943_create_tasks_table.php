<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects');
            $table->foreignId('admin_id')->constrained('admins');
            $table->string('task_title');
            $table->text('task_description')->nullable();
            $table->text('task_objectives')->nullable();
            $table->date('creation_date');
            $table->date('deadline');
            $table->enum('status', ['Not Started', 'In Progress', 'Completed', 'Paused', 'Cancelled']);
            $table->enum('priority', ['High', 'Medium', 'Low']);
            $table->unsignedTinyInteger('progress')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
