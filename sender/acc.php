<?php 
$db = new db();
$db->checklogin();
$userid = $_SESSION['userid'];
$usertype = $_SESSION['usertype'];
if(isset($_POST['orderd'])){
    $id = $_POST['id'];
    $date = [
        'status_or' => 4,
        'status_pay' => 1,
        'id_sen' => $userid
    ];
    $db->update("orderd",$date,"id_or = $id");
    if($db->query){
        $db->setalert("success","ยืนยันการส่งอาหาร");
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
    <link rel="stylesheet" href="./../style.css">
    <link rel="stylesheet" href="./../bootstrap/dist/css/bootstrap.css">
    <script src="./../bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script src="./../bootstrap/dist/js/bootstrap.js"></script>
    <script src="./../bootstrap/dist/js/bootstrap.esm.js"></script>
</head>
<style>
    .body{
        background-color:#f0f0f0;
    }
</style>
<body class="body">
    <div class="container">
        <div style="height:100px;"></div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
            <div class="card">
                <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <h2 align="center">ยืนยันการส่ง</h2>
                    </div>
                </div>
                <div class="card">
                    <?php $db->loadalert(); ?>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered  table-hover">
                            <thead>
                                <tr align="center">
                                    <th>รหัสออร์เดอร์</th>
                                    <th>ชื่อลูกค้า</th>
                                    <th>ที่อยู่ร้านอาหาร</th>
                                    <th>ชื่อร้านอาหาร</th>
                                    <th>รายละเอียด</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $result = $db->select("orderd,users,rest","*","WHERE rest.id_rest = orderd.id_rest AND orderd.id_sen = $userid AND orderd.id_cus = users.id_user");
                                while($fetch = $result->fetch_object()){
                                ?>
                                    <tr align = "center">
                                        <td class="h5"><?= $fetch->id_or ?></td>
                                        <td class="h5"><?= $fetch->fname_user ?></td>
                                        <td class="h5"><?= $fetch->address_user ?></td>
                                        <td class="h5"><?= $fetch->name_rest ?></td>
                                        <td><form action="" method="post">
                                            <input type="hidden" name="id" value = "<?= $fetch->id_or ?>">
                                            <a href="a_detail.php?id_or=<?= $fetch->id_or ?>&id_cus=<?= $fetch->id_cus ?>&id_rest=<?= $fetch->id_rest ?>" class = "btn btn-secondary">รายละเอียด</a>
                                            <?php if($fetch->status_or >= 4){ ?>
                                                <input disabled type="submit" value="ยืนยันการส่ง" class = "btn btn-primary" name = "orderd">
                                                <?php }else{ ?>
                                                <input type="submit" value="ยืนยันการส่ง" class = "btn btn-primary" name = "orderd">
                                            <?php } ?>
                                        </form></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</body>
</html>