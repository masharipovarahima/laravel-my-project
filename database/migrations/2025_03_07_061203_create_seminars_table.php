<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seminars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conference_id')
                  ->constrained('conferences')
                  ->onDelete('cascade'); // Konferensiyaga bog'lanish

            $table->string('title'); // Seminar nomi
            $table->dateTime('start_time'); // Boshlanish vaqti
            $table->dateTime('end_time')->nullable(); // Tugash vaqti
            $table->string('speaker'); // Ma'ruzachi
            $table->text('details')->nullable(); // Batafsil ma'lumot

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seminars');
    }
};
