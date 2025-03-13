@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Yangilikni O'chirish</h2>
    <p>Rostdan ham <strong>{{ $news->title }}</strong> yangiligini o'chirmoqchimisiz?</p>

    <form action="{{ route('news.destroy', $news->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        
        <button type="submit" class="btn btn-danger">Ha, o'chir</button>
        <a href="{{ route('news.index') }}" class="btn btn-secondary">Bekor qilish</a>
    </form>
</div>
@endsection
