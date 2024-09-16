<?php
session_start();
include('./../database.php');
$db = new db;
$db->checklogin();
if(!isset($_GET['id_or'])){
    header('location:./orderd.php');
}else{
    $id_or = $_GET['id_or'];
    $id_cus = $_GET['id_cus'];
    $id_rest = $_GET['id_rest'];
    $cus = new db;
    $c = $cus->select("users","*","WHERE id_user = $id_cus");
    $fetch_c = $c->fetch_object();
    $sen = new db;
    $s = $sen->select("rest","*","WHERE id_rest = $id_rest");
    $fetch_s = $s->fetch_object();
}
$userid = $_SESSION['userid'];
$usertype = $_SESSION['usertype'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../bootstrap/dist/css/bootstrap.css">
    <script src="./../bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script src="./../bootstrap/dist/js/bootstrap.js"></script>
    <script src="./../bootstrap/dist/js/bootstrap.esm.js"></script>
    <title>รายละเอียดออร์เดอร์</title>
</head>
<style>
    .body{
        background-color:#f0f0f0;
    }
</style>
<body class="body">
    <?php include_once('./../navbar.php'); ?>
    <div class="container">
        <div class="" style = "height:150px;"></div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="card">
                    <div class="card-body">
                        <h2 align="center">รายละเอียดออร์เดอร์<?=$id_or?></h2>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 h6" align = "left" >
                                ชื่อลูกค้า : <?= $fetch_c->fname_user ?>   <?= $fetch_c->lname_user ?><br>
                                ที่อยู่ลูกค้า : <?= $fetch_c->address_user ?><br>
                                เบอร์โทร : <?= $fetch_c->phone_user ?>
                            </div>
                            <div class="col-4"></div>
                            <div class="col-4 h6" align = "right">
                                ชื่อร้านอาหาร : <?= $fetch_s->name_rest ?><br>
                                ที่อยู่ร้านอาหาร : <?= $fetch_s->address_rest ?><br>
                            </div>
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr align ="center">
                                    <th class="h4">รูปอาหาร</th>
                                    <th class="h4">ชื่ออาหาร</th>
                                    <th class="h4">ราคาอาหาร</th>
                                    <th class="h4">จำนวน</th>
                                    <th class="h4">ส่วนลดอาหาร</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $result = $db->select("order_detail,food","*","WHERE order_detail.id_f = food.id_f AND order_detail.id_or = $id_or ");
                                $sum = 0;
                                while($fetch =$result->fetch_object()){
                                    $sum += $fetch->sum;
                                ?>
                                    <tr align = "center">
                                        <td class="h5"><img src="./../img/<?= $fetch->img_f ?>" class="img-fluid" style = "width:7rem; object-fit:cover;"></td>
                                        <td class="h5"><?= $fetch->name_f ?></td>
                                        <td class="h5"><?= $fetch->sum ?> ฿</td>
                                        <td class="h5"><?= $fetch->amount ?></td>
                                        <td class="h5"><?= $fetch->discount_f ?> %</td>
                                    </tr>
                                <?php } ?>
                                <tr align = "right">
                                    <td class = "h5">ราคาสุทธิ์ : <?= $sum ?> ฿</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-4" align = "left"><a href="./showfood.php?id_rest=<?= $id_rest ?>" class = "btn btn-success">กลับไปหน้าเดิม</a></div>
                            <div class="col-4"></div>
                            <div class="col-4"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</body>
</html>