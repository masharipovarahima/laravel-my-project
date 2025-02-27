<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'name', 'surname', 'birthday', 'specialist', 
        'diplom_number', 'phone', 'email', 'address', 
        'telegram', 'instagram', 'about', 'building_room', 'image'
    ];

    // Rasm URL ni avtomatik olish uchun accessor
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/default.png');
    }
}
