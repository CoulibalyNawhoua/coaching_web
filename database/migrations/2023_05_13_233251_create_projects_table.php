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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('libelle');
            $table->string('description');
            $table->foreignId('add_by');
            $table->foreignId('edit_by');
            $table->foreignId('delete_by');
            $table->foreignId('is_deleted');
            $table->foreignId('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
