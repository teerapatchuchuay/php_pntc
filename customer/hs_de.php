<?php 
include('./../database.php');
session_start();
$db = new db();
$db->checklogin();
$id_rest = $_GET['id_rest'];
$id_sen = $_GET['id_sen'];
$id_or = $_GET['id_or'];
$userid = $_SESSION['userid'];

$restdb = new db();
$rest = $restdb->select("rest","*"," WHERE id_rest = $id_rest");
$fetchrest = $rest->fetch_object();

$ordb = new db();
$orderd = $ordb->select('orderd',"*","WHERE id_or = $id_or");
$fetchorder = $orderd->fetch_object();

if($id_sen != ''){
    $sendb = new db();
    $sen = $sendb->select("users","*","WHERE id_user = $id_sen");
    $fetchsend = $sen->fetch_object();
}
if(isset($_POST['re'])){
    $comment = $_POST['comment'];
    $date = [
        'id_or' => $id_or,
        'id_rest' =>$id_rest,
        'id_cus' => $userid,
        'comment' => $comment
    ];
    $db->insert("review",$date,"id_or = $id_or");
    if($db->query){
        $db->setalert("success","รีวิวสำเร็จ");
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
    <style>
    .body{
        background-color:#f0f0f0;
    }
</style>
    
</head>
<body class="body">
    <?php include_once('./../navbar.php'); ?>
    <div class="container ">
        <div style="height:100px;"></div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="card shadow">
                    <?php $db->loadalert(); ?>
                    <div class="card-body">
                        <div class="card shadow">
                            <div class="card-body">
                                <h2 class="text-center">รายละเอียดออร์เดอร์ <?=$id_or?></h2>
                            </div>
                        </div>
                        <div class="mt-2"></div>
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                    ชื่อร้านอาหาร : <?=$fetchrest->name_rest?><br>
                                    ที่อยู่ร้านอาหาร : <?= $fetchrest->address_rest ?>
                                    </div>
                                    <div class="col-6">
                                    <?php if($id_sen != ''){ ?>
                                <div class="mb-2" align="right">
                                    ชื่อผู้ส่งอาหาร : <?=$fetchsend->fname_user?> <br>
                                    เบอร์โทร : <?=$fetchsend->phone_user?>
                                </div>
                                <?php }else{ ?>
                                   <div class="mb-2" align="right">
                                    ชื่อผู้ส่งอาหาร : ผู้ส่งยังไม่ได้รับออร์เดอร์ <br>
                                    เบอร์โทร :  ผู้ส่งยังไม่ได้รับออร์เดอร์
                                   </div>
                                <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3"></div>
                        <table class="table table-bordered table-hover text-center">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>ภาพอาหาร</th>
                                    <th>ชื่ออาหาร</th>
                                    <th>ราคา</th>
                                    <th>ส่วนลด</th>
                                    <th>จำนวน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 0;
                                $detail = $db->select("order_detail,food","*","WHERE order_detail.id_f = food.id_f AND order_detail.id_or = $id_or");
                                while($fetchor = $detail->fetch_object()){
                                    $i++
                                ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><img src="./../img/<?=$fetchor->img_f?>" class="img-fluid" style="object-fit:cover; max-height:60px;" alt=""></td>
                                    <td><?=$fetchor->name_f?></td>
                                    <td><?=$fetchor->price_f?></td>
                                    <td><?=$fetchor->discount?></td>
                                    <td><?=$fetchor->amount?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <div class="mt-2"></div>
                        <form action="" method="post">
                            <?php 
                            $re = $db->select("review","*","WHERE id_or = $id_or");
                            if($re->num_rows > 0){
                            ?>
                            <div class="input-group">
                                <input type="text" name="comment" disabled class="form-control">
                                <input type="submit" value="รีวิว"  required class="btn btn-success">
                            </div>
                            <?php }else{ ?>
                                <div class="input-group">
                                <input type="text" name="comment"  class="form-control">
                                <input type="submit" value="รีวิว" required name="re" disbled class="btn btn-success">
                            </div>
                                <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
</body>
</html>