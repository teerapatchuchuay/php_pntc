<?php
session_start();
include_once("./../database.php");
$db = new db();
if(isset($_POST['cus'])){
    $username = $_POST['username'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $type_user = $_POST['type_user'];
    $file = $_FILES['img'];
    if($file['name'] != ''){
        $fileN = $db->uploadfile($file);
    }else{
        $fileN = "default.png";
    }
    if($password1 != $password2){
        $db->setalert("warning","โปรดยืนยันรหัสผ่านใหม่อีกครั้ง !");
        return;
    }else{
        $list = [
            'username_user' => $username,
            'password_user' => $password1,
            'fname_user' => $fname,
            'lname_user' => $lname,
            'phone_user' => $phone,
            'address_user' => $address,
            'email_user' => $email,
            'type_user' => $type_user,
            'img_user' => $fileN
        ];
        $rowinsert = $db->insertwhere("users",$list,"(SELECT * FROM users WHERE username_user = '$username')");
        if($rowinsert > 0){
            $db->setalert("success","สมัครสมาชิกเสร็จสิ้น !    <a href='./login.php' style='text-decoration:none'>เข้าสู่ระบบ</a>");
            return;
        }else{
            $db->setalert("error","โปรดยืนยันรหัสผ่านใหม่อีกครั้ง !");
            return;
        }
    }
}
if(isset($_POST['re'])){
    $username = $_POST['username'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $fname = $_POST['fname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $type_user = $_POST['type_user'];
    $file = $_FILES['img'];
    if($file['name'] != ''){
        $fileN = $db->uploadfile($file);
    }else{
        $fileN = "default.png";
    }
    if($password1 != $password2){
        $db->setalert("warning","โปรดยืนยันรหัสผ่านใหม่อีกครั้ง !");
        return;
    }else{
        $list = [
            'username_rest' => $username,
            'password_rest' => $password1,
            'name_rest' => $fname,
            'phone_rest' => $phone,
            'address_rest' => $address,
            'type_rest' => $type_user,
            'img_rest' => $fileN
        ];
        $rowinsert = $db->insertwhere("rest",$list,"(SELECT * FROM rest WHERE username_rest = '$username')");
        if($rowinsert > 0){
            $db->setalert("success","สมัครสมาชิกเสร็จสิ้น !    <a href='./login.php' style='text-decoration:none'>เข้าสู่ระบบ</a>");
            return;
        }else{
            $db->setalert("error","โปรดยืนยันรหัสผ่านใหม่อีกครั้ง !");
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
    <link rel="stylesheet" href="./../bootstrap/css/bootstrap.css">
    <script src="./../bootstrap/js/bootstrap.js"></script>
    <script src="./../bootstrap/js/bootstrap.esm.js"></script>
    <script src="./../bootstrap/js/bootstrap.bundle.js"></script>
    <title>Document</title>
</head>
<style>
    body{
        background-image:url(./../img/background.jpg);
        object-fit:cover;
    }
    .font-head{
        font-weight:bold;
        font-size:2rem;
        color:white;
        border-radius:10px;
        backdrop-filter:blur(10px);
    }
    #login{
        font-weight:bold;
        background-color:#f9ac4c;
        border-radius:10px;
        color:white
    }
    #login:hover{
        font-weight:bold;
        background-color:#f9ac4c;
        border-radius:10px;
        color:white;
        opacity:80%;
    }
    #line{
        color:yellowgreen;
        font-weight:bold;
        text-decoration:none;
    }
    #line:hover{
        color:skyblue;
        font-weight:bold;
        text-decoration:none;
        opacity:80%;
    }
</style>
<body>
    <div class="container">
        <div class="" style = "height:100px;"></div>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <p class="font-head border border-1 text-center">ระบบสั่งจองอาหารออนไลน์</p>
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><button type="button" class = "nav-link active" data-bs-toggle = "tab" data-bs-target = "#cus">สมาชิก</button></li>
                        <li class="nav-item"><button type="button" class = "nav-link " data-bs-toggle = "tab" data-bs-target = "#sen">ผู้ส่งอาหาร</button></li>
                        <li class="nav-item"><button type="button" class = "nav-link " data-bs-toggle = "tab" data-bs-target = "#re">ร้านอาหาร</button></li>
                    </ul>
                    <?php $db->loadalert(); ?>
                    <div class="card-body">
                        <div class="content tab-content">
                            <div class="tab-pane fade show active" id = "cus">
                                <form action="" method="post" enctype = "multipart/form-data">
                                    <p class="fw-bold fs-3 text-center">สมัครสมาชิก</p>
                                    <div class="input-group mb-2">
                                        <label for="" class="input-group-text">ชื่อบัญชี</label>
                                        <input type="text" required name = "username" placeholder = "ชื่อบัญชี" class="form-control">
                                    </div>
                                    <div class="input-group mb-2">
                                        <label for="" class="input-group-text">รหัสผ่าน</label>
                                        <input type="password" required name = "password1" placeholder = "รหัสผ่าน" class="form-control">
                                    </div>
                                    <div class="input-group mb-2">
                                        <label for="" class="input-group-text">ยืนยันรหัสผ่าน</label>
                                        <input type="password" required name = "password2" placeholder = "ยืนยันรหัสผ่าน" class="form-control">
                                    </div>
                                    <div class="input-group mb-2">
                                        <label for="" class="input-group-text">ชื่อ-นามสกุล</label>
                                        <input type="text" required name = "fname" placeholder = "ชื่อต้น" class="form-control">
                                        <input type="text" required name = "lname" placeholder = "นามสกุล" class="form-control">
                                    </div>
                                    <div class="input-group mb-2">
                                        <label for="" class="input-group-text">ที่อยู่</label>
                                        <input type="text" required name = "address" placeholder = "ที่อยู่ปัจจุบัน" class="form-control">
                                    </div>
                                    <div class="input-group mb-2">
                                        <label for="" class="input-group-text">เบอร์โทร</label>
                                        <input type="text" required name = "phone" placeholder = "เบอร์โทรที่ติดต่อได้" class="form-control">
                                    </div>
                                    <div class="input-group mb-2">
                                        <label for="" class="input-group-text">อีเมล์</label>
                                        <input type="email" required name = "email" placeholder = "อีเมลล์ที่ติดต่อได้" class="form-control">
                                    </div>
                                    <input type="hidden" name="type_user" value = "2">
                                    <input type="file" name="img" id="" class="form-control mb-2">
                                    <div class="mt-4 mb-4 text-center">
                                        <input type="submit" value="สมัครสมาชิก" name=  "cus" class = "btn btn" id = "login">
                                    </div>
                                    <hr>
                                    <p>หากท่านมีบัญชีอยู่แล้ว  <a href="./login.php" id = "line">เข้าสู่ระบบ</a></p>
                                </form>
                            </div>
                            <div class="tab-pane fade" id = "sen">
                                <form action="" method="post" enctype = "multipart/form-data">
                                    <p class="fw-bold fs-3 text-center">ลงทะเบียนผู้ส่งอาหาร</p>
                                    <div class="input-group mb-2">
                                        <label for="" class="input-group-text">ชื่อบัญชี</label>
                                        <input type="text" required name = "username" placeholder = "ชื่อบัญชี" class="form-control">
                                    </div>
                                    <div class="input-group mb-2">
                                        <label for="" class="input-group-text">รหัสผ่าน</label>
                                        <input type="password" required name = "password1" placeholder = "รหัสผ่าน" class="form-control">
                                    </div>
                                    <div class="input-group mb-2">
                                        <label for="" class="input-group-text">ยืนยันรหัสผ่าน</label>
                                        <input type="password" required name = "password2" placeholder = "ยืนยันรหัสผ่าน" class="form-control">
                                    </div>
                                    <div class="input-group mb-2">
                                        <label for="" class="input-group-text">ชื่อ-นามสกุล</label>
                                        <input type="text" required name = "fname" placeholder = "ชื่อต้น" class="form-control">
                                        <input type="text" required name = "lname" placeholder = "นามสกุล" class="form-control">
                                    </div>
                                    <div class="input-group mb-2">
                                        <label for="" class="input-group-text">ที่อยู่</label>
                                        <input type="text" required name = "address" placeholder = "ที่อยู่ปัจจุบัน" class="form-control">
                                    </div>
                                    <div class="input-group mb-2">
                                        <label for="" class="input-group-text">เบอร์โทร</label>
                                        <input type="text" required name = "phone" placeholder = "เบอร์โทรที่ติดต่อได้" class="form-control">
                                    </div>
                                    <div class="input-group mb-2">
                                        <label for="" class="input-group-text">อีเมล์</label>
                                        <input type="email" required name = "email" placeholder = "อีเมลล์ที่ติดต่อได้" class="form-control">
                                    </div>
                                    <input type="hidden" name="type_user" value = "3">
                                    <input type="file" name="img" id="" class="form-control mb-2">
                                    <div class="mt-4 mb-4 text-center">
                                        <input type="submit" value="สมัครสมาชิก" name=  "cus" class = "btn btn" id = "login">
                                    </div>
                                    <hr>
                                    <p>หากท่านมีบัญชีอยู่แล้ว  <a href="./login.php" id = "line">เข้าสู่ระบบ</a></p>
                                </form>
                            </div>
                            <div class="tab-pane fade" id = "re">
                                <form action="" method="post" enctype = "multipart/form-data">
                                    <p class="fw-bold fs-3 text-center">ลงทะเบียนร้านอาหาร</p>
                                    <div class="input-group mb-2">
                                        <label for="" class="input-group-text">ชื่อบัญชี</label>
                                        <input type="text" required name = "username" placeholder = "ชื่อบัญชี" class="form-control">
                                    </div>
                                    <div class="input-group mb-2">
                                        <label for="" class="input-group-text">รหัสผ่าน</label>
                                        <input type="password" required name = "password1" placeholder = "รหัสผ่าน" class="form-control">
                                    </div>
                                    <div class="input-group mb-2">
                                        <label for="" class="input-group-text">ยืนยันรหัสผ่าน</label>
                                        <input type="password" required name = "password2" placeholder = "ยืนยันรหัสผ่าน" class="form-control">
                                    </div>
                                    <div class="input-group mb-2">
                                        <label for="" class="input-group-text">ชื่อร้านอาหาร</label>
                                        <input type="text" required name = "fname" placeholder = "ชื่อร้านอาหาร" class="form-control">
                                    </div>
                                    <div class="input-group mb-2">
                                        <label for="" class="input-group-text">ที่อยู่</label>
                                        <input type="text" required name = "address" placeholder = "ที่อยู่ร้านอาหาร" class="form-control">
                                    </div>
                                    <div class="input-group mb-2">
                                        <label for="" class="input-group-text">เบอร์โทร</label>
                                        <input type="text" required name = "phone" placeholder = "เบอร์โทรที่ติดต่อได้" class="form-control">
                                    </div>
                                    <select name="type_user" id="" class="form-control mb-2">
                                        <option selected>--เลือกประเภทร้าน--</option>
                                        <?php
                                        $result = $db->select("type_rest","*");
                                        while($fetch = $result->fetch_object()){
                                        ?>
                                            <option value="<?= $fetch->id_typerest ?>"><?= $fetch->name_typerest ?></option>
                                        <?php } ?>
                                    </select>
                                    <input type="file" name="img" id="" class="form-control mb-2">
                                    <div class="mt-4 mb-4 text-center">
                                        <input type="submit" value="สมัครสมาชิก" name=  "re" class = "btn btn" id = "login">
                                    </div>
                                    <hr>
                                    <p>หากท่านมีบัญชีอยู่แล้ว  <a href="./../shop/login.php" id = "line">เข้าสู่ระบบ</a></p>
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