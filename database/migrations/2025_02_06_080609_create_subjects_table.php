<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id(); // id ustuni
            $table->string('name'); // name ustuni
            $table->string('specialist'); // specialist ustuni
            $table->unsignedBigInteger('teacher_id'); // teacher_id ustuni (foreign key)
            $table->timestamps(); // created_at va updated_at ustunlari

            // Agar teacher_id ustuni boshqa jadvalga bog'langan bo'lsa
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
