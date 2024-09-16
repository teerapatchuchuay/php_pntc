<button type="button" class = "btn btn-secondary rounded-pill" data-bs-toggle = "modal" data-bs-target = "#m<?= $fetch->id_or ?>">รายละเอียด</button>
<div class="modal fade" id = "m<?= $fetch->id_or ?>" data-bs-backdrop = "static" tabindex = "-1">
    <form action="" method="post">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="fw-bold fs-5">รายละเอียด  <?= $fetch->id_or ?></p>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-between">
                        <div class="col-6 text-start">
                            <?php
                            $id_or = $fetch->id_or;
                            $id_cus = $fetch->id_cus;
                            $id_sen = $fetch->id_sen;
                            $cus = new db();
                            $cusresult = $cus->select("users","*","WHERE id_user = $id_cus");
                            $cusfetch = $cusresult->fetch_object();
                            $sen = new db();
                            $senresult = $sen->select("users","*","WHERE id_user = $id_sen");
                            $senfetch = $senresult->fetch_object();
                            ?>
                            ชื่อลูกค้า : <?= $cusfetch->fname_user ?>  <?= $cusfetch->lname_user ?><br>
                            ที่อยู่ลูกค้า : <?= $cusfetch->address_user ?> <br>
                            เบอร์โทรลูกค้า :  <?= $cusfetch->phone_user ?>
                        </div>
                        <div class="col-6 text-end">
                            ชื่อผู้ส่งอาหาร : <?= $senfetch->fname_user ?>  <?= $senfetch->lname_user ?><br>
                            ที่อยู่ผู้ส่งอาหาร : <?= $senfetch->address_user ?> <br>
                            เบอร์โทรผู้ส่งอาหาร :  <?= $senfetch->phone_user ?>
                        </div>
                    </div>
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope = "col">รูป</th>
                                <th scope = "col">ชื่ออาหาร</th>
                                <th scope = "col">ราคาอาหาร</th>
                                <th scope = "col">ส่วนลด</th>
                                <th scope = "col">จำนวน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $db2 = new db();
                            $result2 = $db2->select("order_detail,food","*","WHERE order_detail.id_f = food.id_f AND order_detail.id_or = $id_or");
                            $total = 0;
                            while($fetch2 = $result2->fetch_object()){
                                $total+=$fetch2->sum;
                            ?>
                                <tr>
                                    <td><img src="./../img/<?= $fetch2->img_f ?>" style = "width:7rem; height:80px; object-fit:cover;" alt="" class="img-fluid"></td>
                                    <td><?= $fetch2->name_f ?></td>
                                    <td><?= number_format($fetch2->sum) ?> ฿</td>
                                    <td><?= $fetch2->discount_f ?> %</td>
                                    <td><?= $fetch2->amount ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan = "5" class = "text-end">ราคารวมทั้งหมด <?= $total ?> ฿</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class = "btn btn-secondary" data-bs-dismiss = "modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>