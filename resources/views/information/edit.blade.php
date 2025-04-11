@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h4 class="mb-4">Ma'lumotni Tahrirlash</h4>

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
        <form action="{{ route('information.update', $information->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="address" class="form-label">Manzil</label>
                            <input type="text" name="address" class="form-control"
                                value="{{ old('address', $information->address) }}">
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Telefon</label>
                            <input type="text" name="phone" class="form-control"
                                value="{{ old('phone', $information->phone) }}">
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $information->email) }}">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="latitude" class="form-label">Kenglik (Latitude)</label>
                            <input type="number" step="any" name="latitude" class="form-control"
                                value="{{ old('latitude', $information->latitude) }}">
                            @error('latitude')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="longitude" class="form-label">Uzunlik (Longitude)</label>
                            <input type="number" step="any" name="longitude" class="form-control"
                                value="{{ old('longitude', $information->longitude) }}">
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