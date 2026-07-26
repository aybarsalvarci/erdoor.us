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
        Schema::create('door_spesification_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('door_spesification_id')->constrained('door_spesifications', 'id')->cascadeOnDelete();

            $table->string('name');
            $table->string('value');

            $table->string('locale')->index();

            $table->unique(['door_spesification_id', 'locale'], 'unique_locale');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('door_spesification_translations');
    }
};
