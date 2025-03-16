<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Ma'lumotlar Ro'yxati</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Ma'lumotlar Ro'yxati</h2>

        <a href="#" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addInfoModal">Yangi Ma'lumot Qo'shish</a>

        <table class="table table-bordered">
            <thead>
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
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editInfoModal{{ $information->id }}">Tahrirlash</a>
                            <form action="{{ route('information.destroy', $information->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Rostdan ham o'chirmoqchimisiz?')">O'chirish</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Tahrirlash oynasi -->
                    <div class="modal fade" id="editInfoModal{{ $information->id }}" tabindex="-1" aria-labelledby="editInfoModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editInfoModalLabel">Ma'lumotni Tahrirlash</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                                </div>
                                <form action="{{ route('information.update', $information->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        @include('information.form', ['information' => $information])
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Saqlash</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Qo'shish oynasi -->
    <div class="modal fade" id="addInfoModal" tabindex="-1" aria-labelledby="addInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addInfoModalLabel">Yangi Ma'lumot Qo'shish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                </div>
                <form action="{{ route('information.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        @include('information.form')
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Qo'shish</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>