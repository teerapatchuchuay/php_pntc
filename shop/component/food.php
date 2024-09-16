<button type="button" class = "btn btn-success rounded-pill" data-bs-toggle = "modal" data-bs-target = "#m">เพิ่มอาหาร</button>
<div class="modal fade" id = "m" data-bs-backdrop = "static" tabindex = "-1">
    <form action="" method="post" enctype = "multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="fw-bold fs-5">เพิ่มอาหารภายในร้าน</p>
                </div>
                <div class="modal-body">
                    <input type="text" name="namef" placeholder = "ชื่ออาหาร" class="form-control mb-2" required>
                    <input type="text" name="price" placeholder = "ราคาอาหาร" class="form-control mb-2" required>
                    <select name="dis" id="" class="form-control mb-2">
                        <option value="0">--เลือกส่วนลด--</option>
                        <option value="5">5 %</option>
                        <option value="10">10 %</option>
                        <option value="15">15 %</option>
                    </select>
                    <select name="type_f" id="" class="form-control mb-2">
                        <option selected>--เลือกประเภทร้าน--</option>
                        <?php
                            $db2 = new db();
                            $result2 = $db2->select("type_f","*","WHERE id_rest = $userid");
                            while($fetch2 = $result2->fetch_object()){
                        ?>
                            <option value="<?= $fetch2->id_typef ?>"><?= $fetch2->name_typef ?></option>
                        <?php } ?>
                    </select>
                    <input type="file" name="img" class = "form-control mb-2" id="">
                </div>
                <div class="modal-footer">
                    <button type="button" class = "btn btn-secondary" data-bs-dismiss = "modal">Close</button>
                    <button type="submit" class = "btn btn-success" name = "save">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>