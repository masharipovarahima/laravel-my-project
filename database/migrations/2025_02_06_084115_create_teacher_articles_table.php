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
        Schema::create('teacher_articles', function (Blueprint $table) {
            $table->id(); // ID ustuni
            $table->unsignedBigInteger('teacher_id'); // O‘qituvchi bilan bog‘lanish
            $table->unsignedBigInteger('article_id'); // Maqola bilan bog‘lanish
            $table->timestamps(); // Yaralgan va yangilangan sanalar
    
            // Foreign keys
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_articles');
    }
};
