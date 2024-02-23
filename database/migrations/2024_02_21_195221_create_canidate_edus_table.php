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
        Schema::create('canidate_edus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('canidate_id')->constrained('canidates')->onDelete('cascade');
            $table->string('degree');
            $table->string('institute');
            $table->string('passing_year');
            $table->string('department');
            $table->string('result');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canidate_edus');
    }
};
