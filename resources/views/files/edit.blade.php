@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Faylni Tahrirlash</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('files.update', $file->name) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Joriy Faylni Ko'rish -->
                @if($file->file_url)
                    <div class="mb-3">
                        <label class="form-label">Joriy fayl:</label>
                        <a href="{{ asset('storage/' . $file->file_url) }}" target="_blank" class="d-block mb-2">Ko'rish</a>
                    </div>
                @endif

                <!-- Yangi Faylni Yuklash -->
                <div class="mb-3">
                    <label for="file" class="form-label">Yangi faylni yuklash (ixtiyoriy)</label>
                    <input type="file" class="form-control" id="file" name="file">
                </div>

                <!-- Fan Tanlash (Dropdown) -->
                <div class="mb-3">
                    <label for="subject_name" class="form-label">Fan tanlash</label>
                    <select class="form-control" id="subject_name" name="subject_name" required>
                        <option value="">Fan tanlang</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->name }}" {{ $file->subject->name == $subject->name ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tugmalar -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('files.index') }}" class="btn btn-secondary">Bekor qilish</a>
                    <button type="submit" class="btn btn-success">Yangilash</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
