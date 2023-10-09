<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('profile_picture')->nullable();
            $table->json('full_address')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('qualification')->nullable();
            $table->string('designation')->nullable();
            $table->text('skills')->nullable();
            $table->string('status')->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->json('permissions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
