@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Yangi Proekt Qo'shish</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Proekt nomi" required>
                </div>
                <!-- Begin Time -->
                <div class="mb-3">
                    <label for="begin_time" class="form-label">Begin Time</label>
                    <input type="date" class="form-control" id="begin_time" name="begin_time" required>
                </div>
                <!-- End Time -->
                <div class="mb-3">
                    <label for="end_time" class="form-label">End Time</label>
                    <input type="date" class="form-control" id="end_time" name="end_time" required>
                </div>
                <!-- Image (Fayl yuklash) -->
                <div class="mb-3">
                    <label for="image_url" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image_url" name="image_url">
                </div>
                <!-- About -->
                <div class="mb-3">
                    <label for="about" class="form-label">About</label>
                    <textarea class="form-control" id="about" name="about" rows="3" placeholder="Proekt haqida"></textarea>
                </div>
                <!-- Result -->
                <div class="mb-3">
                    <label for="result" class="form-label">Result</label>
                    <textarea class="form-control" id="result" name="result" rows="3" placeholder="Natija"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Saqlash</button>
            </form>
        </div>
    </div>
</div>
@endsection
