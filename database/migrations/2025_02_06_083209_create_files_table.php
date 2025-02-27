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
        Schema::create('files', function (Blueprint $table) {
            $table->id(); // ID ustuni
            $table->text('file_url'); // Fayl yo'li
            $table->unsignedBigInteger('subject_id'); // Fan bilan bog'lanish
            $table->timestamps(); // Yaralgan va yangilangan sanalar

            // Chet el kaliti (subjects jadvalidagi id ga bog'lash)
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
