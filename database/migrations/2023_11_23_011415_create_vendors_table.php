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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('username');
            $table->text('address');
            $table->string('phone');
            $table->string('image')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            // $table->foreignId('id_category')->constrained('categories');
            // $table->foreignId('id_role')->constrained('roles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
