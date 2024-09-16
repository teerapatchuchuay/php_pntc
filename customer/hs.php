<?php 
$db = new db();
if (!isset($_SESSION['userid'])) {
    header("location:./../customer/index.php?menu=0");
    exit();
}
$userid  = $_SESSION['userid'];
if(isset($_POST['del'])){
    $id_or = $_POST['id_or'];
    $date = [
        'id_or' => $id_or,
        'status_or' => 6
    ];
    $db->update("orderd",$date,"id_or = $id_or");
    if($db->query){
        $db->setalert("success","ยกเลิกสำเร็จ");
        return;
    }else{
        $db->setalert("error","เกิดข้อผิดพลาด");
        return;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./../bootstrap/css/bootstrap.css">
    <script src="./../bootstrap/js/bootstrap.js"></script>
    <script src="./../bootstrap/js/bootstrap.esm.js"></script>
    <script src="./../bootstrap/js/bootstrap.bundle.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div style="height:100px;"></div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="card shadow">
                            <div class="card-body">
                                <h2 align="center">ประวัติการสั่งซื้อ</h2>
                            </div>
                        </div>
                        <div class="mt-2"></div>
                        <?php $db->loadalert(); ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>รหัสออร์เดอร์</th>
                                    <th>ชื่อร้านอาหาร</th>
                                    <th>ที่อยู่ร้านอาหาร</th>
                                    <th>สถานะการส่ง</th>
                                    <th>การยกเลิก</th>
                                    <th>รายละเอียด</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $or = $db->select("orderd,rest","*","WHERE orderd.id_rest = rest.id_rest AND orderd.id_cus = $userid ");
                                while($fetchor = $or->fetch_object()){
                                ?>
                                <tr>
                                    <td><?=$fetchor->id_or?></td>
                                    <td><?=$fetchor->name_rest?></td>
                                    <td><?=$fetchor->address_rest?></td>
                                    <td><?php
                                 if($fetchor->status_or == 0){ ?>
                                    <span class="badge bg-danger rounded-pill fs-6">ร้านยังไม่รับออร์เดอร์</span>
                                 <?php }elseif($fetchor->status_or == 1){ ?>
                                    <span class="badge bg-primary rounded-pill fs-6">กำลังปรุงอาหาร</span>
                                 <?php }elseif($fetchor->status_or == 2){ ?>
                                    <span class="badge bg-warning rounded-pill fs-6">รอผู้ส่งอาหารรับออร์เดอร์</span>
                                 <?php }elseif($fetchor->status_or == 3){ ?>
                                    <span class="badge bg-warning rounded-pill fs-6">กำลังจัดส่ง</span>
                                 <?php }elseif($fetchor->status_or == 4){ ?>
                                    <span class="badge bg-success rounded-pill fs-6">จัดส่งอาหารเสร็จสิ้น</span>
                                 <?php }else{ ?>
                                    <span class="badge bg-danger rounded-pill fs-6">ลูกค้ายกเลิก</span>
                                 <?php } ?>
                            </td>
                                    <td>
                                        <?php if($fetchor->status_or < 1){ ?>
                                        <form action="" method="post">
                                            <input type="hidden" name="id_or" value="<?=$fetchor->id_or?>">
                                            <input type="submit" value="ยกเลิก" name="del"  class="btn btn-danger">
                                            <?php }else{ ?>
                                                <input type="submit" value="ยกเลิก" name="del" disblad  class="btn btn-danger">
                                            <?php } ?>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="./hs_de.php?id_or=<?=$fetchor->id_or?>&id_rest=<?=$fetchor->id_rest?>&id_sen=<?=$fetchor->id_sen?>&id_cus=<?=$fetchor->id_cus?>" class="btn btn-success">รายละเอียด</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
</body>
</html>