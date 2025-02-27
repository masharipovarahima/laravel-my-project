<div class="mb-3">
    <label for="name" class="form-label">Ism</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $teacher->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="surname" class="form-label">Familiya</label>
    <input type="text" class="form-control" id="surname" name="surname" value="{{ old('surname', $teacher->surname ?? '') }}" required>
</div>

<!-- Tug'ilgan sana -->
<div class="mb-3">
    <label for="birthday" class="form-label">Tug‘ilgan Sana</label>
    <input type="date" class="form-control" id="birthday" name="birthday" value="{{ old('birthday', $teacher->birthday ?? '') }}" required>
</div>

<!-- Mutaxassislik -->
<div class="mb-3">
    <label for="specialist" class="form-label">Mutaxassislik</label>
    <input type="text" class="form-control" id="specialist" name="specialist" value="{{ old('specialist', $teacher->specialist ?? '') }}" required>
</div>

<!-- Rasmni ko‘rsatish (Agar mavjud bo‘lsa) -->
@if(isset($teacher) && $teacher->image_url)
    <div class="mb-3">
        <label class="form-label">Joriy rasm</label>
        <br>
        <img src="{{ asset('storage/' . $teacher->image_url) }}" alt="O‘qituvchi rasmi" width="150">
    </div>
@endif

<!-- Rasm yuklash -->
<div class="mb-3">
    <label for="image_url" class="form-label">Rasm yuklash</label>
    <input type="file" class="form-control" id="image_url" name="image_url">
</div>
