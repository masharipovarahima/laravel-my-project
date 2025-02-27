<!-- resources/views/degrees/delete.blade.php -->
<div class="modal fade" id="deleteDegreeModal" tabindex="-1" aria-labelledby="deleteDegreeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Sarlavhasi -->
            <div class="modal-header">
                <h5 class="modal-title" id="deleteDegreeModalLabel">Degree ni O'chirish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
            </div>
            <!-- Modal Tanlangan Qism -->
            <div class="modal-body">
                <p>Rostdan ham ushbu degree ni o'chirmoqchimisiz?</p>
            </div>
            <!-- Modal Footer: Tasdiqlash Formasi -->
            <div class="modal-footer">
                <form id="deleteDegreeForm" action="" method="POST">
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
    document.getElementById('deleteDegreeModal').addEventListener('show.bs.modal', function (event) {
        // Modalni chaqirgan tugma
        var button = event.relatedTarget;
        // Degree ID'sini data-id atributidan olish
        var degreeId = button.getAttribute('data-id');
        // Formani olish
        var form = document.getElementById('deleteDegreeForm');
        // Formaning action atributini yangilash, masalan: /degrees/5
        form.action = '/degrees/' + degreeId;
    });
</script>
