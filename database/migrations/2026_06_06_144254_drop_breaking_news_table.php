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
        Schema::dropIfExists('breaking_news');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('breaking_news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('link')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
};
