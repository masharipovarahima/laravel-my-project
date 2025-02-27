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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Loyiha nomi
            $table->dateTime('begin_time'); // Boshlanish vaqti
            $table->dateTime('end_time'); // Tugash vaqti
            $table->string('image_url')->nullable(); // Rasm manzili (ixtiyoriy)
            $table->text('about')->nullable(); // Loyihaning ta'rifi
            $table->text('result')->nullable(); // Loyihaning natijalari
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
