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
        Schema::create('drives', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('title')->nullable();
            $table->date('date')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('conductedBy')->nullable();
            $table->string('updatedBy')->nullable();
            $table->string('type')->nullable();
            $table->string('area')->nullable();
            $table->integer('present')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drives');
    }
};
