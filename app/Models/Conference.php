<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conference extends Model
{
    use HasFactory;

    // Ruxsat etilgan maydonlar
    protected $fillable = ['name', 'start_date', 'end_date', 'location', 'description'];

    /**
     * Munosabat: Bir konferensiyada bir nechta seminar bo'ladi
     */
    public function seminars(): HasMany
    {
        return $this->hasMany(Seminar::class);
    }

    /**
     * Konferensiyani qidirish bo'yicha so'rovni filtr qilish
     */
    public function scopeSearch($query, $term)
    {
        $term = "%" . $term . "%";
        return $query->where('name', 'like', $term)
                     ->orWhere('location', 'like', $term)
                     ->orWhere('description', 'like', $term);
    }

    /**
     * Boshlanish vaqti formatini olish
     */
    public function getFormattedStartDateAttribute()
    {
        return $this->start_date ? $this->start_date->format('Y-m-d') : null;
    }

    /**
     * Tugash vaqti formatini olish
     */
    public function getFormattedEndDateAttribute()
    {
        return $this->end_date ? $this->end_date->format('Y-m-d') : null;
    }
}
