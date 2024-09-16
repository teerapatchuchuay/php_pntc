<?php
session_start();
include_once("./../database.php");
$db = new db();
$db->checklogin();
$userid = $_SESSION['userid'];
$usertype = $_SESSION['usertype'];
$admin = new db();
$adresult = $admin->select("rest","*","WHERE id_rest = $userid");
$adfetch = $adresult->fetch_object();
if(isset($_GET['menu'])){
    $menu = $_GET['menu'];
}else{
    $menu = "0";
}
$id_or = $_GET['id_or'];
$id_cus = $_GET['id_cus'];
$id_sen = $_GET['id_sen'];
$cus = new db();
$cusresult = $cus->select("users","*","WHERE id_user = $id_cus");
$cusfetch = $cusresult->fetch_object();
$sen = new db();
$senresult = $sen->select("users","*","WHERE id_user = $id_sen");
$senfetch = $senresult->fetch_object();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../bootstrap/css/bootstrap.css">
    <script src="./../bootstrap/js/bootstrap.js"></script>
    <script src="./../bootstrap/js/bootstrap.esm.js"></script>
    <script src="./../bootstrap/js/bootstrap.bundle.js"></script>
    <title>Document</title>
</head>
<body onload="window.print()">
    <div class="container-fluid">
        <div class="" style = "height:100px;"></div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="card" style = "border-radius:10px;">
                    <div class="card-header h3 text-center">รายละเอียด <?= $id_or ?></div>
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col-6 text-start">
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
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</body>
</html>