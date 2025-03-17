@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <h4>Ma'lumotlar Ro'yxati</h4>
            <a href="{{ route('information.create') }}" class="btn btn-success">Yangi Ma'lumot Qo'shish</a>
        </div>
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Yo'nalish Ma'lumoti</th>
                            <th>Lavozim Nomi</th>
                            <th>Lavozim Tavsifi</th>
                            <th>Manzil</th>
                            <th>Telefon</th>
                            <th>Email</th>
                            <th>Guruh Manzili</th>
                            <th>Kenglik (Latitude)</th>
                            <th Uzunlik (Longitude)</th>
                            <th>Harakatlar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($informations as $information)
                            <tr>
                                <td>{{ $information->id }}</td>
                                <td>{{ $information->directions_info ?? '-' }}</td>
                                <td>{{ $information->position_title ?? '-' }}</td>
                                <td>{{ $information->position_description ?? '-' }}</td>
                                <td>{{ $information->address ?? '-' }}</td>
                                <td>{{ $information->phone ?? '-' }}</td>
                                <td>{{ $information->email ?? '-' }}</td>
                                <td>{{ $information->group_address ?? '-' }}</td>
                                <td>{{ $information->latitude ?? '-' }}</td>
                                <td>{{ $information->longitude ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('information.edit', $information) }}"
                                        class="btn btn-primary btn-sm">Tahrirlash</a>
                                    <form action="{{ route('information.destroy', $information) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Haqiqatan ham o\'chirishni xohlaysizmi?')">O'chirish</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">Hech qanday ma'lumot topilmadi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
