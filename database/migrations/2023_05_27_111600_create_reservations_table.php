<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('comment');
            $table->dateTime('date');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('address');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->foreignIdFor(User::class)->nullable();
            $table->foreignIdFor(User::class, 'created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
