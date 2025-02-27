<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * O‘qituvchilar jadvaliga `image` ustuni qo‘shiladi.
     */
    public function up(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            // 📌 Agar `image` ustuni mavjud bo‘lmasa, qo‘shamiz
            if (!Schema::hasColumn('teachers', 'image')) {
                $table->string('image')->nullable()->after('diplom_number');
            }
        });
    }

    /**
     * Reverse the migrations.
     * O‘qituvchilar jadvalidan `image` ustuni o‘chiriladi.
     */
    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            // 📌 Agar `image` ustuni mavjud bo‘lsa, uni o‘chiramiz
            if (Schema::hasColumn('teachers', 'image')) {
                $table->dropColumn('image');
            }
        });
    }
};
