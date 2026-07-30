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
        Schema::create('resource_page_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resource_page_id')->constrained('resource_pages', 'id');

            $table->string('locale')->index();

            $table->string('title');
            $table->string('slug');
            $table->string('description');
            $table->string('link_text');
            $table->json('page_content')->nullable();

            $table->unique(['resource_page_id', 'locale']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resource_page_translations');
    }
};
