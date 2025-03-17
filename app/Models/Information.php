<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    // Jadval nomini aniqlash (agar Laravel avtomatik aniqlay olmasa)
    protected $table = 'informations';

    // Mass-assignment (bir necha maydonni bir vaqtda to‘ldirish) uchun ruxsat berilgan ustunlar
    protected $fillable = [
        'directions_info',
        'position_title',
        'position_description',
        'address',
        'phone',
        'email',
        'group_address',
        'latitude',
        'longitude',
    ];
}
