@extends('layouts.app')

@section('content')
<div class="container my-4">
    <!-- Muvaffaqiyatli xabarlarni ko'rsatish -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Lavozimlar ro'yxati uchun Card -->
    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Lavozimlar Ro'yxati</h4>
            <div class="d-flex align-items-center">
                <!-- Qidiruv formasi -->
                <form action="{{ route('degrees.index') }}" method="GET" class="me-2">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Qidirish..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-outline-secondary">Qidirish</button>
                    </div>
                </form>
                <!-- "Yangi Lavozim Qo'shish" tugmasi modal oynani chaqiradi -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createDegreeModal">
                    Yangi Lavozim Qo'shish
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Lavozim nomi</th>
                            <th>Harakatlar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($degrees as $degree)
                            <tr>
                                <td>{{ $degree->id }}</td>
                                <td>{{ $degree->name }}</td>
                                <td>
                                    <!-- Tahrirlash tugmasi: data atributlari orqali lavozim ma'lumotlari uzatiladi -->
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editDegreeModal"
                                        data-id="{{ $degree->id }}"
                                        data-name="{{ $degree->name }}"
                                        data-description="{{ $degree->description }}">
                                        Tahrirlash
                                    </button>
                                    <form action="{{ route('degrees.destroy', $degree->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Rostdan ham lavozimni o‘chirmoqchimisiz?')">
                                            O'chirish
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Hech qanday lavozim topilmadi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Yangi Lavozim Qo'shish uchun Modal (Create Modal) -->
<div class="modal fade" id="createDegreeModal" tabindex="-1" aria-labelledby="createDegreeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDegreeModalLabel">Yangi Lavozim Qo'shish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
            </div>
            <form action="{{ route('degrees.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Lavozim nomi -->
                    <div class="mb-3">
                        <label for="create_name" class="form-label">Lavozim nomi</label>
                        <input type="text" class="form-control" id="create_name" name="name" placeholder="Lavozim nomini kiriting" required>
                    </div>
                    <!-- Tavsif -->
                    <div class="mb-3">
                        <label for="create_description" class="form-label">Tavsif</label>
                        
                        <textarea class="form-control ckeditor" id="create_description" name="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                    <button type="submit" class="btn btn-primary">Saqlash</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Lavozimni Tahrirlash uchun Modal (Edit Modal) -->
<div class="modal fade" id="editDegreeModal" tabindex="-1" aria-labelledby="editDegreeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDegreeModalLabel">Lavozimni Tahrirlash</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
            </div>
            <form id="editDegreeForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Lavozim nomi -->
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Lavozim nomi</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <!-- Tavsif -->
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Tavsif</label>
                        <textarea class="form-control ckeditor" id="edit_description" name="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                    <button type="submit" class="btn btn-success">Yangilash</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript: Edit modalini dinamik to'ldirish -->
<script>
    var editDegreeModalEl = document.getElementById('editDegreeModal');
    editDegreeModalEl.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // modalni chaqirgan tugma
        var degreeId = button.getAttribute('data-id');
        var name = button.getAttribute('data-name');
        var description = button.getAttribute('data-description');

        // Formaning action atributini yangilash
        var form = document.getElementById('editDegreeForm');
        form.action = '/degrees/' + degreeId;

        // Inputlarni to'ldirish
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_description').value = description;
    });
</script>
@vite(['resources/js/app.js'])
@endsection
