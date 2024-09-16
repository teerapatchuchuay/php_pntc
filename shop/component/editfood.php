<button type="button" class = "btn btn-warning text-white rounded-pill" data-bs-toggle = "modal" data-bs-target = "#m<?= $fetch->id_f ?>">แก้ไข</button>
<div class="modal fade" id = "m<?= $fetch->id_f ?>" data-bs-backdrop = "static" tabindex = "-1">
    <form action="" method="post" enctype = "multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="fw-bold fs-5">แก้ไขอาหารภายในร้าน</p>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value = "<?= $fetch->id_f ?>">
                    <input type="text" name="namef" value = "<?= $fetch->name_f ?>" placeholder = "ชื่ออาหาร" class="form-control mb-2" required>
                    <input type="text" name="price" value = "<?= $fetch->price_f ?>" placeholder = "ราคาอาหาร" class="form-control mb-2" required>
                    <select name="dis" id="" class="form-control mb-2">
                        <option value = "<?= $fetch->discount_f ?>">--เลือกส่วนลด--</option>
                        <option value="0 ">0 %</option>
                        <option value="5 ">5 %</option>
                        <option value="10 ">10 %</option>
                        <option value="15 ">15 %</option>
                    </select>
                    <select name="type_f" id="" class="form-control mb-2">
                        <option value = "<?= $fetch->type_f ?>">--เลือกประเภทร้าน--</option>
                        <?php
                            $db2 = new db();
                            $result2 = $db2->select("type_f","*","WHERE id_rest = $userid");
                            while($fetch2 = $result2->fetch_object()){
                        ?>
                            <option value="<?= $fetch2->id_typef ?>"><?= $fetch2->name_typef ?></option>
                        <?php } ?>
                    </select>
                    <input type="hidden" name="imgold" value = "<?= $fetch->img_f ?>">
                    <input type="file" name="img" class = "form-control mb-2" id="">
                    <div class="m-2">
                        <img src="./../img/<?= $fetch->img_f ?>" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class = "btn btn-secondary" data-bs-dismiss = "modal">Close</button>
                    <button type="submit" class = "btn btn-warning text-white" name = "edit">Edit</button>
                </div>
            </div>
        </div>
    </form>
</div>