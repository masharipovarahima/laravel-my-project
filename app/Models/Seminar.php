<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    protected $table = "seminars";
    protected $fillable = ["conference_id", "title", "start_time", "end_time", "speaker", "details"];

    public function conference()
    {
        return $this->belongsTo(Conference::class);
    }
}
