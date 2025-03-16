@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Ma'lumotlar Ro'yxati</h2>
    
    <!-- Yangi ma'lumot qo'shish tugmasi -->
    <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addModal">Yangi Ma'lumot Qo'shish</button>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Yo'nalish Bo'yicha Ma'lumot</th>
                <th>Lavozim Nomi</th>
                <th>Lavozim Tavsifi</th>
                <th>Manzil</th>
                <th>Telefon</th>
                <th>Email</th>
                <th>Guruh Manzili</th>
                <th>Joylashuv (Kenglik, Uzunlik)</th>
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
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $information->id }}">Tahrirlash</button>
                    
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
<div class="modal fade" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yangi Ma'lumot Qo'shish</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('information.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Yo'nalish Ma'lumoti:</label>
                        <input type="text" name="directions_info" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Lavozim Nomi:</label>
                        <input type="text" name="position_title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Lavozim Tavsifi:</label>
                        <textarea name="position_description" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Manzil:</label>
                        <input type="text" name="address" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Telefon:</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Guruh Manzili:</label>
                        <input type="text" name="group_address" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Kenglik:</label>
                        <input type="text" name="latitude" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Uzunlik:</label>
                        <input type="text" name="longitude" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success">Saqlash</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
