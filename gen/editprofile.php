<?php 
$db = new db();
if (!isset($_SESSION['userid'])) {
    header("location:./../customer/index.php?menu=0");
    exit();
}
$userid = $_SESSION['userid'];
$usertype = $_SESSION['usertype'];
if($usertype == 'shop'){
    $rest = $db->select("rest","*","WHERE id_rest = $userid");
    $fetchrest = $rest->fetch_object();
    if(isset($_POST['edit'])){
        $name_rest = $_POST['name_rest'];
        $address_rest = $_POST['address_rest'];
        $phone_rest = $_POST['phone_rest'];
        $file = $_FILES['img'];
        $fileold = $_POST['imgold'];
        if($file['name'] != ''){
            $img = $db->uploadfile($file);
        }else{
            $img = $fileold;
        }
        $date = [
            'name_rest' => $name_rest,
            'address_rest' => $address_rest,
            'phone_rest'=> $phone_rest,
            'img_rest' => $img
        ];
        $db->update("rest",$date,"id_rest = $userid");
        if($db->query){
                $db->setalert("success","แก้ไขข้อมูลสำเร็จ");
                return;
            }else{
                $db->setalert("error","เกิดข้อผิดพลาด");
                return;
            }
        }
    }else{
    $user = $db->select("users","*","WHERE id_user = $userid");
    $fetchuser = $user->fetch_object();
    if(isset($_POST['edit'])){
        $fname_user = $_POST['fname_user'];
        $lname_user = $_POST['lname_user'];
        $address_user = $_POST['address_user'];
        $email_user = $_POST['email_user'];
        $phone_user = $_POST['phone_user'];
        $file = $_FILES['img'];
        $fileold = $_POST['imgold'];
        if($file['name'] != ''){
            $img = $db->uploadfile($file);
        }else{
            $img = $fileold;
        }
        $date = [
            'fname_user' => $fname_user,
            'fname_user' => $fname_user,
            'address_user' => $address_user,
            'email_user' => $email_user,
            'phone_user'=> $phone_user,
            'img_user' => $img
        ];
        $db->update("users",$date,"id_user = $userid");
        if($db->query){
                $db->setalert("success","แก้ไขข้อมูลสำเร็จ");
                return;
            }else{
                $db->setalert("error","เกิดข้อผิดพลาด");
                return;
            }
        }
    }
if($usertype == 'shop'){
    if(isset($_POST['password'])){
        $password_old = $_POST['password_old'];
        $password_new = $_POST['password_new'];
        $password_con = $_POST['password_con'];
        $password = $db->select("rest","*","WHERE id_rest = $userid AND password_rest = $password_old");
        if($password->num_rows > 0){
            if($password_new != $password_con){
                $db->setalert("warning","รหัสผ่านยืนยันของท่านผิด");
                return;
            }else{
                $date = [
                    'password_rest' => $password_new
                ];
                $db->update("rest",$date,"id_rest = $userid");
                if($db->query){
                    $db->setalert("success","แก้ไขรหัสผ่านสำเร็จ");
                    return;
                }else{
                    $db->setalert("error","เกิดข้อผิดพลาด");
                    return;
                }
            }
        }
    }
}else{
    if(isset($_POST['password'])){
        $password_old = $_POST['password_old'];
        $password_new = $_POST['password_new'];
        $password_con = $_POST['password_con'];
        $password = $db->select("users","*","WHERE id_user = $userid AND password_user = $password_old");
        if($password->num_rows > 0){
            if($password_new != $password_con){
                $db->setalert("warning","รหัสผ่านยืนยันของท่านผิด");
                return;
            }else{
                $date = [
                    'password_user' => $password_new
                ];
                $db->update("users",$date,"id_user = $userid");
                if($db->query){
                    $db->setalert("success","แก้ไขรหัสผ่านสำเร็จ");
                    return;
                }else{
                    $db->setalert("error","เกิดข้อผิดพลาด");
                    return;
                }
            }
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
    <div class="container">
        <div style="height:100px;"></div>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <div class="card shadow">
                <ul class="nav nav-tabs">
                        <li class="nav-item"><button type="button" class = "nav-link active" data-bs-toggle = "tab" data-bs-target = "#cus">แก้ไขโปรไฟล์</button></li>
                        <li class="nav-item"><button type="button" class = "nav-link " data-bs-toggle = "tab" data-bs-target = "#sen">แก้ไขรหัสผ่าน</button></li>
                    </ul>
                    <div class="card-body">
                    <div class="content tab-content">
                        <div class="tab-pane fade show active" id = "cus">
                            <form action="" method="post" enctype="multipart/form-data">
                            <?php if($usertype == 'shop'){ ?>
                               <p class="fw-bold fs-3 text-center">แก้ไขข้อมูลร้านอาหาร</p>
                               <?php $db->loadalert(); ?>
                               <div class="mb-2" align="center">
                                <img src="./../img/<?=$fetchrest->img_rest?>" class="img-fluid" style="object-fit:cover;" alt="">
                               </div>
                               <div class="input-group mb-2">
                                  <div class="input-group-text">
                                    <label for="">ชื่อร้านอาหาร</label>
                                  </div>
                                  <input type="text" name="name_rest" value="<?=$fetchrest->name_rest?>" class="form-control">
                               </div>
                               <div class="input-group mb-2">
                                  <div class="input-group-text">
                                    <label for="">ที่อยู่ร้านอาหาร</label>
                                  </div>
                                  <input type="text" name="address_rest" value="<?=$fetchrest->address_rest?>" class="form-control">
                               </div>
                               <div class="input-group mb-2">
                                  <div class="input-group-text">
                                    <label for="">เบอร์โทรร้านอาหาร</label>
                                  </div>
                                  <input type="text" name="phone_rest" value="<?=$fetchrest->phone_rest?>" class="form-control">
                               </div>
                               <div class="mb-2">
                                 <input type="hidden" name="imgold" value="<?=$fetchrest->img_rest?>">
                                 <input type="file" name="img" class="form-control" id="">
                               </div>
                               <div class="mb-2" align="center">
                                   <input type="submit" value="บันทึก" name="edit" class="btn btn-success">
                               </div>
                               </form>
                            <?php }else{ ?>
                                <form action="" method="post" enctype="multipart/form-data">
                                <p class="fw-bold fs-3 text-center">แก้ไขข้อมูลผู้ใช้</p>
                                <?php $db->loadalert(); ?>
                               <div class="mb-2" align="center">
                                <img src="./../img/<?=$fetchuser->img_user?>" class="img-fluid" style="object-fit:cover;" alt="">
                               </div>
                               <div class="input-group mb-2">
                                  <div class="input-group-text">
                                    <label for="">ชื่อจริงผู้ใช้</label>
                                  </div>
                                  <input type="text" name="fname_user" value="<?=$fetchuser->fname_user?>" class="form-control">
                               </div>
                               <div class="input-group mb-2">
                                  <div class="input-group-text">
                                    <label for="">นามสกุลผู้ใช้</label>
                                  </div>
                                  <input type="text" name="lname_user" value="<?=$fetchuser->lname_user?>" class="form-control">
                               </div>
                               <div class="input-group mb-2">
                                  <div class="input-group-text">
                                    <label for="">ที่อยู่</label>
                                  </div>
                                  <input type="text" name="address_user" value="<?=$fetchuser->address_user?>" class="form-control">
                               </div>
                               <div class="input-group mb-2">
                                  <div class="input-group-text">
                                    <label for="">เบอร์โทร</label>
                                  </div>
                                  <input type="text" name="phone_user" value="<?=$fetchuser->phone_user?>" class="form-control">
                               </div>
                               <div class="input-group mb-2">
                                  <div class="input-group-text">
                                    <label for="">อีเมล</label>
                                  </div>
                                  <input type="text" name="email_user" value="<?=$fetchuser->email_user?>" class="form-control">
                               </div>
                               <div class="mb-2">
                                 <input type="hidden" name="imgold" value="<?=$fetchuser->img_user?>">
                                 <input type="file" name="img" class="form-control" id="">
                               </div>
                               <div class="mb-2" align="center">
                                <input type="submit" value="บันทึก"  name="edit" class="btn btn-success">
                               </div>
                            </form>
                                <?php } ?>
                        </div>
                        <div class="tab-pane fade show " id = "sen">
                            <form action="" method="post">
                                <div class="card shadow">
                                    <?php $db->loadalert(); ?>
                                    <div class="card-body">
                                        <div class="input-group mb-2">
                                            <div class="input-group-text">
                                                <label for="">รหัสผ่านเก่า</label>
                                            </div>
                                            <input type="password" name="password_old"  class="form-control">
                                        </div>
                                        <div class="input-group mb-2">
                                            <div class="input-group-text">
                                                <label for="">รหัสผ่านใหม่</label>
                                            </div>
                                            <input type="password" name="password_new"  class="form-control">
                                        </div>
                                        <div class="input-group mb-2">
                                            <div class="input-group-text">
                                                <label for="">รหัสผ่านยืนยัน</label>
                                            </div>
                                            <input type="password" name="password_con"  class="form-control">
                                        </div>
                                        <div class="mb-2" align="center">
                                            <input type="submit" value="บันทึก" name="password" class="btn btn-success">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-4"></div>
        </div>
    </div>
</body>
</html>