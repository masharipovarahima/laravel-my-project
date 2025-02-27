@extends('layouts.app')

@section('content')
<div class="container my-4">
    <!-- Muvaffaqiyatli xabarlarni ko'rsatish -->
    @if(session('success'))
      <div class="alert alert-success">
         {{ session('success') }}
      </div>
    @endif

    <!-- Validatsiya xatoliklarini ko'rsatish -->
    @if($errors->any())
      <div class="alert alert-danger">
          <ul class="mb-0">
              @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif

    <!-- Fanlar ro'yxati uchun Card -->
    <div class="card shadow-sm mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
         <h4 class="mb-0">Fanlar Ro'yxati</h4>
         <div class="d-flex align-items-center">
             <!-- Qidiruv formasi -->
             <form action="{{ route('subjects.index') }}" method="GET" class="me-2">
                 <div class="input-group">
                     <input type="text" name="search" class="form-control" placeholder="Qidirish..." value="{{ request('search') }}">
                     <button type="submit" class="btn btn-outline-secondary">Qidirish</button>
                 </div>
             </form>
             <!-- "Yangi Fan Qo'shish" tugmasi modal oynani chaqiradi -->
             <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createSubjectModal">
                Yangi Fan Qo'shish
             </button>
         </div>
      </div>
      <div class="card-body p-0">
         <div class="table-responsive">
             <table class="table table-striped table-bordered mb-0">
                 <thead class="table-light">
                     <tr>
                         <th>ID</th>
                         <th>Fan nomi</th>
                         <th>Mutaxassislik</th>
                         <th>O'qituvchi ID</th>
                         <th>Harakatlar</th>
                     </tr>
                 </thead>
                 <tbody>
                     @forelse($subjects as $subject)
                         <tr>
                             <td>{{ $subject->id }}</td>
                             <td>{{ $subject->name }}</td>
                             <td>{{ $subject->specialist }}</td>
                             <td>{{ $subject->teacher_id }}</td>
                             <td>
                                 <!-- Tahrirlash tugmasi modalni chaqiradi -->
                                 <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editSubjectModal"
                                     data-id="{{ $subject->id }}"
                                     data-name="{{ $subject->name }}"
                                     data-specialist="{{ $subject->specialist }}"
                                     data-teacher_id="{{ $subject->teacher_id }}">
                                     Tahrirlash
                                 </button>
                                 <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" class="d-inline">
                                     @csrf
                                     @method('DELETE')
                                     <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Rostdan ham fanni o‘chirmoqchimisiz?')">
                                         O'chirish
                                     </button>
                                 </form>
                             </td>
                         </tr>
                     @empty
                         <tr>
                             <td colspan="5" class="text-center">Hech qanday fan topilmadi.</td>
                         </tr>
                     @endforelse
                 </tbody>
             </table>
         </div>
      </div>
    </div>
</div>

<!-- Yangi Fan Qo'shish uchun Modal (Create Modal) -->
<div class="modal fade" id="createSubjectModal" tabindex="-1" aria-labelledby="createSubjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createSubjectModalLabel">Yangi Fan Qo'shish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
            </div>
            <form action="{{ route('subjects.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Fan nomi -->
                    <div class="mb-3">
                        <label for="create_name" class="form-label">Fan nomi</label>
                        <input type="text" class="form-control" id="create_name" name="name" placeholder="Fan nomini kiriting" required>
                    </div>
                    <!-- Mutaxassislik -->
                    <div class="mb-3">
                        <label for="specialist" class="form-label">Mutaxassislik</label>
                        <input type="text" class="form-control" id="specialist" name="specialist" placeholder="Mutaxassislikni kiriting" required>
                    </div>
                    <!-- O'qituvchi ID -->
                    <div class="mb-3">
                        <label for="teacher_id" class="form-label">O'qituvchi ID</label>
                        <input type="number" class="form-control" id="teacher_id" name="teacher_id" placeholder="O'qituvchi ID ni kiriting" required>
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

<!-- Fan Tahrirlash uchun Modal (Edit Modal) -->
<div class="modal fade" id="editSubjectModal" tabindex="-1" aria-labelledby="editSubjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSubjectModalLabel">Fan Tahrirlash</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
            </div>
            <form id="editSubjectForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Fan nomi -->
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Fan nomi</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <!-- Mutaxassislik -->
                    <div class="mb-3">
                        <label for="edit_specialist" class="form-label">Mutaxassislik</label>
                        <input type="text" class="form-control" id="edit_specialist" name="specialist" placeholder="Mutaxassislikni kiriting" required>
                    </div>
                    <!-- O'qituvchi ID -->
                    <div class="mb-3">
                        <label for="edit_teacher_id" class="form-label">O'qituvchi ID</label>
                        <input type="number" class="form-control" id="edit_teacher_id" name="teacher_id" placeholder="O'qituvchi ID ni kiriting" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                    <button type="submit" class="btn btn-success">Yangilash</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript: Edit Modal ma'lumotlarini dinamik to'ldirish -->
<script>
    var editSubjectModalEl = document.getElementById('editSubjectModal');
    editSubjectModalEl.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget; // Modalni chaqirgan tugma
        var subjectId = button.getAttribute('data-id');
        var subjectName = button.getAttribute('data-name');
        var subjectSpecialist = button.getAttribute('data-specialist');
        var subjectTeacherId = button.getAttribute('data-teacher_id');

        // Formaning action atributini yangilash
        var form = document.getElementById('editSubjectForm');
        form.action = '/subjects/' + subjectId;

        // Inputlarni to'ldirish
        document.getElementById('edit_name').value = subjectName;
        document.getElementById('edit_specialist').value = subjectSpecialist;
        document.getElementById('edit_teacher_id').value = subjectTeacherId;
    });
</script>
@endsection
