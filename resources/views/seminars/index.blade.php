@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Seminarlar Ro'yxati</h2>

    <!-- Yangi Seminar Qo'shish Tugmasi -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createSeminarModal">
        Yangi Seminar Qo'shish
    </button>

    <!-- Seminarlar Jadvali -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nomi</th>
                <th>Boshlanish Vaqti</th>
                <th>Tugash Vaqti</th>
                <th>Ma'ruzachi</th>
                <th>Batafsil</th>
                <th>Konferensiya</th>
                <th>Amallar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($seminars as $seminar)
                <tr>
                    <td>{{ $seminar->id }}</td>
                    <td>{{ $seminar->title }}</td>
                    <td>{{ $seminar->start_time }}</td>
                    <td>{{ $seminar->end_time ?? 'Nomalum' }}</td>
                    <td>{{ $seminar->speaker }}</td>
                    <td>{{ $seminar->details ?? 'Izoh mavjud emas' }}</td>
                    <td>{{ $seminar->conference->name ?? 'Nomalum' }}</td>
                    <td>
                        <!-- Tahrirlash tugmasi -->
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSeminarModal-{{ $seminar->id }}">
                            Tahrirlash
                        </button>

                        <!-- O'chirish tugmasi -->
                        <form action="{{ route('seminars.destroy', $seminar->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Rostdan ham o'chirmoqchimisiz?')">
                                O'chirish
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Tahrirlash uchun Modal -->
                <div class="modal fade" id="editSeminarModal-{{ $seminar->id }}" tabindex="-1" aria-labelledby="editSeminarModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Seminarni Tahrirlash</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('seminars.update', $seminar->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="title" class="form-label">Seminar Nomi</label>
                                        <input type="text" name="title" class="form-control" value="{{ $seminar->title }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="start_time" class="form-label">Boshlanish Vaqti</label>
                                        <input type="datetime-local" name="start_time" class="form-control" value="{{ $seminar->start_time }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="end_time" class="form-label">Tugash Vaqti</label>
                                        <input type="datetime-local" name="end_time" class="form-control" value="{{ $seminar->end_time }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="speaker" class="form-label">Ma'ruzachi</label>
                                        <input type="text" name="speaker" class="form-control" value="{{ $seminar->speaker }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="details" class="form-label">Batafsil</label>
                                        <textarea name="details" class="form-control">{{ $seminar->details }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="conference_id" class="form-label">Konferensiya</label>
                                        <select name="conference_id" class="form-control" required>
                                            @foreach($conferences as $conference)
                                                <option value="{{ $conference->id }}" {{ $seminar->conference_id == $conference->id ? 'selected' : '' }}>
                                                    {{ $conference->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Saqlash</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    <!-- Yangi Seminar Qo'shish Uchun Modal -->
    <div class="modal fade" id="createSeminarModal" tabindex="-1" aria-labelledby="createSeminarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Yangi Seminar Qo'shish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('seminars.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Seminar Nomi</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="start_time" class="form-label">Boshlanish Vaqti</label>
                            <input type="datetime-local" name="start_time" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="end_time" class="form-label">Tugash Vaqti</label>
                            <input type="datetime-local" name="end_time" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="speaker" class="form-label">Ma'ruzachi</label>
                            <input type="text" name="speaker" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="details" class="form-label">Batafsil</label>
                            <textarea name="details" class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="conference_id" class="form-label">Konferensiya</label>
                            <select name="conference_id" class="form-control" required>
                                @foreach($conferences as $conference)
                                    <option value="{{ $conference->id }}">{{ $conference->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Qo'shish</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
