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
        Schema::create('database_storages', function (Blueprint $table) {
            $table->id();
            $table->string('database_name');
            $table->string('database_username');
            $table->string('database_password');
            $table->string('database_host');
            $table->string('database_tag')->nullable();
            $table->string('database_description')->nullable();
            $table->integer('database_backup_interval')->default(24)->unsigned();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('database_storages');
    }
};
