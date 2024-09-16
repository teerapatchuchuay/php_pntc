<?php 
include('./../database.php');
session_start();
$dbindex = new db();

if(isset($_GET['menu'])){
    $menu = $_GET['menu'];
}else{
    $menu = 0;
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
    <div class="container-fluid">
        <?php include_once('./la/la.php'); ?>
    </div>
</body>
</html>