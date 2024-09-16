<?php
if(isset($_POST['or'])){
    $id = $_POST['id'];
    $or = $_POST['or'];
    $list =[
        'status_or' => $or
    ];
    $db->update("orderd",$list,"id_or = $id");
    if($db->query){
        if($or == 1){
            $db->setalert("success","รับออร์เดอร์ที่ต้องการเสร็จสิ้น !");
            return;
        }else{
            $db->setalert("success","เสร็จสิ้นกระบวนการปรุงอาหาร !");
            return;
        }
    }else{
        $db->setalert("error","ERROR !");
        return;
    }
}
?>
<div class="container text-center">
    <div class="" style = "height:50px;"></div>
    <div class="row justify-content-between">
        <div class="col-9">
            <p class="fw-bold fs-2 text-start">จัดการออร์เดอร์ทั้งหมด</p>
        </div>
        <div class="col-3">
        </div>
    </div>
    <div class="card shadow" style = "border-radius:10px;">
        <?php $db->loadalert(); ?>
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope = "col">รหัสออร์เดอร์</th>
                        <th scope = "col">ชื่อลูกค้า</th>
                        <th scope = "col">ที่อยู่ลูกค้า</th>
                        <th scope = "col">สถานะการส่ง</th>
                        <th scope = "col">สถานะการชำระเงิน</th>
                        <th scope = "col">รายละเอียด</th>
                        <th scope = "col">จัดการออร์เดอร์</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $db->select("orderd,users","*","WHERE orderd.id_rest = $userid AND orderd.id_cus = users.id_user GROUP BY orderd.id_or");
                    while($fetch = $result->fetch_object()){
                    ?>
                        <tr>
                            <th scope = "col"><?= $fetch->id_or ?></th>
                            <td><?= $fetch->fname_user ?>  <?= $fetch->lname_user ?></td>
                            <td><?= $fetch->address_user ?></td>
                            <td>
                                <?php if($fetch->status_or == 0){ ?>
                                    <span class="badge bg-danger rounded-pill fs-6">ร้านยังไม่รับออร์เดอร์</span>
                                <?php }elseif($fetch->status_or == 1){ ?>
                                    <span class="badge bg-primary rounded-pill fs-6">กำลังปรุงอาหาร</span>
                                <?php }elseif($fetch->status_or == 2){ ?>
                                    <span class="badge bg-warning rounded-pill fs-6">รอผู้ส่งอาหารรับออร์เดอร์</span>
                                <?php }elseif($fetch->status_or == 3){ ?>
                                    <span class="badge bg-warning rounded-pill fs-6">กำลังจัดส่งอาหาร</span>
                                <?php }elseif($fetch->status_or == 4){ ?>
                                    <span class="badge bg-success rounded-pill fs-6">จัดส่งเสร็จสิ้น</span>
                                <?php }else{ ?>
                                    <span class="badge bg-danger rounded-pill fs-6">ลูกค้ายกเลิก</span>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if($fetch->status_pay == 0){ ?>
                                    <span class="badge bg-danger rounded-pill fs-6">ยังไม่ชำระเงิน</span>
                                <?php }else{ ?>
                                    <span class="badge bg-success rounded-pill fs-6">ชำระเงินเสร็จสิ้น</span>
                                <?php } ?>
                            </td>
                            <td><?php include('./component/detail.php') ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="id" value = "<?= $fetch->id_or ?>">
                                    <?php if($fetch->status_or == 0){ ?>
                                        <button type="submit" name = "or" value = "1" class = "btn btn-success rounded-pill" onclick ="return confirm('ต้องการรับออร์เดอร์หรือไม่?')">รับออร์เดอร์</button>
                                    <?php }elseif($fetch->status_or == 1){ ?>
                                        <button type="submit" name = "or" value = "2" class = "btn btn-primary rounded-pill" onclick ="return confirm('ปรุงอาหารเสร็จแล้วหรือไม่?')">ปรุงอาหารเสร็จสิ้น</button>
                                    <?php }else{ ?>
                                        <button type="submit" disabled name = "or" value = "1" class = "btn btn-success rounded-pill" onclick ="return confirm('ต้องการรับออร์เดอร์หรือไม่?')">รับออร์เดอร์</button>
                                    <?php } ?>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>