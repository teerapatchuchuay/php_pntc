<?php
session_start();
if($_SESSION['usertype'] == 'shop'){
    session_destroy();
    unset($_SESSION['userid']);
    header('location:./shop/login.php');
}else{
    session_destroy();
    unset($_SESSION['userid']);
    header('location:./gen/login.php');
}