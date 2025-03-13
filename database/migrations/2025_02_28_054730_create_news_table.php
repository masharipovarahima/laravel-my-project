<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Jadvalni yaratish.
     */
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Yangilik sarlavhasi
           
            $table->text('content'); // Yangilik matni
            $table->string('image')->nullable(); // Rasm manzili (ixtiyoriy)
            $table->timestamp('published_at')->nullable(); // Nashr qilingan vaqt (ixtiyoriy)
            $table->timestamps(); // created_at va updated_at
        });
    }

    /**
     * Jadvalni o'chirish.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
