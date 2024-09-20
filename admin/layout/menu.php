<?php
switch($menu){
    case '0' : include_once("./pages/homepage.php"); break;
    case '1' : include_once("./pages/manage_user.php"); break;
    case '2' : include_once("./pages/manage_type.php"); break;
    case '3' : include_once("./../gen/editprofile.php"); break;
    case '4' : include_once("./pages/code_discount.php"); break;
    default : include_once("./pages/homepage.php"); break;
}