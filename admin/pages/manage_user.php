<?php
if(isset($_POST['cus'])){
    $id = $_POST['id'];
    $c = $_POST['cus'];
    $list = [
        'status_user' => $c
    ];
    $db->update("users",$list,"id_user = $id");
    if($db->query){
        if($c == 0){
            $db->setalert("success","อนุญาตบัญชีที่ต้องการแล้ว !");
            return;
        }else{
            $db->setalert("error","ระงับบัญชีที่ต้องการแล้ว !");
            return;
        }
    }else{
        $db->setalert("error","ERROR !");
        return;
    }
}
if(isset($_POST['sen'])){
    $id = $_POST['id'];
    $c = $_POST['sen'];
    $list = [
        'status_user' => $c
    ];
    $db->update("users",$list,"id_user = $id");
    if($db->query){
        if($c == 0){
            $db->setalert("error","ระงับบัญชีที่ต้องการแล้ว !");
            return;
        }else{
            $db->setalert("success","อนุญาตบัญชีที่ต้องการแล้ว !");
            return;
        }
    }else{
        $db->setalert("error","ERROR !");
        return;
    }
}
if(isset($_POST['re'])){
    $id = $_POST['id'];
    $c = $_POST['re'];
    $list = [
        'status_rest' => $c
    ];
    $db->update("rest",$list,"id_rest = $id");
    if($db->query){
        if($c == 0){
            $db->setalert("error","ระงับบัญชีที่ต้องการแล้ว !");
            return;
        }else{
            $db->setalert("success","อนุญาตบัญชีที่ต้องการแล้ว !");
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
            <p class="fw-bold fs-2 text-start">จัดการผู้ใช้งานทั้งหมด</p>
        </div>
        <div class="col-3">
            <form action="" method="post">
                <div class="input-group">
                    <input type="text" name="search" id="" class="form-control" placeholder= "ชื่อต้นหริอร้านที่ต้องการค้นหา">
                    <input type="submit" value="ค้นหา" name = "like" class = "btn btn-success">
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <ul class="nav nav-tabs">
            <li class="nav-item"><button type="button" class = "nav-link active" data-bs-toggle = "tab" data-bs-target = "#cus">สมาชิก</button></li>
            <li class="nav-item"><button type="button" class = "nav-link " data-bs-toggle = "tab" data-bs-target = "#sen">ผู้ส่งอาหาร</button></li>
            <li class="nav-item"><button type="button" class = "nav-link " data-bs-toggle = "tab" data-bs-target = "#re">ร้านอาหาร</button></li>
        </ul>
        <div class="card-body">
            <?php $db->loadalert(); ?>
            <div class="content tab-content">
                <div class="tab-pane fade show active" id = "cus">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope = "col">รูป</th>
                                <th scope = "col">ชื่อ-นามสกุล</th>
                                <th scope = "col">ที่อยู่</th>
                                <th scope = "col">เบอร์โทร</th>
                                <th scope = "col">อีเมล์</th>
                                <th scope = "col">สถานะ</th>
                                <th scope = "col">จัดการผู้ใช้งาน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = $db->select("users","*","WHERE type_user = 2");
                            while($fetch = $result->fetch_object()){
                            ?>
                                <tr>
                                    <td><img src="./../img/<?= $fetch->img_user ?>" style = "width:7rem; height:80px; object-fit:cover;" alt="" class="img-fluid"></td>
                                    <td><?= $fetch->fname_user ?>  <?= $fetch->lname_user ?></td>
                                    <td><?= $fetch->address_user ?></td>
                                    <td><?= $fetch->phone_user ?></td>
                                    <td><?= $fetch->email_user ?></td>
                                    <td>
                                        <?php if($fetch->status_user == 0){ ?>
                                            <span class="badge bg-success rounded-pill fs-6">อนุญาต</span>
                                        <?php }else{ ?>
                                            <span class="badge bg-danger rounded-pill fs-6">ถูกระงับบัญชี</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="id" value = "<?= $fetch->id_user ?>">
                                            <?php if($fetch->status_user == 0){ ?>
                                                <button type="submit" class = "btn btn-danger rounded-pill" name = "cus" value = "1" onclick = "return confirm('ต้องการระงับบัญชีหรือไม่?')">ระงับบัญชี</button>
                                            <?php }else{ ?>
                                                <button type="submit" class = "btn btn-success rounded-pill" name = "cus" value = "0" onclick = "return confirm('ต้องการปลดระงับบัญชีหรือไม่?')">ปลดระงับบัญชี</button>
                                            <?php } ?>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id = "sen">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope = "col">รูป</th>
                                <th scope = "col">ชื่อ-นามสกุล</th>
                                <th scope = "col">ที่อยู่</th>
                                <th scope = "col">เบอร์โทร</th>
                                <th scope = "col">อีเมล์</th>
                                <th scope = "col">สถานะ</th>
                                <th scope = "col">จัดการผู้ใช้งาน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = $db->select("users","*","WHERE type_user = 3");
                            while($fetch = $result->fetch_object()){
                            ?>
                                <tr>
                                    <td><img src="./../img/<?= $fetch->img_user ?>" style = "width:7rem; height:80px; object-fit:cover;" alt="" class="img-fluid"></td>
                                    <td><?= $fetch->fname_user ?>  <?= $fetch->lname_user ?></td>
                                    <td><?= $fetch->address_user ?></td>
                                    <td><?= $fetch->phone_user ?></td>
                                    <td><?= $fetch->email_user ?></td>
                                    <td>
                                        <?php if($fetch->status_user == 0){ ?>
                                            <span class="badge bg-danger rounded-pill fs-6">ไม่ได้รับอนุญาต</span>
                                            <?php }else{ ?>
                                            <span class="badge bg-success rounded-pill fs-6">อนุญาต</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="id" value = "<?= $fetch->id_user ?>">
                                            <?php if($fetch->status_user == 0){ ?>
                                                <button type="submit" class = "btn btn-success rounded-pill" name = "sen" value = "1" onclick = "return confirm('ต้องการอนุญาตบัญชีหรือไม่?')">อนุญาต</button>
                                                <?php }else{ ?>
                                                    <button type="submit" class = "btn btn-danger rounded-pill" name = "sen" value = "0" onclick = "return confirm('ต้องการระงับบัญชีหรือไม่?')">ระงับบัญชี</button>
                                            <?php } ?>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id = "re">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope = "col">รูป</th>
                                <th scope = "col">ชื่อร้านอาหาร</th>
                                <th scope = "col">ที่อยู่</th>
                                <th scope = "col">เบอร์โทร</th>
                                <th scope = "col">สถานะ</th>
                                <th scope = "col">จัดการผู้ใช้งาน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = $db->select("rest","*");
                            while($fetch = $result->fetch_object()){
                            ?>
                                <tr>
                                    <td><img src="./../img/<?= $fetch->img_rest ?>" style = "width:7rem; height:80px; object-fit:cover;" alt="" class="img-fluid"></td>
                                    <td><?= $fetch->name_rest ?></td>
                                    <td><?= $fetch->address_rest ?></td>
                                    <td><?= $fetch->phone_rest ?></td>
                                    <td>
                                        <?php if($fetch->status_rest == 0){ ?>
                                            <span class="badge bg-danger rounded-pill fs-6">ไม่ได้รับอนุญาต</span>
                                            <?php }else{ ?>
                                            <span class="badge bg-success rounded-pill fs-6">อนุญาต</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="id" value = "<?= $fetch->id_rest ?>">
                                            <?php if($fetch->status_rest == 0){ ?>
                                                <button type="submit" class = "btn btn-success rounded-pill" name = "re" value = "1" onclick = "return confirm('ต้องการอนุญาตบัญชีหรือไม่?')">อนุญาต</button>
                                                <?php }else{ ?>
                                                    <button type="submit" class = "btn btn-danger rounded-pill" name = "re" value = "0" onclick = "return confirm('ต้องการระงับบัญชีหรือไม่?')">ระงับบัญชี</button>
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
    </div>
</div>