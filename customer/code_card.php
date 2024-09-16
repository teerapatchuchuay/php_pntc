<?php 
include('./../database.php');
session_start();
$db = new db();
$id_cart = $_GET['id_cart'];
$id_rest = $_GET['id_rest'];
$amount = $_GET['amount'];

if(isset($_GET['sum'])){
    $id_cart = $_GET['id_cart'];
    $amount = $_GET['amount'];
    $date = [
         'amount' => $amount+1
    ];
    $db->update("cart",$date,"id_cart = $id_cart");
    if($db->query){
        $db->setalert("success","แก้ไขสำเร็จ");
        header("location:./showfood.php?id_rest=".$id_rest);
        return;
       
    }else{
        $db->setalert("error","เกิดข้อผิดพลาด");
        header("location:./showfood.php?id_rest=".$id_rest);
        return;
       
    }
}
if(isset($_GET['cel'])){
    $id_cart = $_GET['id_cart'];
    $amount = $_GET['amount'];
    $date = [
         'amount' => $amount-1
    ];
    $db->update("cart",$date,"id_cart = $id_cart");
    if($db->query){
        $db->setalert("success","แก้ไขสำเร็จ");
        header("location:./showfood.php?id_rest=".$id_rest);
        return;
    }else{
        $db->setalert("error","เกิดข้อผิดพลาด");
        header("location:./showfood.php?id_rest=".$id_rest);
        return;
    }
}
?>