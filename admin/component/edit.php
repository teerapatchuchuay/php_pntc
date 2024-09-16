<button type="button" class = "btn btn-warning text-white rounded-pill" data-bs-toggle = "modal" data-bs-target = "#m<?= $fetch->id_typerest ?>">แก้ไข</button>
<div class="modal fade" id = "m<?= $fetch->id_typerest ?>" data-bs-backdrop = "static" tabindex = "-1">
    <form action="" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="fw-bold fs-5">แก้ไขประเภทร้านอาหาร</p>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value = "<?= $fetch->id_typerest ?>">
                    <input type="text" name="nametype" value = "<?= $fetch->name_typerest ?>" placeholder = "ชื่อประเภทร้านอาหาร" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class = "btn btn-secondary" data-bs-dismiss = "modal">Close</button>
                    <button type="submit" class = "btn btn-warning text-white" name = "edit">Edit</button>
                </div>
            </div>
        </div>
    </form>
</div>