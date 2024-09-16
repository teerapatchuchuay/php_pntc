<?php 
switch($menu){
    case "0" : include_once('./home/home.php'); break ;
    case "1" : include_once('./../gen/editprofile.php'); break ;
    case "2" : include_once('./hs.php'); break ;
    default : include_once('./home/home.php'); break ;
}
?>