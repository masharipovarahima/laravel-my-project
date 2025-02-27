@extends('layouts.app')

@section('content')
<div class="container my-4">
    <!-- Modal: O'qituvchini tahrirlash oynasi -->
    <div class="modal fade show" id="editTeacherModal" tabindex="-1" aria-labelledby="editTeacherModalLabel" aria-modal="true" style="display: block;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="editTeacherModalLabel">O'qituvchini tahrirlash</h5>
                    <a href="{{ route('teachers.index') }}" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>

                <!-- Form: O'qituvchini yangilash -->
                <form action="{{ route('teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <!-- Ism -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Ism</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $teacher->name) }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Familiya -->
                        <div class="mb-3">
                            <label for="surname" class="form-label">Familiya</label>
                            <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname" value="{{ old('surname', $teacher->surname) }}" required>
                            @error('surname') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Tug'ilgan Sana -->
                        <div class="mb-3">
                            <label for="birthday" class="form-label">Tug'ilgan Sana</label>
                            <input type="date" class="form-control @error('birthday') is-invalid @enderror" id="birthday" name="birthday" value="{{ old('birthday', $teacher->birthday) }}" required>
                            @error('birthday') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Mutaxassislik -->
                        <div class="mb-3">
                            <label for="specialist" class="form-label">Mutaxassislik</label>
                            <input type="text" class="form-control @error('specialist') is-invalid @enderror" id="specialist" name="specialist" value="{{ old('specialist', $teacher->specialist) }}" required>
                            @error('specialist') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Rasm Yuklash -->
                        <div class="mb-3">
                            <label for="image_url" class="form-label">Rasm</label>
                            <input type="file" class="form-control @error('image_url') is-invalid @enderror" id="image_url" name="image_url">
                            @error('image_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Manzil -->
                        <div class="mb-3">
                            <label for="address" class="form-label">Manzil</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $teacher->address) }}" required>
                            @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Telefon -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Telefon</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $teacher->phone) }}" required>
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $teacher->email) }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <a href="{{ route('teachers.index') }}" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</a>
                        <button type="submit" class="btn btn-success">Yangilash</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Hozirgi rasmni ko'rsatish -->
@if($teacher->image_url)
    <div class="mb-3">
        <label class="form-label">Hozirgi rasm</label>
        <div>
            <img src="{{ asset('storage/' . $teacher->image_url) }}" alt="O'qituvchi rasmi" class="img-thumbnail" width="150">
        </div>
    </div>
@endif


<script>
document.addEventListener("DOMContentLoaded", function () {
    var editModalEl = document.getElementById('editTeacherModal');
    if (editModalEl) {
        var editModal = new bootstrap.Modal(editModalEl);
        editModal.show();
    }
});
</script>
@endsection
