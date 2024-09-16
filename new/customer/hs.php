<?php 
$db = new db();
$userid = $_SESSION['userid'];
$usertype = $_SESSION['usertype'];
if(isset($_POST['sum'])){
    $id_or = $_POST['id_or'];
    $date = [
        'id_or' => $id_or,
        'status_or' => 6
    ];
    $db->update("orderd",$date,"id_or = $id_or");
    if($db->query){
        $db->setalert("success","ยกเลิกรายการสำเร็จ");
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
</head>
<body>
    <div class="container text-center">
        <div style="height:100px;"></div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
            <div class="card shadow" style = "border-radius:10px;">
                <div class="card-body">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 align="center">ประวัติการสั่งชื้อ</h2>
                    </div>
                </div>
                <table class=" table  table-hover table-striped">
                    <thead>
                    <tr>
                        <th>รหัสออรํเดอร์</th>
                        <th>ชื่่อร้านอาหาร</th>
                        <th>สถานะการจัดส่ง</th>
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
                                <?php if($fetchor->status_or > 0){  ?>
                                   <span class="badge bg-danger rounded-pill fs-6">ยังไม่สามารถยกเลิกได้</span>
                                <?php }else{ ?>
                                <form action="" method="post">
                                    <input type="hidden" name="id_or" value="<?=$fetchor->id_or?>">
                                    <input type="submit" value="ยกเลิก" onclick = "return confirm('ต้องการยกเลิกออร์เดอร์หรือไม่?')" name="sum" class="btn btn-danger rounded-pill">
                                </form>
                                <?php } ?>
                            </td>
                            <td>
                                <a style="text-decoration:none;" class="btn btn-success" href="./hs_de.php?id_or=<?=$fetchor->id_or?>&id_sen=<?=$fetchor->id_sen?>&id_rest=<?=$fetchor->id_rest?>">รายละเอียด</a>
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