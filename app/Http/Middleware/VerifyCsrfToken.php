<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Ushbu yo'nalishlar CSRF tekshiruvdan istisno qilinadi.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/files/upload', // Yo'nalishni to'g'ri shaklda yozish
    ];
}
