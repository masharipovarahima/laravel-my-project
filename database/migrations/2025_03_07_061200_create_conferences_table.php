<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conferences', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Konferensiya nomi
            $table->date('start_date'); // Boshlanish sanasi
            $table->date('end_date')->nullable(); // Tugash sanasi
            $table->string('location'); // Joylashuv
            $table->text('description')->nullable(); // Tavsif
            $table->timestamps();
        });

        // Schema::create('seminars', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('conference_id')->constrained('conferences')->onDelete('cascade'); // Konferensiya bilan bog'lanish
        //     $table->string('title'); // Seminar nomi
        //     $table->date('date'); // Seminar sanasi
        //     $table->string('location'); // Seminar joylashuvi
        //     $table->text('description')->nullable(); // Seminar tavsifi
        //     $table->timestamps();
        // });
    }

    public function down(): void
    {
        Schema::dropIfExists('seminars');
        Schema::dropIfExists('conferences');
    }
};
