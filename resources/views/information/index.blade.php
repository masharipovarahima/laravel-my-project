@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Ma'lumotlar Ro'yxati</h2>
    
    <!-- Yangi ma'lumot qo'shish tugmasi -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addInformationModal">
        Yangi Ma'lumot Qo'shish
    </button>

    <table class="table table-bordered mt-3">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Directions Info</th>
                <th>Position Title</th>
                <th>Position Description</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Group Address</th>
                <th>Location</th>
                <th>Amallar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($informations as $information)
            <tr>
                <td>{{ $information->id }}</td>
                <td>{{ $information->directions_info }}</td>
                <td>{{ $information->position_title }}</td>
                <td>{{ $information->position_description }}</td>
                <td>{{ $information->address }}</td>
                <td>{{ $information->phone }}</td>
                <td>{{ $information->email }}</td>
                <td>{{ $information->group_address }}</td>
                <td>{{ $information->latitude }}, {{ $information->longitude }}</td>
                <td>
                    <!-- Tahrirlash tugmasi -->
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $information->id }}">Tahrirlash</button>
                    
                    <!-- O'chirish tugmasi -->
                    <form action="{{ route('information.destroy', $information->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Rostdan ham o\'chirmoqchimisiz?')">O'chirish</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Qo'shish Modal Oynasi -->
<div class="modal fade" id="addInformationModal" tabindex="-1" aria-labelledby="addInformationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addInformationModalLabel">Yangi Ma'lumot Qo'shish</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Yopish">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('information.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Directions Info:</label>
                        <input type="text" name="directions_info" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Position Title:</label>
                        <input type="text" name="position_title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Position Description:</label>
                        <textarea name="position_description" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Address:</label>
                        <input type="text" name="address" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Phone:</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Group Address:</label>
                        <input type="text" name="group_address" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Latitude:</label>
                        <input type="text" name="latitude" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Longitude:</label>
                        <input type="text" name="longitude" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Saqlash</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
