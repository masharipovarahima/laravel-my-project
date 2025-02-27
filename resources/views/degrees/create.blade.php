@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Yangi Lavozim Qo'shish</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('degrees.store') }}" method="POST">
                @csrf
                <!-- Lavozim nomi -->
                <div class="mb-3">
                    <label for="name" class="form-label">Lavozim nomi</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Lavozim nomini kiriting" required>
                </div>
                <!-- Tavsif -->
                <div class="mb-3">
                    <label for="description" class="form-label">Tavsif</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Lavozim haqida qisqacha ma'lumot"></textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('degrees.index') }}" class="btn btn-secondary">Bekor qilish</a>
                    <button type="submit" class="btn btn-primary">Saqlash</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
