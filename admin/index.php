<?php
session_start();
include_once("./../database.php");
$db = new db();
$db->checklogin();
$userid = $_SESSION['userid'];
$usertype = $_SESSION['usertype'];
$admin = new db();
$adresult = $admin->select("users","*","WHERE id_user = $userid");
$adfetch = $adresult->fetch_object();
if(isset($_GET['menu'])){
    $menu = $_GET['menu'];
}else{
    $menu = "0";
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
<body>
    <div class="d-block d-sm-block d-md-none" >
        <?php include_once('./layout/navbar2.php') ?>
    </div>
    <div class="container-fluid" style = "height:100vh;">
        <div class="row flex-nowrap" style = "height:100vh;">
            <div class="d-none d-md-block bg-light text-dark col-1 col-md-3 col-lg-2 d-flex d-column justify-content-between" style = "height:100vh;">
                <?php include_once('./layout/navbar.php') ?>
            </div>
            <div class="col-11 col-md-9 col-lg-10" style = "height:100vh; background-color:#f0f0f0">
                <?php include_once('./layout/menu.php') ?>
            </div>
        </div>
    </div>
</body>
</html>