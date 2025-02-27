@extends('layouts.app')

@section('content')
<div class="container my-4">
    <!-- Muvaffaqiyatli xabarlarni ko'rsatish -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Maqolalar ro'yxati uchun Card -->
    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Maqolalar ro'yxati</h4>
            <div class="d-flex align-items-center">
                <!-- Qidiruv formasi -->
                <form action="{{ route('articles.index') }}" method="GET" class="me-2">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Qidirish..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-outline-secondary">Qidirish</button>
                    </div>
                </form>
                <!-- "Maqola qo'shish" tugmasi modal oynani chaqiradi -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createArticleModal">
                    Maqola qo'shish
                </button>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Maqola nomi</th>
                            <th>Fayl</th>
                            <th>Jurnal nomi</th>
                            <th>Chop etilgan sana</th>
                            <th>Harakatlar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($articles as $article)
                            <tr>
                                <td>{{ $article->id }}</td>
                                <td>{{ $article->name }}</td>
                                <td>
                                @if($article->file)
                                  <a href="{{ asset('storage/' . $article->file) }}" download class="btn btn-primary btn-sm">
                                   Ko‘chirib olish
                                          </a>
                                      @else
                                 <span class="text-muted">Fayl yo‘q</span>
                                 @endif
                                </td>

                                <td>{{ $article->journal_name ?? 'N/A' }}</td>
                                <td>{{ $article->published_date }}</td>
                                <td>
                                    <!-- Tahrirlash tugmasi: data atributlari orqali maqola ma'lumotlari uzatiladi -->
                                    <button type="button" class="btn btn-sm btn-warning" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editArticleModal"
                                        data-id="{{ $article->id }}"
                                        data-name="{{ $article->name }}"
                                        data-journal_name="{{ $article->journal_name }}"
                                        data-published_date="{{ $article->published_date }}"
                                        data-file="{{ $article->file ? asset('storage/' . $article->file) : '' }}">
                                        Tahrirlash
                                    </button>
                                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="d-inline">
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
                                <td colspan="6" class="text-center">Maqolalar topilmadi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Yangi Maqola Qo'shish uchun Modal -->
<div class="modal fade" id="createArticleModal" tabindex="-1" aria-labelledby="createArticleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Sarlavhasi -->
            <div class="modal-header">
                <h5 class="modal-title" id="createArticleModalLabel">Yangi Maqola Qo'shish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
            </div>
            <!-- Modal Formasi -->
            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!-- Maqola nomi -->
                    <div class="mb-3">
                        <label for="create_name" class="form-label">Maqola nomi</label>
                        <input type="text" class="form-control" id="create_name" name="name" placeholder="Maqola nomini kiriting" required>
                    </div>
                    <!-- Faylni yuklash -->
                    <div class="mb-3">
                        <label for="create_file" class="form-label">Faylni yuklash</label>
                        <input type="file" class="form-control" id="create_file" name="file" required>
                    </div>
                    <!-- Jurnal nomi -->
                    <div class="mb-3">
                        <label for="create_journal_name" class="form-label">Jurnal nomi</label>
                        <input type="text" class="form-control" id="create_journal_name" name="journal_name" placeholder="Jurnal nomini (ixtiyoriy)">
                    </div>
                    <!-- Chop etilgan sana -->
                    <div class="mb-3">
                        <label for="create_published_date" class="form-label">Chop etilgan sana</label>
                        <input type="date" class="form-control" id="create_published_date" name="published_date" required>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                    <button type="submit" class="btn btn-primary">Saqlash</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Maqolani Tahrirlash uchun Modal -->
<div class="modal fade" id="editArticleModal" tabindex="-1" aria-labelledby="editArticleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Sarlavhasi -->
            <div class="modal-header">
                <h5 class="modal-title" id="editArticleModalLabel">Maqolani Tahrirlash</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
            </div>
            <!-- Tahrirlash Formasi -->
            <form id="editArticleForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Maqola nomi -->
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Maqola nomi</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <!-- Faylni yangilash (ixtiyoriy) -->
                    <div class="mb-3">
                        <label for="edit_file" class="form-label">Faylni yuklash</label>
                        <input type="file" class="form-control" id="edit_file" name="file">
                        <small id="currentFileHelp" class="form-text text-muted"></small>
                    </div>
                    <!-- Jurnal nomi -->
                    <div class="mb-3">
                        <label for="edit_journal_name" class="form-label">Jurnal nomi</label>
                        <input type="text" class="form-control" id="edit_journal_name" name="journal_name">
                    </div>
                    <!-- Chop etilgan sana -->
                    <div class="mb-3">
                        <label for="edit_published_date" class="form-label">Chop etilgan sana</label>
                        <input type="date" class="form-control" id="edit_published_date" name="published_date" required>
                    </div>
                </div>
                <!-- Modal Footer -->
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
    var editArticleModalEl = document.getElementById('editArticleModal');
    editArticleModalEl.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // modalni chaqirgan tugma
        // Data atributlaridan maqola ma'lumotlarini olish
        var articleId = button.getAttribute('data-id');
        var articleName = button.getAttribute('data-name');
        var journalName = button.getAttribute('data-journal_name');
        var publishedDate = button.getAttribute('data-published_date');
        var fileUrl = button.getAttribute('data-file');

        // Modal formasi elementlarini olish
        var form = document.getElementById('editArticleForm');
        // Formaning action atributini maqola ID'siga moslab yangilaymiz
        form.action = '/articles/' + articleId;

        // Inputlarni to'ldirish
        document.getElementById('edit_name').value = articleName;
        document.getElementById('edit_journal_name').value = journalName;
        document.getElementById('edit_published_date').value = publishedDate;

        // Agar joriy fayl mavjud bo'lsa, uni kichik havola ko'rinishida ko'rsatamiz
        var currentFileHelp = document.getElementById('currentFileHelp');
        if (fileUrl) {
            currentFileHelp.innerHTML = 'Joriy fayl: <a href="' + fileUrl + '" target="_blank">Ko\'rish</a>';
        } else {
            currentFileHelp.textContent = 'Fayl mavjud emas.';
        }
    });
</script>
@endsection
