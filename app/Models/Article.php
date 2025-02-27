<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $fillable = [
        'name',            
        'file_url',        
        'journal_name',    
        'published_date',  
    ];
}
