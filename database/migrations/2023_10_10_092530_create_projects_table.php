<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     /**
     * Run the migrations.
     *
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('admin_id')->constrained('admins');
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('start_date');
            $table->date('expected_end_date');
            $table->enum('status', ['Active', 'Inactive', 'Completed'])->default('Active');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
