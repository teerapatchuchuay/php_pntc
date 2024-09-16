<button type="button" class = "btn btn-success rounded-pill" data-bs-toggle = "modal" data-bs-target = "#m">สร้างประเภท</button>
<div class="modal fade" id = "m" data-bs-backdrop = "static" tabindex = "-1">
    <form action="" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="fw-bold fs-5">สร้างประเภทร้านอาหาร</p>
                </div>
                <div class="modal-body">
                    <input type="text" name="nametype" placeholder = "ชื่อประเภทร้านอาหาร" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class = "btn btn-secondary" data-bs-dismiss = "modal">Close</button>
                    <button type="submit" class = "btn btn-success" name = "save">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>