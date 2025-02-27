@extends('layouts.app')
@include('teachers.form')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Yangi o'qituvchi qo'shish</h4> 
        </div>
        <div class="card-body">
            <form action="{{ route('teachers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Ism -->
                <div class="mb-3">
                    <label for="name" class="form-label">Ism</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="O'qituvchining ismi" required>
                </div>
                <!-- Familiya -->
                <div class="mb-3">
                    <label for="surname" class="form-label">Familiya</label>
                    <input type="text" class="form-control" id="surname" name="surname" placeholder="O'qituvchining familiyasi" required>
                </div>
                <!-- Tug'ilgan Sana -->
                <div class="mb-3">
                    <label for="birthday" class="form-label">Tug'ilgan Sana</label>
                    <input type="date" class="form-control" id="birthday" name="birthday" required>
                </div>
                <!-- Mutaxassislik -->
                <div class="mb-3">
                    <label for="specialist" class="form-label">Mutaxassislik</label>
                    <input type="text" class="form-control" id="specialist" name="specialist" placeholder="Mutaxassislik" required>
                </div>
                <!-- Diplom Raqami -->
                <div class="mb-3">
                    <label for="diplom_number" class="form-label">Diplom Raqami</label>
                    <input type="text" class="form-control" id="diplom_number" name="diplom_number" placeholder="Diplom raqami" required>
                </div>
                <!-- Rasm yuklash -->
                <div class="mb-3">
                    <label for="image" class="form-label">Rasm yuklash</label>
                    <input type="file" class="form-control" id="image" name="image_url">
                </div>
                <!-- Manzil -->
                <div class="mb-3">
                    <label for="address" class="form-label">Manzil</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Manzil" required>
                </div>
                <!-- Telefon -->
                <div class="mb-3">
                    <label for="phone" class="form-label">Telefon</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefon raqami" required>
                </div>
                <!-- Telegram -->
                <div class="mb-3">
                    <label for="telegram" class="form-label">Telegram</label>
                    <input type="text" class="form-control" id="telegram" name="telegram" placeholder="Telegram username">
                </div>
                <!-- Instagram -->
                <div class="mb-3">
                    <label for="instagram" class="form-label">Instagram</label>
                    <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Instagram username">
                </div>
                <!-- Haqida -->
                <div class="mb-3">
                    <label for="about" class="form-label">Haqida</label>
                    <textarea class="form-control" id="about" name="about" rows="3" placeholder="O'qituvchi haqida qisqacha ma'lumot"></textarea>
                </div>
                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email manzili" required>
                </div>
                <!-- Binodagi Xona -->
                <div class="mb-3">
                    <label for="building_room" class="form-label">Binodagi Xona</label>
                    <input type="text" class="form-control" id="building_room" name="building_room" placeholder="Xona raqami">
                </div>
                <button type="submit" class="btn btn-primary">Saqlash</button>
            </form>
        </div>
    </div>
</div>
@endsection
