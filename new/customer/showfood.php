<?php 
include('./../database.php');
session_start();
$db = new db();
if(!isset($_GET['id_rest'])){
    header("location:./../home.php");
    return;
}else{
    $id_rest = $_GET['id_rest'];
    $userid = $_SESSION['userid'];
    $rest =$db->select("rest","*","WHERE id_rest = $id_rest");
    $fetchrest = $rest->fetch_object();
    if(isset($_POST['cart'])){
        $id_f = $_POST['id_f'];
        $amount = $_POST['amount'];
        $cart = $db->select("cart","*","WHERE id_rest = $id_rest AND id_f = $id_f AND id_cus = $userid");
        if($cart->num_rows > 0){
           $db->setalert("warning","มีสินค้านี้ในตระกร้าแล้ว");
           return;
        }else{
            $date = [
                'id_f' => $id_f,
                'id_rest' => $id_rest,
                'amount' => $amount,
                'id_cus' => $userid
             ];
             $db->insert("cart",$date);
             if($db->query){
                 $db->setalert("success","เพิ่มตระกร้าสำเร็จ");
                 return;
             }else{
                 $db->setalert("error","เกิดข้อผิดพลาด");
                 return;
             }
        }
    }
    if(isset($_POST['del'])){
        $id_f = $_POST['id_f'];
        $db->delete("cart","id_f = $id_f AND id_cus = $userid");
        if($db->query){
            $db->setalert("success","ลบสินค้าสำเร็จ");
            return;
        }else{
            $db->setalert("error","เกิดข้อผิดพลาด");
            return;
        }
    }
    if(isset($_POST['buy'])){
        $id_or = rand();
        $date = [
            'id_or' => $id_or,
            'id_cus' => $userid,
            'id_rest' => $id_rest 
        ];
        $db->insert("orderd",$date);
        $db2 = new db();
        $cart = $db->select("cart,food","*","WHERE cart.id_f = food.id_f AND cart.id_cus = $userid AND cart.id_rest = $id_rest");
        while($fetchcart = $cart->fetch_object()){
            $dis = $fetchcart->price_f * $fetchcart->amount * $fetchcart->discount_f/100;
            $totla = $fetchcart->price_f * $fetchcart->amount - $dis;
            $amount = $fetchcart->amount;
            $id_f = $fetchcart->id_f;
        
        $date = [
             'id_or' => $id_or,
             'id_f' => $id_f,
             'sum' => $totla,
             'discount' => $dis,
             'amount' => $amount
        ];
        $db2->insert("order_detail",$date);
    }
        $db3 = new db();
        $db3->delete("cart","id_cus = $userid");
        if($db->query){
            $db->setalert("success","สั่งซื้อสำเร็จ");
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
    <title>หน้าเมนู</title>
    <link rel="stylesheet" href="./../bootstrap/css/bootstrap.css">
    <script src="./../bootstrap/js/bootstrap.js"></script>
    <script src="./../bootstrap/js/bootstrap.esm.js"></script>
    <script src="./../bootstrap/js/bootstrap.bundle.js"></script>
    <style>
        .body{
            background-color:#f0f0f0;
        }
        .b10{
            border-radius:10px;
        }
    </style>
</head>
<body class="body">
    <?php include_once('./../navbar.php'); ?>
    <div class="container-fluid">
       <div style="height:100px;"></div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-6">
                <div class="card shadow" style = "border-radius:10px;">
                    <div class="card-body">
                <?php $db->loadalert(); ?>
                <img src="./../img/<?=$fetchrest->img_rest?>" class="w-100 h-25" style="object-fit:cover; max-height:200px;"  alt="">
                <div class="mt-2"></div>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="./showfood.php?id_rest=<?=$id_rest?>" class="nav-link active">หน้าแรก</a>
                    </li>
                    <?php 
                    $type = $db->select("type_f,food","*","WHERE food.id_rest = $id_rest AND food.type_f = type_f.id_typef GROUP BY food.type_f");
                    while($fetchtype = $type->fetch_object()){
                    ?>
                    <a href="./showfood.php?id_rest=<?=$id_rest?>&type_f=<?=$fetchtype->id_typef?>" class="nav-link"><?=$fetchtype->name_typef?></a>
                    <?php } ?>
                </ul>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                    <?php
                    if(isset($_GET['type_f'])){
                        $type_f = $_GET['type_f'];
                        $food = $db->select("food","*","WHERE id_rest = $id_rest AND type_f = $type_f");
                    }else{
                        $food = $db->select("food","*","WHERE id_rest = $id_rest");
                    }
                    while($fetchfood = $food->fetch_object()){
                        $dis = $fetchfood->price_f * $fetchfood->discount_f/100;
                        $total = $fetchfood->price_f - $dis;
                        $id_f = $fetchfood->id_f;
                    ?>
                    <div class="col mt-2">
                        <div class="card">
                            <img src="./../img/<?=$fetchfood->img_f?>" class="card-img-top" style="object-fit:cover; max-height:100px;"  alt="">
                            <div class="card-body">
                                <div class="card-title">
                                    <h4><?=$fetchfood->name_f?></h4>
                                    <?php 
                                    if($fetchfood->discount_f > 0){
                                        echo "<del>" .$fetchfood->price_f. "</del>" ."  ". $total."฿";
                                    }else{
                                        echo $fetchfood->price_f;
                                    }
                                    ?>
                                </div>
                                <form action="" method="post">
                                <div class="card-text">
                                    <div class="input-group">
                                        <input type="hidden" name="id_f" value="<?=$fetchfood->id_f?>">
                                        <input type="number" name="amount" value="1" class="form-control"  id="">
                                        <input type="submit" value="เพิ่ม" name="cart" class="btn btn-success">
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                </div>
                </div>
                <div class="mt-2"></div>
                <div class="card shadow b10">
                <div class="card-body">
                    <h3 align="center">รีวิว</h3>
                    <div class="mt-3"></div>
                    <?php
                    $re = $db->select("review,users","*","WHERE review.id_rest = $id_rest AND review.id_cus = users.id_user ");
                    while($fetchre = $re->fetch_object()){
                    ?>
                    <div class="card mb-2">
                        <div class="card-body">
                    <div class="row text-center" >
                        <div class="col-2 mb-2"> <div class="mt-3"></div>
                        <img src="./../img/<?=$fetchre->img_user?>"  class="img-fluid rounded-circle" style="height:80px; width:80px; object-fit:cover;" alt="">
                        </div>
                        <div class="col-10 mb-2 text-start">
                        <h5 style = "color:tomato;"><?=$fetchre->fname_user?>  <?=$fetchre->lname_user?></h5><br>
                        <h5><input type="text" value="<?=$fetchre->comment?>" class="form-control" disabled></h5>
                        </div>
                    </div>
                    </div>
                    </div>                       
                    <?php } ?>
                </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card shadow b10">
                    <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <h2 align="center">ตระกร้าสินค้า</h2>
                    </div>
                </div>
                <div class="mt-2"></div>
                <div class="card">
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5" align="center">
                            <?php
                            $sum = 0;
                            $cart = $db->select("cart,food","*","WHERE cart.id_f = food.id_f AND cart.id_cus = $userid AND cart.id_rest = $id_rest");
                            while($fetchcart = $cart->fetch_object()){
                                $dis = $fetchcart->price_f * $fetchcart->amount * $fetchcart->discount_f/100;
                                $total = $fetchcart->price_f  * $fetchcart->amount - $dis;
                                $id_f = $fetchcart->id_f;
                                $sum += $total;
                            ?>
                                <div class="col-2 mb-2">
                                    <img src="./../img/<?=$fetchcart->img_f?>" class="img-fluid" style="object-fit:cover;" alt="">
                                </div>
                                <div class="col-3 mb-2">
                                    <h3><?=$fetchcart->name_f?></h3>
                                </div>
                                <div class="col-2 mb-2">
                                    <h3><?=$total?>฿</h3>
                                </div>
                                <div class="col-4 mb-2 text-center" >
                                    <div class="input-group">
                                        <?php if($fetchcart->amount >= 1){ ?>
                                        <h4><a href="./sum.php?cel&id_rest=<?=$id_rest?>&id_cart=<?=$fetchcart->id_cart?>&amount=<?=$fetchcart->amount?>" style = "text-decoration:none;">  -  </a></h4>
                                        <?php }else{ ?>
                                            <h2><a>-</a></h2>
                                        <?php } ?>
                                        <input type="text" name="" disabled value = "<?=$fetchcart->amount?>" id="" class="form-control ms-1 me-1" style = "border-radius:10px;">
                                        <h4><a href="./sum.php?sum&id_rest=<?=$id_rest?>&id_cart=<?=$fetchcart->id_cart?>&amount=<?=$fetchcart->amount?>" style = "text-decoration:none;">  +  </a></h4>
                                    </div>
                                </div>
                                <div class="col-1 mb-2"> 
                                    <form action="" method="post">
                                    <input type="hidden" name="id_f" value="<?=$fetchcart->id_f?>">
                                    <input type="submit" value="" name="del" class="btn btn-close">
                                </form>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-4">
                                    <h4>ราคารวม</h4>
                                </div>
                                <div class="col-4">
                                    <h4><?=$sum?></h4>
                                </div>
                                <div class="col-4">
                                    <h4>บาท</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2"></div>
                <form action="" method="post">
                <div class="row" align="center">
                    <div class="col-2"></div>
                    <div class="col-8">
                       <input type="submit" value="สั่งซื้อ" name="buy" class="btn btn-success">
                    </div>
                    <div class="col-2"></div>
                </div>
                </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>