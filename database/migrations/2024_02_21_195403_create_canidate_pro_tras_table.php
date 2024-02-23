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
        Schema::create('canidate_pro_tras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('canidate_id')->constrained('canidates')->onDelete('cascade');
            $table->string('training_name');
            $table->string('institute');
            $table->string('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canidate_pro_tras');
    }
};
