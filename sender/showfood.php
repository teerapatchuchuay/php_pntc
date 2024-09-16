<?php 
include('./../database.php');
session_start();
$db = new db();
$db->checklogin();
if(!isset($_GET['id_rest'])){
    header("location:./../home/home.php");
}else{
    $id_rest = $_GET['id_rest'];
    $userid  = $_SESSION['userid'];
    $usertype = $_SESSION['usertype'];
    if(isset($_POST['sum'])){
        $id_or = $_POST['id_or'];
        $date = [
           'status_or' => 3,
           'id_sen' =>  $userid
        ];
        $db->update("orderd",$date,"id_or = $id_or");
        if($db->query){
            $db->setalert("success","รับออร์เดอร์สำเร็จ");
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
<?php include_once('./../navbar.php'); ?>
    <div class="container">
        <div style="height:100px;"></div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="card">
                    <?php $db->loadalert(); ?>
                    <div class="card-header mb-2" align="center">
                        <h3>ออร์เดอร์ภายในร้าน</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover ">
                            <thead>
                                <tr>
                                    <th>รหัสออร์เดอร์</th>
                                    <th>ชื่อลูกค้า</th>
                                    <th>ที่อยู่ลูกค้า</th>
                                    <th>ชื่อร้านอาหาร</th>
                                    <th>ออร์เดอร์</th>
                                    <th>รายละเอียด</th>
                                </tr>
                                <tbody>
                                    <?php 
                                    $detail = $db->select("orderd,users,rest","*","WHERE rest.id_rest = orderd.id_rest AND orderd.id_rest = $id_rest AND orderd.status_or = 2 AND orderd.id_cus = users.id_user");
                                    if($detail->num_rows > 0){
                                    while($fetch = $detail->fetch_object()){
                                    ?>
                                    <tr>
                                        <td><?=$fetch->id_or?></td>
                                        <td><?=$fetch->fname_user?></td>
                                        <td><?=$fetch->address_user?></td>
                                        <td><?=$fetch->name_rest?></td>
                                        <td>
                                            <form action="" method="post">
                                                <input type="hidden" name="id_or" value="<?=$fetch->id_or?>">
                                                <input type="submit" value="รับออร์เดอร์" name="sum" class="btn btn-success">
                                            </form>
                                        </td>
                                        <td>
                                            <form action="" method="post">
                                                <input type="hidden" name="id_or" value="<?=$fetch->id_or?>">
                                                <a href="detail.php?id_or=<?=$fetch->id_or?>&id_cus=<?=$fetch->id_cus?>&id_rest=<?=$id_rest?>" class="btn btn-success">รายละเอียด</a>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php }}else{ ?>
                                        <tr>
                                            <td>ไม่มีออร์เดอร์แล้ว</td>
                                        </tr>
                                        <?php } ?>
                                </tbody>
                            </thead>
                        </table>
                        <div class="col-4" align="left"><a href="./index.php" class="btn btn-success">กลับไปหน้าเดิม</a></div>
                    </div>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</body>
</html>