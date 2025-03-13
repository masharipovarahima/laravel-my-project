<!-- resources/views/conferences/delete.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Konferensiyani o'chirish</h2>

    <div class="alert alert-danger">
        <p><strong>{{ $conference->name }}</strong> konferensiyasini va unga bog'liq barcha seminarlarni o'chirmoqchimisiz?</p>
    </div>

    <!-- Konferensiyani o'chirish formasi -->
    <form action="{{ route('conferences.destroy', $conference->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <a href="{{ route('conferences.index') }}" class="btn btn-secondary">Bekor qilish</a>
        <button type="submit" class="btn btn-danger" onclick="return confirm('Rostdan ham o'chirmoqchimisiz?')">Ha, O'chirish</button>
    </form>

    <!-- Ulangan seminarlar ro'yxati -->
    @if($conference->seminars->isNotEmpty())
        <div class="mt-4">
            <h5>Ushbu konferensiyaga bog'liq seminarlar:</h5>
            <ul>
                @foreach($conference->seminars as $seminar)
                    <li><strong>{{ $seminar->name }}</strong> - {{ $seminar->date }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection
