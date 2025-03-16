<div id="editModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editModal')">&times;</span>
        <h2>Ma'lumotni Tahrirlash</h2>

        <form id="editForm" action="" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" id="edit_id" name="id">

            <label for="edit_directions_info">Directions Info:</label>
            <input type="text" id="edit_directions_info" name="directions_info" required><br>

            <label for="edit_position_title">Position Title:</label>
            <input type="text" id="edit_position_title" name="position_title"><br>

            <label for="edit_position_description">Position Description:</label>
            <textarea id="edit_position_description" name="position_description"></textarea><br>

            <label for="edit_address">Address:</label>
            <input type="text" id="edit_address" name="address" required><br>

            <label for="edit_phone">Phone:</label>
            <input type="text" id="edit_phone" name="phone" required><br>

            <label for="edit_email">Email:</label>
            <input type="email" id="edit_email" name="email" required><br>

            <label for="edit_group_address">Group Address:</label>
            <input type="text" id="edit_group_address" name="group_address" required><br>

            <label for="edit_latitude">Latitude:</label>
            <input type="text" id="edit_latitude" name="latitude" required><br>

            <label for="edit_longitude">Longitude:</label>
            <input type="text" id="edit_longitude" name="longitude" required><br>

            <button type="submit">Saqlash</button>
        </form>
    </div>
</div>

<script>
    function openEditModal(info) {
        document.getElementById('edit_id').value = info.id;
        document.getElementById('edit_directions_info').value = info.directions_info;
        document.getElementById('edit_position_title').value = info.position_title || '';
        document.getElementById('edit_position_description').value = info.position_description || '';
        document.getElementById('edit_address').value = info.address;
        document.getElementById('edit_phone').value = info.phone;
        document.getElementById('edit_email').value = info.email;
        document.getElementById('edit_group_address').value = info.group_address;
        document.getElementById('edit_latitude').value = info.latitude;
        document.getElementById('edit_longitude').value = info.longitude;

        document.getElementById('editForm').action = '/information/' + info.id;

        openModal('editModal');
    }
</script>
