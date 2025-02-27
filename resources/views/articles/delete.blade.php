<!-- resources/views/articles/delete.blade.php -->
<div class="modal fade" id="deleteArticleModal" tabindex="-1" aria-labelledby="deleteArticleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Sarlavhasi -->
            <div class="modal-header">
                <h5 class="modal-title" id="deleteArticleModalLabel">Maqolani O'chirish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
            </div>
            <!-- Modal Tanlangan Qism -->
            <div class="modal-body">
                <p>Rostdan ham ushbu maqolani o'chirmoqchimisiz?</p>
            </div>
            <!-- Modal Footer: Tasdiqlash Formasi -->
            <div class="modal-footer">
                <form id="deleteArticleForm" action="" method="POST">
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
    var deleteArticleModal = document.getElementById('deleteArticleModal');
    deleteArticleModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Modalni chaqirgan tugma
        var articleId = button.getAttribute('data-id'); // Maqola ID sini olish
        var form = document.getElementById('deleteArticleForm');
        // Formaning action atributini yangilaymiz (masalan: /articles/5)
        form.action = '/articles/' + articleId;
    });
</script>
