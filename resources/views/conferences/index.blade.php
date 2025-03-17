@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <h4>Konferensiyalar Ro'yxati</h4>
            <a href="{{ route('conferences.create') }}">
                <button class="btn btn-success">Yangi Konferensiya Qo'shish</button>
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nomi</th>
                            <th>Boshlanish sanasi</th>
                            <th>Tugash sanasi</th>
                            <th>Joylashuv</th>
                            <th>Tavsif</th>
                            <th>Harakatlar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($conferences as $conference)
                            <tr>
                                <td>{{ $conference->id }}</td>
                                <td>{{ $conference->name }}</td>
                                <td>{{ $conference->start_date }}</td>
                                <td>{{ $conference->end_date ?? '-' }}</td>
                                <td>{{ $conference->location }}</td>
                                <td>{{ $conference->description ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('conferences.edit', $conference) }}">

                                        <button class="btn btn-primary btn-sm">Tahrirlash</button>
                                    </a>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal-{{ $conference->id }}">O'chirish</button>
                                </td>
                            </tr>

                            <!-- Tahrirlash uchun Modal -->
                            <div class="modal fade" id="editConferenceModal{{ $conference->id }}" tabindex="-1"
                                aria-labelledby="editConferenceLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editConferenceLabel">Konferensiyani Tahrirlash</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Yopish"></button>
                                        </div>
                                        <form action="{{ route('conferences.update', $conference) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Nomi</label>
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ $conference->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="start_date" class="form-label">Boshlanish sanasi</label>
                                                    <input type="date" name="start_date" class="form-control"
                                                        value="{{ $conference->start_date }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="end_date" class="form-label">Tugash sanasi</label>
                                                    <input type="date" name="end_date" class="form-control"
                                                        value="{{ $conference->end_date }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="location" class="form-label">Joylashuv</label>
                                                    <input type="text" name="location" class="form-control"
                                                        value="{{ $conference->location }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Tavsif</label>
                                                    <textarea name="description" class="form-control">{{ $conference->description }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Bekor qilish</button>
                                                <button type="submit" class="btn btn-primary">Saqlash</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- O'chirish uchun Modal -->
                            <div class="modal fade" id="deleteModal-{{ $conference->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Konferensiyani o'chirish</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>{{ $conference->name }}</strong> konferensiyasini o'chirmoqchimisiz?
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('conferences.destroy', $conference) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Bekor qilish</button>
                                                <button type="submit" class="btn btn-danger">Ha, O'chirish</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Hech qanday konferensiya topilmadi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Yangi Konferensiya Qo'shish Modal -->
        <div class="modal fade" id="createConferenceModal" tabindex="-1" aria-labelledby="createConferenceLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createConferenceLabel">Yangi Konferensiya Qo'shish</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                    </div>
                    <form action="{{ route('conferences.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nomi</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Boshlanish sanasi</label>
                                <input type="date" name="start_date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="end_date" class="form-label">Tugash sanasi</label>
                                <input type="date" name="end_date" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">Joylashuv</label>
                                <input type="text" name="location" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Tavsif</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Saqlash</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
