<?php 
include('./../database.php');
session_start();
$db = new db();
$db->checklogin();
if(!isset($_GET['id_rest'])){
    header("location:./../home.php");
}else{
    
    $id_rest = $_GET['id_rest'];
    $userid  =$_SESSION['userid'];
    $rest = $db->select("rest","*","WHERE id_rest = $id_rest");
    $fetchrest = $rest->fetch_object();
    if(isset($_POST['cart'])){
        $id_f = $_POST['id_f'];
        $amount = $_POST['amount'];
        $cart = $db->select("cart","*","WHERE id_rest = $id_rest AND id_f = $id_f AND  id_cus = $userid");
        if($cart->num_rows > 0){
            $db->setalert("warning","มีสินค้านี้อยู่แล้ว");
            return;
        }else{
            $date = [
                'id_f' => $id_f,
                'amount' => $amount,
                'id_rest' => $id_rest,
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
        $id_cart = $_POST['id_cart'];
        $db->delete("cart","id_cart = $id_cart");
        if($db->query){
            $db->setalert("success","ลบสำเร็จ");
            return;
        }else{
            $db->setalert("error",'เกิดข้อผิดพลาด');
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
            $total = $fetchcart->price_f * $fetchcart->amount - $dis ;
            $id_f = $fetchcart->id_f;
            $amount = $fetchcart->amount;
        $date = [
             'id_or' => $id_or,
             'id_f' => $id_f,
             'sum' => $total,
             'discount' => $dis,
             'amount' => $amount
        ];
        $db2->insert("order_detail",$date);
        }
        $db3 = new db();
        $db3->delete("cart","id_cus = $userid");
        if($db->query){
            $db->setalert("success","สั่งซื้อสำเร็จ");
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
</head>
<body>
    <?php include_once('./../navbar.php'); ?>
    <div class="container-fluid">
        <div style="height:70px;"></div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-6">
                <div class="card shadow">
                    <div class="card-body">
                      <img src="./../img/<?=$fetchrest->img_rest?>" class="w-100 h-25 img-fluid " style="object-fit:cover; max-height:100px;" alt="">
                      <div class="mt-2"></div>
                      <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="./showfood.php?id_rest=<?=$id_rest?>"class="nav-link active">หน้าแรก</a>
                        </li>
                        <?php 
                        $type = $db->select("type_f","*","WHERE id_rest = $id_rest");
                        while ($fetchtype = $type->fetch_object()){
                        ?>
                        <a href="./showfood.php?id_rest=<?=$id_rest?>&type_f=<?=$fetchtype->id_typef?>" class="nav-link"><?=$fetchtype->name_typef?></a>
                        <?php } ?>
                      </ul>
                      <?php $db->loadalert(); ?>
                      <div class="mt-2"></div>
                      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                        <?php 
                        if(isset($_GET['type_f'])){
                            $type_f = $_GET['type_f'];
                            $food = $db->select("food","*","WHERE id_rest = $id_rest AND type_f = $type_f ");
                        }else{
                            $food = $db->select("food","*","WHERE id_rest = $id_rest");
                        }
                        while($fetchfood = $food->fetch_object()){
                            $dis = $fetchfood->price_f * $fetchfood->discount_f/100;
                            $total = $fetchfood->price_f  - $dis;
                        ?>
                        <div class="col">
                            <div class="card shadow">
                                <img src="./../img/<?=$fetchfood->img_f?>" class="img-fluid" style="odject-fit:cover; max-height:110px;" alt="">
                                <div class="card-body">
                                    <h5><?=$fetchfood->name_f?></h5>
                                     <h5>
                                        <?php
                                        if($fetchfood->discount_f > 0){
                                            echo "<del>" .$fetchfood->price_f. "</del>" ." ".  $total ."฿";
                                        }else{
                                            echo $fetchfood->price_f ."฿";
                                        }
                                        ?>
                                     </h5>
                                    <form action="" method="post">
                                    <div class="card-title">
                                        <div class="input-group">
                                            <input type="hidden" name="id_f" value="<?=$fetchfood->id_f?>">
                                            <input type="number" name="amount" value="1" id="" class="form-control">
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
                <?php 
$re = $db->select("review, users", "*", "WHERE review.id_rest = $id_rest AND review.id_cus = users.id_user");
if ($re->num_rows > 0) { 
?>
    <div class="mt-3"></div>
    <div class="card shadow b10">
        <div class="card-body">
            <h3 align="center">รีวิว</h3>
            <div class="mt-3"></div>
            <?php
            while ($fetchre = $re->fetch_object()) {
            ?>
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-2 mb-2">
                                <div class="mt-3"></div>
                                <img src="./../img/<?=$fetchre->img_user?>" class="img-fluid rounded-circle" style="height:80px; width:80px; object-fit:cover;" alt="">
                            </div>
                            <div class="col-10 mb-2 text-start">
                                <h5 style="color:tomato;"><?=$fetchre->fname_user?> <?=$fetchre->lname_user?></h5><br>
                                <h5><input type="text" value="<?=$fetchre->comment?>" class="form-control" disabled></h5>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php 
} else {
    echo "<br>";
    echo "<p align='center'>ยังไม่มีรีวิวสำหรับร้านนี้</p>";
} 
?>

            </div>
            <div class="col-5">
                <div class="card ">
                    <div class="card-body">
                                <h2 align="center">ตระกร้าสินค้า</h2>
                        </div>
                        <div class="mt-3"></div>
                        <?php
                        $sum = 0 ;
                        $cart = $db->select("cart,food","*","WHERE cart.id_f = food.id_f AND cart.id_rest = $id_rest AND cart.id_cus = $userid");
                        while($fetchcart = $cart->fetch_object()){
                            $dis = $fetchcart->price_f * $fetchcart->amount * $fetchcart->discount_f/100;
                            $total = $fetchcart->price_f * $fetchcart->amount - $dis;
                            $sum+=$total;

                        ?>
                        <div class="row">
                            <div class="col-2 mb-2">
                                <img src="./../img/<?=$fetchcart->img_f?>" class="img-fluid" style="object-fit:cover; max-height:80px;" alt="">
                            </div>
                            <div class="col-2 mb-2">
                                <h5 class="fs-5"><?=$fetchcart->name_f?></h5>
                            </div>
                            <div class="col-3 mb-2">
                                <h4><?=$total?></h4>
                            </div>
                            <div class="col-3 mb-2">
                                <div class="input-group">
                                    <?php if($fetchcart->amount > 0){ ?>
                                    <a href="./code_card.php?cel&id_rest=<?=$id_rest?>&id_cart=<?=$fetchcart->id_cart?>&amount=<?=$fetchcart->amount?>" class="btn btn-success">-</a>
                                    <?php }else{ ?>
                                        <a href="" class="" ></a>
                                        <?php } ?>
                                    <input type="text" value="<?=$fetchcart->amount?>" disabled  class="form-control">
                                    <a href="./code_card.php?sum&id_rest=<?=$id_rest?>&id_cart=<?=$fetchcart->id_cart?>&amount=<?=$fetchcart->amount?>" class="btn btn-success">+</a>
                                </div>
                            </div>
                            <div class="col-2 mb-2">
                                <form action="" method="post">
                                <input type="hidden" name="id_cart" value="<?=$fetchcart->id_cart?>">
                                <input type="submit" value="" name="del" class="btn btn-close">
                            </form>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="mt-4"></div>
                    <div class="card shadow">
                        <div class="card-body">
                    <div class="row text-center">
                        <div class="col-4">
                            <h3>ราคารวม</h3>
                        </div>
                        <div class="col-4">
                            <h3><?=$sum?></h3>
                        </div>
                        <div class="col-4">
                            <h3>บาท</h3>
                        </div>
                    </div>
                    </div>
                    </div>
                        <div class="mt-2"></div>
                        <div class="mb-2" align="center">
                            <div class="card">
                                <div class="card-body">
                                    <form action="" method="post">
                                    <input type="submit" value="สั่งซื้อ"  name="buy" class="btn btn-success">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php  ?>