<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $table = 'information';
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
