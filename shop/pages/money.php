<div class="container text-center">
    <div class="" style = "height:50px;"></div>
    <div class="row justify-content-between">
        <div class="col-9 text-start">
            <p class="fw-bold fs-2">สรุปรายได้ภายในร้าน</p>
        </div>
        <div class="col-3 text-end">
            <form action="" method="post">
                <div class="input-group">
                    <input type="date" name="search" class="form-control">
                    <input type="submit" value="ค้นหา" class = "btn btn-success" name = "like">
                </div>
            </form>
        </div>
    </div>
    <div class="card shadow" style = "border-radius:10px;">
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope = "col">รหัสออร์เดอร์</th>
                        <th scope = "col">วันที่</th>
                        <th scope = "col">ชื่อลูกค้า</th>
                        <th scope = "col">ที่อยู่ลูกค้า</th>
                        <th scope = "col">รายได้</th>
                        <th scope = "col">รายละเอียด</th>
                        <th scope = "col">ปริ้นPDF</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($_POST['search']) && isset($_POST['like']) && isset($_POST['search']) != ''){
                        $search = $_POST['search'];
                        $result = $db->select("orderd,users,order_detail","*,SUM(sum) as price","WHERE order_detail.id_or = orderd.id_or AND orderd.time LIKE '%$search%' AND orderd.id_cus = users.id_user AND orderd.status_or = 4 AND orderd.id_rest = $userid");
                    }else{
                        $result = $db->select("orderd,users,order_detail","*,SUM(sum) as price","WHERE order_detail.id_or = orderd.id_or AND orderd.id_cus = users.id_user AND orderd.status_or = 4 AND orderd.id_rest = $userid");
                    }
                    while($fetch = $result->fetch_object()){
                    ?>
                        <tr>
                            <th scope = "col"><?= $fetch->id_or ?></th>
                            <td><?= $fetch->time ?></td>
                            <td><?= $fetch->fname_user ?>  <?= $fetch->lname_user ?></td>
                            <td><?= $fetch->address_user ?></td>
                            <td>
                                <label for="" style = "color:yellowgreen; font-weight:bold;"><?= number_format($fetch->price) ?> ฿</label>
                            </td>
                            <td><?php include('./component/detail_m.php') ?></td>
                            <td><a href="./download.php?id_or=<?= $fetch->id_or ?>&&id_sen=<?= $fetch->id_sen ?>&&id_cus=<?= $fetch->id_cus ?>" onclick = "return confirm('ต้องการปริ้นใบเสร็จหรือไม่?')" class="btn btn-outline-success rounded-pill">download</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>