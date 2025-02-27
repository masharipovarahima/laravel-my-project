<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Foydalanuvchini login bo'lgandan so'ng yo'naltirish.
     */
    protected function redirectTo()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return '/admin/dashboard';
        }
        return '/home';
    }

    /**
     * Controllerning yangi nusxasini yaratish.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Login jarayoni.
     */
    public function login(Request $request)
    {
        // Kirish ma'lumotlarini validatsiya qilish
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // ✅ Foydalanuvchi autentifikatsiyasini tekshirish
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Autentifikatsiya tekshiruvi
            return redirect()->intended($this->redirectTo());
        }

        // Xatolikni qaytarish
        return back()->withErrors([
            'email' => 'Kiritilgan maʼlumotlar noto‘g‘ri.',
        ])->onlyInput('email');
    }

    /**
     * Logout method.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * Admin foydalanuvchi yaratish.
     */
    public function createAdminUser()
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        return 'Admin foydalanuvchi yaratildi.';
    }
}
