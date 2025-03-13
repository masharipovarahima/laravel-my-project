@extends('layouts.app')

@section('content')
<div class="container my-4">
    <!-- Muvaffaqiyatli xabarlarni ko'rsatish -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Yangiliklar ro'yxati uchun Card -->
    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Yangiliklar Ro'yxati</h4>
            <div class="d-flex align-items-center">
                <!-- Qidiruv formasi -->
                <form action="{{ route('news.index') }}" method="GET" class="me-2">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Qidirish..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-outline-secondary">Qidirish</button>
                    </div>
                </form>
                <!-- "Yangi Yangilik Qo'shish" tugmasi modal oynani chaqiradi -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createNewsModal">
                    Yangi Yangilik Qo'shish
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Sarlavha</th>
                            <th>Mazmuni</th>
                            <th>Nashr qilingan sana</th>
                            <th>Rasm</th>
                            <th>Harakatlar</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($news as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->content }}</td>
                                <td>{{ $item->published_at }}</td>
                                <td>
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="Rasm" width="70">
                                    @else
                                        <span class="text-muted">Rasm yo'q</span>
                                    @endif
                                </td>
                                <td>
                                    <!-- Tahrirlash tugmasi: data atributlari orqali ma'lumotlar uzatiladi -->
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editNewsModal"
                                        data-id="{{ $item->id }}"
                                        data-title="{{ $item->title }}"
                                        data-content="{{ $item->content }}"
                                        data-published_at="{{ $item->published_at }}">
                                        Tahrirlash
                                    </button>

                                    <!-- O'chirish formasi -->
                                    <form action="{{ route('news.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Rostdan ham o‘chirmoqchimisiz?')">
                                            O'chirish
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Hech qanday yangilik topilmadi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Yangi Yangilik Qo'shish uchun Modal (Create Modal) -->
<div class="modal fade" id="createNewsModal" tabindex="-1" aria-labelledby="createNewsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createNewsModalLabel">Yangi Yangilik Qo'shish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
            </div>
            <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!-- Sarlavha -->
                    <div class="mb-3">
                        <label for="create_title" class="form-label">Sarlavha</label>
                        <input type="text" name="title" value="{{ old('title') }}" required>
                    </div>
                    <!-- Mazmun -->
                    <div class="mb-3">
                        <label for="create_content" class="form-label">Mazmun</label>
                        <textarea name="content" rows="5" required>{{ old('content') }}</textarea>
                    </div>
                    <!-- Noshir qilingan sana -->
                    <div class="mb-3">
                        <label for="create_published_at" class="form-label">Noshir qilingan sana</label>
                        <input type="datetime-local" name="published_at" value="{{ old('published_at') }}">
                    </div>
                    <!-- Rasm -->
                    <div class="mb-3">
                        <label for="create_image" class="form-label">Rasm (ixtiyoriy)</label>
                        <input type="file" class="form-control" id="create_image" name="image">
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

<!-- JavaScript: Edit modalni to'ldirish -->
<script>
    document.getElementById('editNewsModal').addEventListener('show.bs.modal', function (event) {
        let button = event.relatedTarget;
        let id = button.getAttribute('data-id');
        let title = button.getAttribute('data-title');
        let content = button.getAttribute('data-content');
        let published_at = button.getAttribute('data-published_at');

        let form = document.getElementById('editNewsForm');
        form.action = '/news/' + id;

        document.getElementById('edit_title').value = title;
        document.getElementById('edit_content').value = content;
        document.getElementById('edit_published_at').value = published_at;
    });
</script>
@endsection
