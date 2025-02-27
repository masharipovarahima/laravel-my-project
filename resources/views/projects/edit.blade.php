@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Proektni Tahrirlash</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $project->name }}" required>
                </div>
                <!-- Begin Time -->
                <div class="mb-3">
                    <label for="begin_time" class="form-label">Begin Time</label>
                    <input type="date" class="form-control" id="begin_time" name="begin_time" value="{{ $project->begin_time }}" required>
                </div>
                <!-- End Time -->
                <div class="mb-3">
                    <label for="end_time" class="form-label">End Time</label>
                    <input type="date" class="form-control" id="end_time" name="end_time" value="{{ $project->end_time }}" required>
                </div>
                <!-- Image -->
                <div class="mb-3">
                    <label for="image_url" class="form-label">Image</label>
                    @if($project->image_url)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $project->image_url) }}" alt="Project Image" width="100" class="img-thumbnail">
                        </div>
                    @endif
                    <input type="file" class="form-control" id="image_url" name="image_url">
                </div>
                <!-- About -->
                <div class="mb-3">
                    <label for="about" class="form-label">About</label>
                    <textarea class="form-control" id="about" name="about" rows="3">{{ $project->about }}</textarea>
                </div>
                <!-- Result -->
                <div class="mb-3">
                    <label for="result" class="form-label">Result</label>
                    <textarea class="form-control" id="result" name="result" rows="3">{{ $project->result }}</textarea>
                </div>
                <button type="submit" class="btn btn-success">Yangilash</button>
            </form>
        </div>
    </div>
</div>
@endsection
