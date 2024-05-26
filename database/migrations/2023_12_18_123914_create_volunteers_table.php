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
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->integer('regno')->unique();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->integer('course')->nullable();
            // $table->foreign('course')->references('id')->on('courses');
            $table->integer('batch')->nullable();
            // $table->foreign('batch')->references('id')->on('batches');
            $table->integer('drives_participated')->default(0);
            $table->string('gender')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('category')->nullable();
            $table->string('nationality')->nullable();
            $table->string('document_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteers');
    }
};
