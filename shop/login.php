<?php 
include('./../database.php');
session_start();
$db = new db();
if(isset($_POST['login'])){
    $username_user = $_POST['username_user'];
    $password_user = $_POST['password_user'];
    $login = $db->select("rest","*","WHERE username_rest = '$username_user' AND password_rest = '$password_user'");
    if($login->num_rows > 0){
        $fetch = $login->fetch_object();
            if($fetch->status_rest > 0){
                $_SESSION['userid'] = $fetch->id_rest;
                $_SESSION['usertype'] = 'shop';
                header('location:./index.php');
            }else{
                $db->setalert("error","บัญชีของท่านยังไม่ได้รับอนุญาต");
                return;
            }
    }else{
        $db->setalert("error","รหัสผ่านหรือชื่อผู้ใช้ของท่านผิด");
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
</head>
<body>
    <div class="container">
        <div style="height:100px;"></div>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
            <form action="" method="post">
            <p class="font-head border border-1 text-center">ระบบสั่งจองอาหารออนไลน์</p>
            <div class="card shadow">
                <?php $db->loadalert(); ?>
                <div class="card-body">
                    <div class="mb-2">
                        <label for="">ชื่อผู้ใช้</label>
                        <input type="text" name="username_user"  class="form-control" placeholder = "ชื่อผู้ใช้">
                    </div>
                    <div class="mb-2">
                        <label for="">รหัสผ่าน</label>
                        <input type="password" name="password_user"  class="form-control" placeholder = "รหัสผ่าน">
                    </div>
                    <div class="mb-2" align="center">
                        <input type="submit" value="เข้าสู่ระบบ" name="login" id="login" class="btn btn login">
                    </div>
                    <hr class="my-4">
                    <p align="center">ท่านยังไม่ได้สมัครสมาชิกใช่ไหม<a id="line" href="./../gen/register.php">สมัครสมาชิก</a></p>
                </div>
            </div>
            </form>
            </div>
            <div class="col-4"></div>
        </div>
    </div>
</body>
</html>