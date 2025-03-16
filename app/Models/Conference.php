<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Conference extends Model
{
    use HasFactory;

    // Ruxsat etilgan maydonlar
    protected $fillable = ['name', 'start_date', 'end_date', 'location', 'description'];

    // Sanalarni avtomatik ravishda `Carbon` obyektiga aylantirish
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

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
    public function scopeSearch(Builder $query, $term): Builder
    {
        $term = "%{$term}%";
        return $query->where('name', 'like', $term)
                     ->orWhere('location', 'like', $term)
                     ->orWhere('description', 'like', $term);
    }

    /**
     * Boshlanish vaqti formatini olish
     */
    public function getFormattedStartDateAttribute(): ?string
    {
        return $this->start_date?->format('Y-m-d');
    }

    /**
     * Tugash vaqti formatini olish
     */
    public function getFormattedEndDateAttribute(): ?string
    {
        return $this->end_date?->format('Y-m-d');
    }
}
