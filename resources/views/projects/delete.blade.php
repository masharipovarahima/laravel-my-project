<!-- resources/views/subjects/delete.blade.php -->
<div class="modal fade" id="deleteSubjectModal" tabindex="-1" aria-labelledby="deleteSubjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Sarlavhasi -->
            <div class="modal-header">
                <h5 class="modal-title" id="deleteSubjectModalLabel">Fan O'chirish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
            </div>
            <!-- Modal Tanlangan Qism -->
            <div class="modal-body">
                <p>Rostdan ham ushbu fanni o'chirmoqchimisiz?</p>
            </div>
            <!-- Modal Footer: Tasdiqlash Formasi -->
            <div class="modal-footer">
                <form id="deleteSubjectForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                    <button type="submit" class="btn btn-danger">O'chirish</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript: Modal ochilganda form action atributini dinamik o'rnatish -->
<script>
    document.getElementById('deleteSubjectModal').addEventListener('show.bs.modal', function(event) {
        // Modalni chaqirgan tugma
        var button = event.relatedTarget;
        // Fan ID sini data-id atributidan olish
        var subjectId = button.getAttribute('data-id');
        // Formani olish
        var form = document.getElementById('deleteSubjectForm');
        // Formaning action atributini yangilash, masalan: /subjects/5
        form.action = '/subjects/' + subjectId;
    });
</script>
