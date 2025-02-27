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
        Schema::create('project_articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id'); // Maqolaga bog‘lanish
            $table->unsignedBigInteger('project_id'); // Loyiha bilan bog‘lanish
            $table->timestamps();
    
            // Foreign keys
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_articles');
    }
};
