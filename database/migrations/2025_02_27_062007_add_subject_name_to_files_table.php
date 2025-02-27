<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('files', function (Blueprint $table) {
            // Foreign keyni o'chirish
            $table->dropForeign(['subject_id']);
            // subject_id ustunini o'chirish
            $table->dropColumn('subject_id');
        });
    }

    public function down(): void
    {
        Schema::table('files', function (Blueprint $table) {
            // Agar qaytarmoqchi bo'lsangiz
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->foreign('subject_id')->references('id')->on('subjects')->cascadeOnDelete();
        });
    }
};
