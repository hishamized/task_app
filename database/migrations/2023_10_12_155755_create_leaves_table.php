<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Assuming you want to associate leaves with users
            $table->date('start_date');
            $table->date('end_date');
            $table->string('subject');
            $table->text('reason');
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users'); // Assuming you have a "users" table
        });
    }

    public function down()
    {
        Schema::dropIfExists('leaves');
    }
};
