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
        Schema::create('door_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('door_id')->constrained('doors', 'id')->cascadeOnDelete();

            $table->string('locale')->index();

            $table->string('collection_name');
            $table->string('name');
            $table->string('slug');
            $table->string('description')->nullable();

            $table->unique(['door_id', 'locale']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('door_translations');
    }
};
