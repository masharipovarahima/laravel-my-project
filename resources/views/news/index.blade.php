@extends('layouts.app')

@section('content')
    <div class="container my-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Yangiliklar Ro'yxati</h4>
                <div class="d-flex align-items-center">
                    <form action="{{ route('news.index') }}" method="GET" class="me-2">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Qidirish..."
                                value="{{ request('search') }}">
                            <button type="submit" class="btn btn-outline-secondary">Qidirish</button>
                        </div>
                    </form>
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
                                        @if ($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="Rasm" width="70">
                                        @else
                                            <span class="text-muted">Rasm yo'q</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editNewsModal" data-id="{{ $item->id }}"
                                            data-title="{{ $item->title }}" data-content="{{ $item->content }}"
                                            data-published_at="{{ $item->published_at }}"
                                            data-image="{{ $item->image ? asset('storage/' . $item->image) : '' }}">
                                            Tahrirlash
                                        </button>
                                        <form action="{{ route('news.destroy', $item->id) }}" method="POST"
                                            class="d-inline">
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
                                    <td colspan="6" class="text-center">Hech qanday yangilik topilmadi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Updated Create Modal with Image Preview -->
    <div class="modal fade" id="createNewsModal" tabindex="-1" aria-labelledby="createNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createNewsModalLabel">Yangi Yangilik Qo'shish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                </div>
                <form id="createNewsForm" action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="create_title" class="form-label">Sarlavha</label>
                            <input type="text" name="title" id="create_title" class="form-control"
                                value="{{ old('title') }}" required>
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="create_content" class="form-label">Mazmun</label>
                            <textarea name="content" id="create_content" class="form-control" rows="5" required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="create_published_at" class="form-label">Noshir qilingan sana</label>
                            <input type="datetime-local" name="published_at" id="create_published_at" class="form-control"
                                value="{{ old('published_at') }}">
                            @error('published_at')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="create_image" class="form-label">Rasm (ixtiyoriy)</label>
                            <input type="file" class="form-control" id="create_image" name="image" accept="image/*">
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mt-2">
                                <img id="create_image_preview" src="#" alt="Rasm oldindan ko'rish"
                                    class="img-fluid" style="max-width: 200px; display: none;">
                            </div>
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

    <!-- Edit Modal with Image Preview -->
    <div class="modal fade" id="editNewsModal" tabindex="-1" aria-labelledby="editNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editNewsModalLabel">Yangilikni Tahrirlash</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                </div>
                <form id="editNewsForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_title" class="form-label">Sarlavha</label>
                            <input type="text" name="title" id="edit_title" class="form-control" required>
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="edit_content" class="form-label">Mazmun</label>
                            <textarea name="content" id="edit_content" class="form-control" rows="5" required></textarea>
                            @error('content')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="edit_published_at" class="form-label">Noshir qilingan sana</label>
                            <input type="datetime-local" name="published_at" id="edit_published_at"
                                class="form-control">
                            @error('published_at')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="edit_image" class="form-label">Rasm (ixtiyoriy)</label>
                            <input type="file" class="form-control" id="edit_image" name="image" accept="image/*">
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mt-2">
                                <img id="edit_image_preview" src="#" alt="Rasm oldindan ko'rish"
                                    class="img-fluid" style="max-width: 200px; display: none;">
                                <p id="edit_no_image_text" class="text-muted mt-2" style="display: none;">Hozirgi rasm
                                    yo'q</p>
                            </div>
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

    <!-- Separate JavaScript for Create and Edit -->
    <script>
        // Create Modal JavaScript
        document.getElementById('createNewsModal').addEventListener('show.bs.modal', function(event) {
            // Reset the form when opening the modal
            document.getElementById('createNewsForm').reset();
            const preview = document.getElementById('create_image_preview');
            preview.style.display = 'none';
        });

        document.getElementById('create_image').addEventListener('change', function(e) {
            const preview = document.getElementById('create_image_preview');
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        });

        // Edit Modal JavaScript
        document.getElementById('editNewsModal').addEventListener('show.bs.modal', function(event) {
            let button = event.relatedTarget;
            let id = button.getAttribute('data-id');
            let title = button.getAttribute('data-title');
            let content = button.getAttribute('data-content');
            let published_at = button.getAttribute('data-published_at');
            let image = button.getAttribute('data-image');

            let form = document.getElementById('editNewsForm');
            form.action = '{{ route('news.update', ':id') }}'.replace(':id', id);

            document.getElementById('edit_title').value = title;
            document.getElementById('edit_content').value = content;
            document.getElementById('edit_published_at').value = published_at ? new Date(published_at).toISOString()
                .slice(0, 16) : '';

            const preview = document.getElementById('edit_image_preview');
            const noImageText = document.getElementById('edit_no_image_text');

            if (image) {
                preview.src = image;
                preview.style.display = 'block';
                noImageText.style.display = 'none';
            } else {
                preview.style.display = 'none';
                noImageText.style.display = 'block';
            }
        });

        document.getElementById('edit_image').addEventListener('change', function(e) {
            const preview = document.getElementById('edit_image_preview');
            const noImageText = document.getElementById('edit_no_image_text');
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    noImageText.style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
    @vite(['resources/js/app.js'])
@endsection
