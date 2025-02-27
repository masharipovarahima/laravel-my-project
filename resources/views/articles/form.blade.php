<div class="card shadow-sm">
    <div class="card-header">
        <h4 class="mb-0">{{ isset($article) ? 'Maqolani Tahrirlash' : 'Yangi Maqola Qo\'shish' }}</h4>
    </div>
    <div class="card-body">
        <form action="{{ isset($article) ? route('articles.update', $article->id) : route('articles.store') }}" 
              method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($article))
                @method('PUT')
            @endif

            <!-- Maqola nomi -->
            <div class="mb-3">
                <label for="name" class="form-label">Maqola nomi</label>
                <input type="text" class="form-control" id="name" name="name" 
                       value="{{ old('name', $article->name ?? '') }}" required>
            </div>

            <!-- Fayl yuklash -->
            <div class="mb-3">
                <label for="file" class="form-label">Faylni yuklash</label>
                <input type="file" class="form-control" id="file" name="file" {{ isset($article) ? '' : 'required' }}>
                @if(isset($article) && $article->file)
                    <div class="mt-2">
                        <small class="text-muted">Joriy fayl: 
                            <a href="{{ asset('storage/' . $article->file) }}" target="_blank">Ko'rish</a>
                        </small>
                    </div>
                @endif
            </div>

            <!-- Jurnal nomi -->
            <div class="mb-3">
                <label for="journal_name" class="form-label">Jurnal nomi</label>
                <input type="text" class="form-control" id="journal_name" name="journal_name" 
                       value="{{ old('journal_name', $article->journal_name ?? '') }}">
            </div>

            <!-- Chop etilgan sana -->
            <div class="mb-3">
                <label for="published_date" class="form-label">Chop etilgan sana</label>
                <input type="date" class="form-control" id="published_date" name="published_date" 
                       value="{{ old('published_date', $article->published_date ?? '') }}" required>
            </div>

            <!-- Form tugmalari -->
            <div class="d-flex justify-content-end">
                <a href="{{ route('articles.index') }}" class="btn btn-secondary me-2">Bekor qilish</a>
                <button type="submit" class="btn btn-primary">
                    {{ isset($article) ? 'Yangilash' : 'Saqlash' }}
                </button>
            </div>
        </form>
    </div>
</div>
