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
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->integer('regno')->nullable;
            $table->unsignedBigInteger('drive_id')->nullable;
            // making regno and drive as primary key
            $table->unique(['regno', 'drive_id']);
            $table->foreign('drive_id')->references('id')->on('drives');
            $table->foreign('regno')->references('regno')->on('volunteers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
