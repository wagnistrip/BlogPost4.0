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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastName');
            $table->string('email');
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('avtar')->nullable();
            $table->string('gender')->nullable();
            $table->integer('otp')->nullable();
            $table->string('role')->nullable();
            $table->string('plen_pass')->nullable();
            $table->boolean('status')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
