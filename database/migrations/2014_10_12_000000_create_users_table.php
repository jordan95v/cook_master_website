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
        Schema::create('users', function (Blueprint $table) {
            // Basic info
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string("image")->nullable();

            // Manage roles
            $table->boolean("is_banned")->default(0);
            $table->boolean("is_service_provider")->default(0);
            $table->integer("role")->default(0);

            // Godfather management
            $table->string("key")->nullable();
            $table->integer("key_used")->default(0);
            $table->string("godfather_key")->nullable();
            $table->boolean("had_discount")->default(0);

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
