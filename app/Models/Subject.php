<?php

// App\Models\Subject.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    // Agar mass-assignment dan foydalanayotgan bo'lsangiz
    protected $fillable = ['name', 'specialist', 'teacher_id'];

    // teacher munosabatini aniqlash
    public function teacher()
    {
        return $this->belongsTo(\App\Models\Teacher::class, 'teacher_id');
    }
}
