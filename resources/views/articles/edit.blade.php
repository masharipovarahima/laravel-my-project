@extends('layouts.app')

@section('content')
<div class="container my-4">
    <!-- Modal: Maqolani tahrirlash formasi -->
    <div class="modal fade show d-block" id="editArticleModal" tabindex="-1" aria-labelledby="editArticleModalLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal sarlavhasi -->
                <div class="modal-header">
                    <h5 class="modal-title" id="editArticleModalLabel">Maqolani Tahrirlash</h5>
                    <!-- Modalni yopish: maqolalar ro'yxatiga qaytish -->
                    <a href="{{ route('articles.index') }}" class="btn-close" aria-label="Yopish"></a>
                </div>

                <!-- Tahrirlash formasi -->
                <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <!-- Maqola nomi -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Maqola nomi</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $article->name) }}" required>
                        </div>

                        <!-- Faylni yuklash -->
                        <div class="mb-3">
                            <label for="file" class="form-label">Faylni yuklash</label>
                            <input type="file" class="form-control" id="file" name="file">
                            @if($article->file)
    <div class="mt-2">
        <small class="text-muted">Joriy fayl: 
            <a href="{{ asset('storage/' . $article->file) }}" download class="btn btn-sm btn-success">
                Yuklab olish
            </a>
        </small>
    </div>
@endif

                        </div>

                        <!-- Jurnal nomi -->
                        <div class="mb-3">
                            <label for="journal_name" class="form-label">Jurnal nomi</label>
                            <input type="text" class="form-control" id="journal_name" name="journal_name" value="{{ old('journal_name', $article->journal_name) }}">
                        </div>

                        <!-- Chop etilgan sana -->
                        <div class="mb-3">
                            <label for="published_date" class="form-label">Chop etilgan sana</label>
                            <input type="date" class="form-control" id="published_date" name="published_date" value="{{ old('published_date', $article->published_date) }}" required>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <a href="{{ route('articles.index') }}" class="btn btn-secondary">Bekor qilish</a>
                        <button type="submit" class="btn btn-success">Yangilash</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal avtomatik ochilishi uchun script -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var editModalEl = document.getElementById('editArticleModal');
        var editModal = new bootstrap.Modal(editModalEl);
        editModal.show();
    });
</script>
@endsection
