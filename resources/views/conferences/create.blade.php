@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h4 class="mb-4">Yangi Konferensiya Qo'shish</h4>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Conference Form -->
        <form action="{{ route('conferences.store') }}" method="POST">
            @csrf
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nomi</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="start_date" class="form-label">Boshlanish sanasi</label>
                            <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}"
                                required>
                            @error('start_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="end_date" class="form-label">Tugash sanasi</label>
                            <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}">
                            @error('end_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="location" class="form-label">Joylashuv</label>
                            <input type="text" name="location" class="form-control" value="{{ old('location') }}"
                                required>
                            @error('location')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="description" class="form-label">Tavsif</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seminars Section -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="mb-3">Seminarlar</h5>
                    <div id="seminars-container-create">
                        <!-- Dynamic seminar fields will be added here via JavaScript -->
                    </div>
                    <button type="button" class="btn btn-secondary mt-2" id="add-seminar-create">Yangi Seminar
                        Qo'shish</button>
                </div>
            </div>

            <!-- Form Submission Buttons -->
            <div class="text-end">
                <a href="{{ route('conferences.index') }}" class="btn btn-secondary">Bekor qilish</a>
                <button type="submit" class="btn btn-primary">Saqlash</button>
            </div>
        </form>
    </div>

    <!-- JavaScript for Dynamic Seminar Fields -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const seminarsContainer = document.getElementById('seminars-container-create');
            let seminarCount = 0;

            // Function to add new seminar row
            window.addSeminar = function(initialData = {}) {
                const index = seminarCount++;
                const seminarHtml = `
                    <div class="seminar-row mb-3 p-3 border rounded">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Sarlavha</label>
                                <input type="text" name="seminars[${index}][title]" class="form-control" value="${initialData.title || ''}" required>
                                <div class="text-danger seminar-error" data-field="seminars.${index}.title"></div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Boshlanish vaqti</label>
                                <input type="datetime-local" name="seminars[${index}][start_time]" class="form-control" value="${initialData.start_time || ''}" required>
                                <div class="text-danger seminar-error" data-field="seminars.${index}.start_time"></div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Tugash vaqti</label>
                                <input type="datetime-local" name="seminars[${index}][end_time]" class="form-control" value="${initialData.end_time || ''}">
                                <div class="text-danger seminar-error" data-field="seminars.${index}.end_time"></div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Ma'ruzachi</label>
                                <input type="text" name="seminars[${index}][speaker]" class="form-control" value="${initialData.speaker || ''}" required>
                                <div class="text-danger seminar-error" data-field="seminars.${index}.speaker"></div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">Tafsilotlar</label>
                                <input type="text" name="seminars[${index}][details]" class="form-control" value="${initialData.details || ''}">
                                <div class="text-danger seminar-error" data-field="seminars.${index}.details"></div>
                            </div>
                            <div class="col-md-1 mb-3 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-sm remove-seminar">O'chirish</button>
                            </div>
                        </div>
                    </div>
                `;
                seminarsContainer.insertAdjacentHTML('beforeend', seminarHtml);

                // Add remove event listener
                document.querySelectorAll('.remove-seminar').forEach(button => {
                    button.addEventListener('click', function() {
                        this.closest('.seminar-row').remove();
                    });
                });
            };

            // Add seminar button click event
            document.getElementById('add-seminar-create').addEventListener('click', function() {
                addSeminar();
            });

            // Remove seminar button event delegation
            seminarsContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-seminar')) {
                    e.target.closest('.seminar-row').remove();
                }
            });

            // Repopulate seminar fields if there are validation errors
            @if (old('seminars'))
                @foreach (old('seminars') as $index => $seminar)
                    addSeminar({
                        title: "{{ $seminar['title'] ?? '' }}",
                        start_time: "{{ $seminar['start_time'] ?? '' }}",
                        end_time: "{{ $seminar['end_time'] ?? '' }}",
                        speaker: "{{ $seminar['speaker'] ?? '' }}",
                        details: "{{ $seminar['details'] ?? '' }}"
                    });
                @endforeach
            @else
                // Add one empty seminar row by default
                addSeminar();
            @endif

            // Display validation errors for seminars
            @if ($errors->any())
                @foreach ($errors->get('seminars.*') as $seminarIndex => $seminarErrors)
                    @foreach ($seminarErrors as $field => $error)
                        document.querySelector(`[data-field="seminars.${seminarIndex}.${field}"]`).textContent =
                            "{{ $error }}";
                    @endforeach
                @endforeach
            @endif
        });
    </script>
@endsection
