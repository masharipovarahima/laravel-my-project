@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 flex flex-col">
        <!-- Navbar -->
        <nav class="bg-white shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <span class="text-xl font-bold text-gray-800">Dashboard</span>
                    </div>
                    <div>
                        <a href="{{ route('profile.show') }}" class="text-gray-600 hover:text-gray-900 px-4">Profil</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800">Chiqish</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content Wrapper -->
        <div class="flex flex-1">
            <!-- Sidebar -->
            <aside class="w-64 bg-white shadow-md p-6">
                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center text-blue-600 font-semibold">
                            📊 Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center text-gray-600 hover:text-blue-600">
                            👤 Foydalanuvchilar
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center text-gray-600 hover:text-blue-600">
                            ⚙ Sozlamalar
                        </a>
                    </li>
                </ul>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 p-6">
                <h2 class="text-2xl font-bold text-gray-800">Xush kelibsiz, Admin!</h2>
                <p class="text-gray-600 mt-2">Bu yerdan boshqaruv panelini ko'rib chiqishingiz mumkin.</p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                    <div class="bg-white p-6 shadow-md rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-700 flex items-center">👥 Foydalanuvchilar</h3>
                        <p class="text-gray-500">Jami: <span class="font-bold">120</span></p>
                    </div>
                    <div class="bg-white p-6 shadow-md rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-700 flex items-center">📝 Buyurtmalar</h3>
                        <p class="text-gray-500">Jami: <span class="font-bold">45</span></p>
                    </div>
                    <div class="bg-white p-6 shadow-md rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-700 flex items-center">📊 Statistikalar</h3>
                        <p class="text-gray-500">Kunlik tashriflar: <span class="font-bold">2300</span></p>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
