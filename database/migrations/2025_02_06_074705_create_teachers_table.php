<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * O‘qituvchilar jadvali yaratiladi.
     */
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id(); // Birlamchi kalit (Auto Increment ID)
            $table->string('name'); // O‘qituvchining ismi
            $table->string('surname'); // O‘qituvchining familiyasi
            $table->date('birthday'); // Tug‘ilgan sanasi
            $table->string('specialist'); // Mutaxassisligi
            $table->string('diplom_number'); // Diplom raqami
            $table->string('image')->nullable(); // O‘qituvchining rasmi (ixtiyoriy)
            $table->string('address'); // Manzili
            $table->string('phone'); // Telefon raqami
            $table->string('telegram')->nullable(); // Telegram username (ixtiyoriy)
            $table->string('instagram')->nullable(); // Instagram username (ixtiyoriy)
            $table->text('about')->nullable(); // O‘qituvchi haqida (ixtiyoriy)
            $table->string('email')->unique(); // Email (takrorlanmas bo‘lishi kerak)
            $table->string('building_room')->nullable(); // Ish xonasi (ixtiyoriy)
            $table->timestamps(); // created_at va updated_at ustunlari (Laravel tomonidan avtomatik yuritiladi)
        });
    }
    
    /**
     * Reverse the migrations.
     * O‘qituvchilar jadvali o‘chirib tashlanadi.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
