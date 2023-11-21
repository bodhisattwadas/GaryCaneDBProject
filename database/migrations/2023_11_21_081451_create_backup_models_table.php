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
        Schema::create('backup_models', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('database_id');
            $table->string('file_path');
            $table->string('backup_mode');
            $table->dateTime('next_backup_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('backup_models');
    }
};
