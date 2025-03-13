<!DOCTYPE html>
<html lang="en">
<head>
    <title>Seminar Tafsilotlari</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Seminar Tafsilotlari</h2>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">{{ $seminar->name }}</h5>
            <p><strong>Sana:</strong> {{ $seminar->date }}</p>
            <p><strong>Tavsif:</strong> {{ $seminar->description ?? 'Tavsif mavjud emas.' }}</p>
            <p><strong>Konferensiya:</strong> {{ $seminar->conference->name ?? 'Noma’lum' }}</p>
        </div>
    </div>

    <a href="{{ route('seminars.index') }}" class="btn btn-secondary mt-3">Orqaga</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
