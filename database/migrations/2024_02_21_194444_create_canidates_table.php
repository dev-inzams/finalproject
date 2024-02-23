<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('canidates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('date_of_birth');
            $table->string('blood_group');
            $table->string('Social_id')->unique();
            $table->string('Passport_id')->unique();
            $table->string('cell_no');
            $table->string('emergency_no');
            $table->string('linkedin');
            $table->string('facebook');
            $table->string('github');
            $table->string('portfolio_link');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canidates');
    }
};
