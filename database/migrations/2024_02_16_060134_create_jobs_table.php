<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create( 'jobs', function ( Blueprint $table ) {
            $table->id();
            $table->unsignedBigInteger( 'company_id' );
            $table->foreign( 'company_id' )->references( 'id' )->on( 'companies' );

            $table->unsignedBigInteger( 'category_id' );
            $table->foreign( 'category_id' )->references( 'id' )->on( 'job_categories' );

            $table->string( 'title' );
            $table->text( 'description' );
            $table->string( 'image' );
            $table->string( 'skills' );
            $table->string('type');
            $table->string( 'salary' );
            $table->date( 'expire' );
            $table->boolean('status')->default(0);
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists( 'jobs' );
    }
};
