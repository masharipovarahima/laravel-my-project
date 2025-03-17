@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h4 class="mb-4">Yangi Ma'lumot Qo'shish</h4>

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

        <!-- Information Form -->
        <form action="{{ route('information.store') }}" method="POST">
            @csrf
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="directions_info" class="form-label">Yo'nalish Ma'lumoti</label>
                            <input type="text" name="directions_info" class="form-control"
                                value="{{ old('directions_info') }}">
                            @error('directions_info')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="position_title" class="form-label">Lavozim Nomi</label>
                            <input type="text" name="position_title" class="form-control"
                                value="{{ old('position_title') }}">
                            @error('position_title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="position_description" class="form-label">Lavozim Tavsifi</label>
                            <textarea name="position_description" class="form-control" rows="3">{{ old('position_description') }}</textarea>
                            @error('position_description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="address" class="form-label">Manzil</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Telefon</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="group_address" class="form-label">Guruh Manzili</label>
                            <input type="text" name="group_address" class="form-control"
                                value="{{ old('group_address') }}">
                            @error('group_address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="latitude" class="form-label">Kenglik (Latitude)</label>
                            <input type="number" step="any" name="latitude" class="form-control"
                                value="{{ old('latitude') }}">
                            @error('latitude')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="longitude" class="form-label">Uzunlik (Longitude)</label>
                            <input type="number" step="any" name="longitude" class="form-control"
                                value="{{ old('longitude') }}">
                            @error('longitude')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Submission Buttons -->
            <div class="text-end">
                <a href="{{ route('information.index') }}" class="btn btn-secondary">Bekor qilish</a>
                <button type="submit" class="btn btn-primary">Saqlash</button>
            </div>
        </form>
    </div>
@endsection
