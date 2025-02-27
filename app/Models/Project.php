<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = [
        'name',        
        'begin_time',  
        'end_time',    
        'image_url',   
        'about',       
        'result',      
    ];
}
