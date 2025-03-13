@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Konferensiya Tafsilotlari</h2>

    <!-- Ortga qaytish tugmasi -->
    <a href="{{ route('conferences.index') }}" class="btn btn-secondary mb-3">Ortga qaytish</a>

    <!-- Konferensiyani ko'rish kartochkasi -->
    <div class="card">
        <div class="card-header">{{ $conference->name }}</div>
        <div class="card-body">
            <p><strong>Boshlanish sanasi:</strong> {{ $conference->start_date }}</p>
            <p><strong>Tugash sanasi:</strong> {{ $conference->end_date ?? 'Korsatilmadi' }}</p>
            <p><strong>Joylashuv:</strong> {{ $conference->location }}</p>
            <p><strong>Tavsif:</strong> {{ $conference->description ?? 'Tavsif mavjud emas' }}</p>
        </div>
    </div>

    <!-- Seminarlar ro'yxati -->
    <h4 class="mt-4">Seminarlar</h4>
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addSeminarModal">Yangi Seminar Qo'shish</button>

    @if ($conference->seminars->isEmpty())
        <p>Seminarlar mavjud emas.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nomi</th>
                        <th>Sana</th>
                        <th>Tavsif</th>
                        <th>Harakatlar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($conference->seminars as $seminar)
                        <tr>
                            <td>{{ $seminar->name }}</td>
                            <td>{{ $seminar->date }}</td>
                            <td>{{ $seminar->description ?? 'Tavsif mavjud emas' }}</td>
                            <td>
                                <!-- Seminarni tahrirlash tugmasi -->
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editSeminarModal{{ $seminar->id }}">Tahrirlash</button>

                                <!-- Seminarni o'chirish tugmasi -->
                                <form action="{{ route('seminars.destroy', $seminar->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Rostdan ham o'chirmoqchimisiz?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">O'chirish</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Seminarni tahrirlash uchun Modal -->
                        <div class="modal fade" id="editSeminarModal{{ $seminar->id }}" tabindex="-1" aria-labelledby="editSeminarLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Seminarni Tahrirlash</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                                    </div>
                                    <form action="{{ route('seminars.update', $seminar->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nomi</label>
                                                <input type="text" name="name" class="form-control" value="{{ $seminar->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="date" class="form-label">Sana</label>
                                                <input type="date" name="date" class="form-control" value="{{ $seminar->date }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Tavsif</label>
                                                <textarea name="description" class="form-control">{{ $seminar->description }}</textarea>
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
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- Yangi Seminar Qo'shish Modal -->
    <div class="modal fade" id="addSeminarModal" tabindex="-1" aria-labelledby="addSeminarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSeminarLabel">Yangi Seminar Qo'shish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                </div>
                <form action="{{ route('seminars.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="conference_id" value="{{ $conference->id }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nomi</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Sana</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Tavsif</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                        <button type="submit" class="btn btn-success">Saqlash</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
