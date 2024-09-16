<?php 
include_once('./../database.php');
session_start();
$db = new db();
if(!isset($_GET['id_rest'])){
    header("location:./../hs.php");
    return;
}else{
    $userid = $_SESSION['userid'];
    $id_rest = $_GET['id_rest'];
    $id_or = $_GET['id_or'];
    $id_sen = $_GET['id_sen'];

    $dbrest = new db();
    $rest = $dbrest->select("rest","*","WHERE id_rest = $id_rest");
    $fethrest = $rest->fetch_object();

    $dbcus = new db();
    $user = $db->select("orderd","*","WHERE id_cus = $userid");
    $fetchcus = $user->fetch_object();

    if($id_sen != ''){
        $dbsender = new db();
        $sender = $db->select("users","*","WHERE id_user = $id_sen");
        $fetchsender = $sender->fetch_object();
    }
    if(isset($_POST['en'])){
        $comment = $_POST['comment'];
        $date = [
           'id_cus' => $userid,
           'id_or' => $id_or,
           'id_rest' => $id_rest,
           'comment' => $comment
        ];
        $db->insert("review",$date);
        if($db->query){
            $db->setalert('success',"รีวิวสำเร็จ");
            return;
        }else{
            $db->setalert("error","เกิดข้อผิดพลาด");
            return;
        }
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
    <style>
        .body{
            background-color:#f0f0f0;
        }
    </style>
</head>
<body class="body">
    <?php include_once('./../navbar.php'); ?>
    <div class="container text-center">
        <div style="height:100px;"></div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="card">
                    <?php $db->loadalert(); ?>
                    <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <h2 align="center">รายละเอียดออร์เดอร์ <?=$id_or?></h2>
                    </div>
                </div>
                <div class="mt-2"></div>
                <div class="row justify-content-between">
                    <div class="col-6" align="left">
                        ชื่อร้านอาหาร : <?=$fethrest->name_rest?> <br>
                        ที่อยู่ร้านอาหาร : <?=$fethrest->address_rest?>
                    </div>
                    <div class="col-6" align="right">
                            <?php 
                        if($id_sen != ''){
                        ?>
                        <div class="col-6"></div>
                        ผู้ส่งอาหาร : <?=$fetchsender->fname_user ?> <br>
                        เบอร์โทร : <?= $fetchsender->phone_user?>
                        <?php }else{ ?>
                            ผู้ส่งอาหาร : ยังไม่ได้รับออร์เดอร์ <br>
                            เบอร์โทร : ยังไม่ได้รับออร์เดอร์
                            <?php } ?>
                    </div>
                </div>                   
                <div class="mt-3"></div>
                <table class="table table table-hover">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ภาพอาหาร</th>
                            <th>ชื่ออาหาร</th>
                            <th>ราคาอาหาร</th>
                            <th>ส่วนลด</th>
                            <th>จำนวน</th>
                            </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sum =0;
                        $i =0;
                        $or = $db->select("order_detail,food","*","WHERE order_detail.id_f = food.id_f AND order_detail.id_or = $id_or ");
                        while($fetchor = $or->fetch_object()){
                           $sum += $fetchor->sum;
                            $i++;
                        ?>
                        <tr>
                            <td><?=$i?></td>
                            <td><img src="./../img/<?=$fetchor->img_f?>" class="img-fluid " style="object-fit:cover; max-height:90px;" alt=""></td>
                            <td><?=$fetchor->name_f?></td>
                            <td><?=$fetchor->price_f?></td>
                            <td><?=$fetchor->discount?></td>
                            <td><?=$fetchor->amount?></td>
                        <?php } ?>
                    </tr>
                        <tr>
                            <td colspan = "6" class = "text-end">ราคาสุทธิ์    <?=$sum?> บาท</td>
                        </tr>
                    </tbody>
                </table>
                <?php $en = $db->select("review,orderd","*","WHERE review.id_or = $id_or ");
                if($en->num_rows > 0){
                ?>
                <input type="text" value="คุณได้ริวิวไปแล้ว" disabled class="form-control">
                <?php }else{ ?>
                <div class="mt-2"> </div>
                    <form action="" method="post">
                        <div class="input-group">
                        <input type="text" name="comment" class="form-control">
                        <input type="submit" value="รีวิว"  name="en" class="btn btn-success">
                        </div>
                    </form>
                <?php } ?>
                <div class="mt-3"></div>
                <a href="./index.php?menu=2" class="btn btn-success">กลับหน้าแรก</a>
                </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
</body>
</html>