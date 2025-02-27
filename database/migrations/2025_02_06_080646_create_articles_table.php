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
    Schema::create('articles', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Maqola nomi
        $table->string('file_url')->nullable();
 // Maqola fayl manzili
        $table->string('journal_name'); // Nashr etilgan jurnal nomi
        $table->date('published_date'); // Nashr qilingan sana
        $table->timestamps(); // created_at va updated_at
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
