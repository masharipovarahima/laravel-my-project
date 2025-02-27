@extends('layouts.app')

@section('content')
    <div class="container my-4">
        <!-- Muvaffaqiyatli xabarlarni ko'rsatish -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Fayllar ro'yxati uchun Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Fayllar ro'yxati</h4>
                <!-- "Yangi Fayl Yuklash" tugmasi modal oynani chaqiradi -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#uploadFileModal">
                    Yangi Fayl Yuklash
                </button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Fayl</th>
                                <th>Fan Nomi</th>
                                <th>Harakatlar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($files as $file)
                                <tr>
                                    <td>{{ $file->id }}</td>
                                    <td>
                                        @if ($file->file_url)
                                            <a href="{{ asset('storage/' . $file->file_url) }}" target="_blank">Ko'rish</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $file->subject?->name ?? 'Noma’lum fan' }}</td>
                                    <td>
                                        <!-- Yuklab olish tugmasi -->
                                        <a href="{{ route('files.download', $file->id) }}"
                                            class="btn btn-sm btn-info">Yuklab
                                            olish</a>

                                        <!-- O'chirish tugmasi -->
                                        <form action="{{ route('files.destroy', $file->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Rostdan ham faylni o‘chirmoqchimisiz?')">
                                                O'chirish
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Fayllar topilmadi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Yangi Fayl Yuklash uchun Modal Oyna -->
    <div class="modal fade" id="uploadFileModal" tabindex="-1" aria-labelledby="uploadFileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Sarlavhasi -->
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadFileModalLabel">Yangi Fayl Yuklash</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                </div>

                <!-- Modal Formasi -->
                <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="file" class="form-label">Fayl yuklash:</label>
                            <input type="file" class="form-control" id="file" name="file" required>
                        </div>

                        <!-- Fan tanlash (dropdown) -->
                        <div class="mb-3">
                            <label for="subject_name" class="form-label">Fan tanlang</label>
                            <select class="form-control" id="subject_name" name="subject_id" required>
                                <option value="">Fan tanlang</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                        <button type="submit" class="btn btn-primary">Yuklash</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>
@endsection
