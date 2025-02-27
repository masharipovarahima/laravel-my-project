@extends('layouts.app')

@section('content')
<div class="container my-4">
    <!-- Muvaffaqiyatli xabarlarni ko'rsatish -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Proektlar ro'yxati uchun Card -->
    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Proektlar ro'yxati</h4>
            <div class="d-flex align-items-center">
                <!-- Qidiruv formasi -->
                <form action="{{ route('projects.index') }}" method="GET" class="me-2">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Qidirish..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-outline-secondary">Qidirish</button>
                    </div>
                </form>
                <!-- "Proekt qo'shish" tugmasi modal oynani chaqiradi -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createProjectModal">
                    Proekt qo'shish
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nomi</th>
                            <th>Boshlanish vaqti</th>
                            <th>Tugash vaqti</th>
                            <th>Rasm</th>
                            <th>Haqida</th>
                            <th>Natija</th>
                            <th>Harakatlar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $project)
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td>{{ $project->name }}</td>
                                <td>{{ $project->begin_time }}</td>
                                <td>{{ $project->end_time }}</td>
                                <td>
                                    @if($project->image_url)
                                        <img src="{{ asset('storage/' . $project->image_url) }}" alt="Proekt Rasm" width="50" class="img-thumbnail">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ \Illuminate\Support\Str::limit($project->about, 50) }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($project->result, 50) }}</td>
                                <td>
                                    <!-- Tahrirlash tugmasi: modalni chaqiradi -->
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editProjectModal"
                                        data-id="{{ $project->id }}"
                                        data-name="{{ $project->name }}"
                                        data-begin_time="{{ $project->begin_time }}"
                                        data-end_time="{{ $project->end_time }}"
                                        data-about="{{ $project->about }}"
                                        data-result="{{ $project->result }}"
                                        data-image_url="{{ $project->image_url ? asset('storage/' . $project->image_url) : '' }}">
                                        Tahrirlash
                                    </button>
                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Rostdan ham o‘chirmoqchimisiz?')">
                                            O'chirish
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Proektlar topilmadi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Yangi Proekt Qo'shish uchun Modal (Create Modal) -->
<div class="modal fade" id="createProjectModal" tabindex="-1" aria-labelledby="createProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProjectModalLabel">Yangi Proekt Qo'shish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
            </div>
            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!-- Proekt nomi -->
                    <div class="mb-3">
                        <label for="create_name" class="form-label">Proekt nomi</label>
                        <input type="text" class="form-control" id="create_name" name="name" placeholder="Proekt nomi" required>
                    </div>
                    <!-- Boshlanish vaqti -->
                    <div class="mb-3">
                        <label for="create_begin_time" class="form-label">Boshlanish vaqti</label>
                        <input type="date" class="form-control" id="create_begin_time" name="begin_time" required>
                    </div>
                    <!-- Tugash vaqti -->
                    <div class="mb-3">
                        <label for="create_end_time" class="form-label">Tugash vaqti</label>
                        <input type="date" class="form-control" id="create_end_time" name="end_time" required>
                    </div>
                    <!-- Rasm yuklash -->
                    <div class="mb-3">
                        <label for="create_image_url" class="form-label">Rasm</label>
                        <input type="file" class="form-control" id="create_image_url" name="image_url">
                    </div>
                    <!-- Proekt haqida -->
                    <div class="mb-3">
                        <label for="create_about" class="form-label">Haqida</label>
                        <textarea class="form-control" id="create_about" name="about" rows="3" placeholder="Proekt haqida ma'lumot"></textarea>
                    </div>
                    <!-- Natija -->
                    <div class="mb-3">
                        <label for="create_result" class="form-label">Natija</label>
                        <textarea class="form-control" id="create_result" name="result" rows="3" placeholder="Proekt natijasi"></textarea>
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

<!-- Proektni Tahrirlash uchun Modal (Edit Modal) -->
<div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="editProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProjectModalLabel">Proektni Tahrirlash</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
            </div>
            <form id="editProjectForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Proekt nomi -->
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Proekt nomi</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <!-- Boshlanish vaqti -->
                    <div class="mb-3">
                        <label for="edit_begin_time" class="form-label">Boshlanish vaqti</label>
                        <input type="date" class="form-control" id="edit_begin_time" name="begin_time" required>
                    </div>
                    <!-- Tugash vaqti -->
                    <div class="mb-3">
                        <label for="edit_end_time" class="form-label">Tugash vaqti</label>
                        <input type="date" class="form-control" id="edit_end_time" name="end_time" required>
                    </div>
                    <!-- Rasm yuklash -->
                    <div class="mb-3">
                        <label for="edit_image_url" class="form-label">Rasm</label>
                        <input type="file" class="form-control" id="edit_image_url" name="image_url">
                        <small id="currentImageHelp" class="form-text text-muted"></small>
                    </div>
                    <!-- Proekt haqida -->
                    <div class="mb-3">
                        <label for="edit_about" class="form-label">Haqida</label>
                        <textarea class="form-control" id="edit_about" name="about" rows="3"></textarea>
                    </div>
                    <!-- Natija -->
                    <div class="mb-3">
                        <label for="edit_result" class="form-label">Natija</label>
                        <textarea class="form-control" id="edit_result" name="result" rows="3"></textarea>
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
    var editProjectModalEl = document.getElementById('editProjectModal');
    editProjectModalEl.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Modalni chaqirgan tugma
        // Ma'lumotlarni data atributlaridan olish
        var projectId = button.getAttribute('data-id');
        var name = button.getAttribute('data-name');
        var beginTime = button.getAttribute('data-begin_time');
        var endTime = button.getAttribute('data-end_time');
        var about = button.getAttribute('data-about');
        var result = button.getAttribute('data-result');
        var imageUrl = button.getAttribute('data-image_url');

        // Formaning action atributini yangilash
        var form = document.getElementById('editProjectForm');
        form.action = '/projects/' + projectId;

        // Inputlarni to'ldirish
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_begin_time').value = beginTime;
        document.getElementById('edit_end_time').value = endTime;
        document.getElementById('edit_about').value = about;
        document.getElementById('edit_result').value = result;

        // Joriy rasmni ko'rsatish
       
    });
</script>
@endsection
