@extends('layouts.app')

@section('content')
    <div class="container my-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">O'qituvchilar ro'yxati</h4>
                <form action="{{ route('teachers.index') }}" method="GET">
                    <div class="d-flex">
                        <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                            class="form-control me-2" placeholder="Qidirish...">
                        <button type="submit" class="btn btn-primary" onclick="searchTable()">Qidirish</button>
                    </div>
                </form>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createTeacherModal">
                    O'qituvchi qo'shish
                </button>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Ism</th>
                                <th>Familiya</th>
                                <th>Tug'ilgan sana</th>
                                <th>Mutaxassislik</th>
                                <th>Diplom raqami</th>
                                <th>Rasm</th>
                                <th>Telefon</th>
                                <th>Email</th>
                                <th>Manzil</th>
                                <th>Telegram</th>
                                <th>Instagram</th>
                                <th>Haqida</th>
                                <th>Xona</th>
                                <th>Harakatlar</th>
                            </tr>
                        </thead>
                        <tbody id="teacherTable">
                            @forelse($teachers as $teacher)
                                {{-- @dd($teacher); --}}
                                <tr>
                                    <td>{{ $teacher->id }}</td>
                                    <td>{{ $teacher->name }}</td>
                                    <td>{{ $teacher->surname }}</td>
                                    <td>{{ $teacher->birthday }}</td>
                                    <td>{{ $teacher->specialist }}</td>
                                    <td>{{ $teacher->diplom_number }}</td>
                                    <td>
                                        @if($teacher->image)

                                            {{-- Rasmni chiqarish --}}
                                            <img src="{{ asset($teacher->image) }}" alt="Rasm" style="width: 200px" class="img-thumbnail" width="100" height="100">
                                        @else
                                            <span class="text-muted">Rasm yo'q</span>
                                        @endif

                                    </td>

                                    <td>{{ $teacher->phone }}</td>
                                    <td>{{ $teacher->email }}</td>
                                    <td>{{ $teacher->address }}</td>
                                    <td>{{ $teacher->telegram ?? 'N/A' }}</td>
                                    <td>{{ $teacher->instagram ?? 'N/A' }}</td>
                                    <td>{{ $teacher->about ?? 'N/A' }}</td>
                                    <td>{{ $teacher->building_room ?? 'N/A' }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning mb-1 edit-btn" data-bs-toggle="modal"
                                            data-bs-target="#editTeacherModal" data-id="{{ $teacher->id }}"
                                            data-name="{{ $teacher->name }}" data-surname="{{ $teacher->surname }}"
                                            data-birthday="{{ $teacher->birthday }}"
                                            data-specialist="{{ $teacher->specialist }}"
                                            data-diplom_number="{{ $teacher->diplom_number }}"
                                            data-phone="{{ $teacher->phone }}" data-email="{{ $teacher->email }}"
                                            data-address="{{ $teacher->address }}" data-telegram="{{ $teacher->telegram }}"
                                            data-instagram="{{ $teacher->instagram }}" data-about="{{ $teacher->about }}"
                                            data-building_room="{{ $teacher->building_room }}"
                                            data-image="{{ asset($teacher->image) }}">
                                            Tahrirlash
                                        </button>


                                        <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Rostdan ham o‘chirmoqchimisiz?');">
                                                O'chirish
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="15" class="text-center">O'qituvchilar topilmadi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            function searchTable() {
                let searchValue = document.getElementById('searchInput').value.toLowerCase();
                let rows = document.querySelectorAll('#teacherTable tr');

                rows.forEach(row => {
                    let textContent = row.textContent.toLowerCase();
                    row.style.display = textContent.includes(searchValue) ? '' : 'none';
                });
            }
        </script>

    </div>
    </div>
    </div>
    <!-- O'qituvchi Qo'shish Modal -->
    <div class="modal fade" id="createTeacherModal" tabindex="-1" aria-labelledby="createTeacherModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTeacherModalLabel">Yangi O'qituvchi Qo'shish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('teachers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Ism</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Ism" required>
                            
                                <label for="surname" class="form-label mt-2">Familiya</label>
                                <input type="text" class="form-control" id="surname" name="surname" placeholder="Familiya" required>
                            
                                <label for="birthday" class="form-label mt-2">Tug'ilgan sana</label>
                                <input type="date" class="form-control" id="birthday" name="birthday" placeholder="Tug'ilgan sana" required>
                            
                                <label for="specialist" class="form-label mt-2">Mutaxassislik</label>
                                <input type="text" class="form-control" id="specialist" name="specialist" placeholder="Mutaxassislikni kiriting" required>
                            
                                <label for="diplom_number" class="form-label mt-2">Diplom raqami</label>
                                <input type="text" class="form-control" id="diplom_number" name="diplom_number" placeholder="Diplom raqami" required>
                            
                                <label for="phone" class="form-label mt-2">Telefon</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefon" required>
                            
                                <label for="email" class="form-label mt-2">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="address" class="form-label">Manzil</label>
                                <textarea class="form-control ckeditor" id="address" name="address" placeholder="Manzil" required></textarea>
                            
                                <label for="telegram" class="form-label mt-2">Telegram</label>
                                <textarea class="form-control ckeditor" id="telegram" name="telegram" placeholder="Telegram"></textarea>
                            
                                <label for="instagram" class="form-label mt-2">Instagram</label>
                                <textarea class="form-control ckeditor" id="instagram" name="instagram" placeholder="Instagram"></textarea>
                            
                                <label for="about" class="form-label mt-2">Haqida</label>
                                <textarea class="form-control ckeditor" id="about" name="about" placeholder="Haqida" required></textarea>
                            
                                <label for="building_room" class="form-label mt-2">Xona</label>
                                <input type="text" class="form-control" id="building_room" name="building_room" placeholder="Xona">
                            
                                <label for="image" class="form-label mt-2">Rasm</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                        <button type="submit" class="btn btn-success">Qo'shish</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- O'qituvchini Tahrirlash Modal -->
    <div class="modal fade" id="editTeacherModal" tabindex="-1" aria-labelledby="editTeacherModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTeacherModalLabel">O'qituvchini Tahrirlash</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                </div>
                <form id="editTeacherForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Ism</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            
                                <label for="surname" class="form-label mt-2">Familiya</label>
                                <input type="text" class="form-control" id="surname" name="surname" required>
                            
                                <label for="birthday" class="form-label mt-2">Tug'ilgan sana</label>
                                <input type="date" class="form-control" id="birthday" name="birthday" required>
                            
                                <label for="specialist" class="form-label mt-2">Mutaxassislik</label>
                                <input type="text" class="form-control" id="specialist" name="specialist" required>
                            
                                <label for="diplom_number" class="form-label mt-2">Diplom raqami</label>
                                <input type="text" class="form-control" id="diplom_number" name="diplom_number" required>
                            
                                <label for="phone" class="form-label mt-2">Telefon</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            
                                <label for="email" class="form-label mt-2">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="address" class="form-label">Manzil</label>
                                <textarea class="form-control ckeditor" id="address" name="address" rows="2"></textarea>
                            
                                <label for="telegram" class="form-label mt-2">Telegram</label>
                                <input type="text" class="form-control" id="telegram" name="telegram">
                            
                                <label for="instagram" class="form-label mt-2">Instagram</label>
                                <input type="text" class="form-control" id="instagram" name="instagram">
                            
                                <label for="about" class="form-label mt-2">Haqida</label>
                                <textarea class="form-control ckeditor" id="about" name="about" rows="3"></textarea>
                            
                                <label for="building_room" class="form-label mt-2">Xona</label>
                                <textarea class="form-control ckeditor" id="building_room" name="building_room" rows="1"></textarea>
                            
                                <label for="image" class="form-label mt-2">Rasm</label>
                                <input type="file" class="form-control" id="image" name="image_url">
                            </div>
                            
                                {{-- @dd(asset($teacher->image)) --}}
                                @if (!empty($teacher))
                                    <img id="image-preview2" src="{{ asset($teacher->image) }}" alt="Teacher Image" width="100"
                                        class="img-thumbnail mt-2">
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                        <button type="submit" class="btn btn-primary">Yangilash</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let editModal = document.getElementById('editTeacherModal');
            let editForm = document.getElementById('editTeacherForm');
    
            document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function () {
        let teacherId = this.getAttribute('data-id');
        editForm.action = "/teachers/" + teacherId;

        const form = document.getElementById('editTeacherForm');
        form.querySelector('#name').value = this.getAttribute('data-name');
        form.querySelector('#surname').value = this.getAttribute('data-surname');
        form.querySelector('#birthday').value = this.getAttribute('data-birthday');
        form.querySelector('#specialist').value = this.getAttribute('data-specialist');
        form.querySelector('#diplom_number').value = this.getAttribute('data-diplom_number');
        form.querySelector('#phone').value = this.getAttribute('data-phone');
        form.querySelector('#email').value = this.getAttribute('data-email');

        const address = this.getAttribute('data-address') || '';
        const telegram = this.getAttribute('data-telegram') || '';
        const instagram = this.getAttribute('data-instagram') || '';
        const about = this.getAttribute('data-about') || '';
        const buildingRoom = this.getAttribute('data-building_room') || '';

        // CKEditor instance'larini yangilash
        if (CKEDITOR.instances['address']) CKEDITOR.instances['address'].setData(address);
        if (CKEDITOR.instances['telegram']) CKEDITOR.instances['telegram'].setData(telegram);
        if (CKEDITOR.instances['instagram']) CKEDITOR.instances['instagram'].setData(instagram);
        if (CKEDITOR.instances['about']) CKEDITOR.instances['about'].setData(about);
        if (CKEDITOR.instances['building_room']) CKEDITOR.instances['building_room'].setData(buildingRoom);

        // Rasmni yangilash (agar mavjud bo‘lsa)
        const imageUrl = this.getAttribute('data-image');
        const imgPreview = document.getElementById('image-preview2');
        if (imageUrl && imgPreview) {
            imgPreview.src = imageUrl;
            imgPreview.style.display = 'block';
        } else if (imgPreview) {
            imgPreview.style.display = 'none';
        }
    });
});

        });
    
    </script>


    

@vite(['resources/js/app.js'])
@endsection