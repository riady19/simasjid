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
        Schema::create('friday_schedules', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('khotib');
            $table->string('khotib_photo')->nullable();
            $table->string('imam');
            $table->string('imam_photo')->nullable();
            $table->string('bilal');
            $table->string('bilal_photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('friday_schedules');
    }
};
