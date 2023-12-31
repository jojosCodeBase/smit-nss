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
            $table->string('title');
            $table->date('date');
            $table->string('from');
            $table->string('to');
            $table->string('conductedBy');
            $table->string('type');
            $table->string('area');
            $table->integer('present');
            $table->integer('absent');
            $table->string('description');
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
