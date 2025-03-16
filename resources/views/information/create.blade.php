<!-- resources/views/information/create.blade.php -->

<div id="createModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal('createModal')">&times;</span>
        <h2>Yangi Ma'lumot Qo'shish</h2>

        <form action="{{ route('information.store') }}" method="POST">
            @csrf

            <label for="directions_info">Directions Info:</label>
            <input type="text" id="directions_info" name="directions_info" required>

            <label for="position_title">Position Title:</label>
            <input type="text" id="position_title" name="position_title">

            <label for="position_description">Position Description:</label>
            <textarea id="position_description" name="position_description"></textarea>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="group_address">Group Address:</label>
            <input type="text" id="group_address" name="group_address">

            <label for="latitude">Latitude:</label>
            <input type="text" id="latitude" name="latitude" required>

            <label for="longitude">Longitude:</label>
            <input type="text" id="longitude" name="longitude" required>

            <button type="submit">Saqlash</button>
        </form>
    </div>
</div>

<script>
    function openModal(modalId) {
        document.getElementById(modalId).style.display = 'block';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }
</script>
