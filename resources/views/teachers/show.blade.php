@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $teacher->name }} {{ $teacher->surname }}</h2>
        @if($teacher->image_url)
    {{-- Rasm manzilini tekshirish --}}
    <p>Rasm manzili: {{ asset('storage/' . $teacher->image_url) }}</p>
    
    @if ($teacher->image_url)
    <img src="{{ asset('storage/' . $teacher->image_url) }}" alt="O‘qituvchi rasmi" class="img-thumbnail" width="100">
@else
    <span class="text-muted">Rasm yo'q</span>
@endif



        <p><strong>Tug‘ilgan sana:</strong> {{ $teacher->birthday }}</p>
        <p><strong>Mutaxassisligi:</strong> {{ $teacher->specialist }}</p>
        <p><strong>Diplom raqami:</strong> {{ $teacher->diplom_number }}</p>
        <p><strong>Manzil:</strong> {{ $teacher->address }}</p>
        <p><strong>Telefon:</strong> {{ $teacher->phone }}</p>

        @if ($teacher->telegram)
            <p><strong>Telegram:</strong> <a href="https://t.me/{{ $teacher->telegram }}" target="_blank">{{ $teacher->telegram }}</a></p>
        @endif

        @if ($teacher->instagram)
            <p><strong>Instagram:</strong> <a href="https://instagram.com/{{ $teacher->instagram }}" target="_blank">{{ $teacher->instagram }}</a></p>
        @endif

        @if ($teacher->about)
            <p><strong>Haqida:</strong> {{ $teacher->about }}</p>
        @endif

        <p><strong>Email:</strong> {{ $teacher->email }}</p>

        @if ($teacher->building_room)
            <p><strong>Xona:</strong> {{ $teacher->building_room }}</p>
        @endif

        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">Ortga</a>
        <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-primary">Tahrirlash</a>

        <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Haqiqatan ham o‘chirmoqchimisiz?')">O‘chirish</button>
        </form>
    </div>
@endsection
