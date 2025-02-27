@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Yangi Fan Qo'shish</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('subjects.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Fan nomi</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Fan nomini kiriting" required>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Bekor qilish</a>
                    <button type="submit" class="btn btn-primary">Saqlash</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
