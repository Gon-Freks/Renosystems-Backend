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
        Schema::create('urls', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp('expiration_date')->nullable();
            $table->string('url')->unique();
            $table->string('short_url')->unique();
            $table->integer('clicks')->default(0);
            $table->string('website');
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('user_id');
            $table->boolean('notified')->default(false);

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('urls');
    }
};
