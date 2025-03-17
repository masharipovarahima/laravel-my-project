@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Yangi Yangilik Qo'shish</h2>

        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Sarlavha -->
            <div class="mb-3">
                <label for="title" class="form-label">Sarlavha</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Matn -->
            <div class="mb-3">
                <label for="content" class="form-label">Yangilik Matni</label>
                <textarea name="content" id="content" class="form-control" rows="5" required>{{ old('content') }}</textarea>
                @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Rasm -->
            <div class="mb-3">
                <label for="image" class="form-label">Rasm (ixtiyoriy)</label>
                <input type="file" name="image" id="image" class="form-control">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nashr qilingan sana -->
            <div class="mb-3">
                <label for="published_at" class="form-label">Nashr qilingan sana</label>
                <input type="datetime-local" name="published_at" id="published_at" class="form-control"
                    value="{{ old('published_at') }}">
                @error('published_at')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Saqlash va Bekor qilish tugmalari -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('news.index') }}" class="btn btn-secondary">Bekor qilish</a>
                <button type="submit" class="btn btn-success">Saqlash</button>
            </div>

        </form>
    </div>
@endsection
