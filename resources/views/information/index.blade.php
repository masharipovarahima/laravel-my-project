@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <h4>Ma'lumotlar Ro'yxati</h4>
            <a href="{{ route('information.create') }}" class="btn btn-success">Yangi Ma'lumot Qo'shish</a>
        </div>
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Manzil</th>
                            <th>Telefon</th>
                            <th>Email</th>
                            <th>Harakatlar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($informations as $information)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $information->address ?? '-' }}</td>
                                <td>{{ $information->phone ?? '-' }}</td>
                                <td>{{ $information->email ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('information.edit', $information) }}"
                                        class="btn btn-primary btn-sm">Tahrirlash</a>
                                    <form action="{{ route('information.destroy', $information) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Haqiqatan ham ochirishni xohlaysizmi?')">O'chirish</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Hech qanday ma'lumot topilmadi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- University Location Map -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5 class="mb-3">Universitet joylashuvi</h5>
                <div id="map" style="height: 400px;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1609.9273416444214!2d60.631674696173725!3d41.57038426143776!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x41dfcec63d012a49%3A0xa2280e571ee2fa3e!2sMuhammad%20al-Xorazmiy%20nomidagi%20Toshkent%20axborot%20texnologiyalari%20universiteti%20Urganch%20filiali!5e1!3m2!1sru!2s!4v1742289452181!5m2!1sru!2s" width="90%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                </div>
            </div>
        </div>
    </div>

    <script>
        function initMap() {
            var universityLocation = { lat: 48.214, lng: 11.652 }; // Universitet koordinatalarini o'zgartiring
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: universityLocation
            });
            var marker = new google.maps.Marker({
                position: universityLocation,
                map: map
            });
        }
    </script>
    @vite(['resources/js/app.js'])
  @endsection
