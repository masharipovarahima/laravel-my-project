<!-- resources/views/files/delete.blade.php -->
<div class="modal fade" id="deleteFileModal" tabindex="-1" aria-labelledby="deleteFileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Sarlavhasi -->
            <div class="modal-header">
                <h5 class="modal-title" id="deleteFileModalLabel">Faylni O'chirish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
            </div>

            <!-- Modal Tanlangan Qism -->
            <div class="modal-body">
                <p id="deleteFileMessage">Rostdan ham ushbu faylni o'chirmoqchimisiz?</p>
            </div>

            <!-- Modal Footer: Tasdiqlash Formasi -->
            <div class="modal-footer">
                <form id="deleteFileForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                    <button type="submit" class="btn btn-danger">O'chirish</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript: Modal ochilganda form action atributini va fayl nomini dinamik o'rnatish -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var deleteModal = document.getElementById('deleteFileModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            // Modalni chaqirgan tugmani olish
            var button = event.relatedTarget;

            // Fayl nomini olish
            var fileName = button.getAttribute('data-name');

            // Formani yangilash
            var form = document.getElementById('deleteFileForm');
            form.action = `/files/${encodeURIComponent(fileName)}`;

            // Fayl nomini modalda ko'rsatish
            var message = document.getElementById('deleteFileMessage');
            message.textContent = `"${fileName}" faylini o'chirmoqchimisiz?`;
        });
    });
</script>
