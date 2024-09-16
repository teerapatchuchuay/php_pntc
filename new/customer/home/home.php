<?php 
$db = new db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ร้านอาหาร</title>
    <link rel="stylesheet" href="./../bootstrap/css/bootstrap.css">
    <script src="./../bootstrap/js/bootstrap.js"></script>
    <script src="./../bootstrap/js/bootstrap.esm.js"></script>
    <script src="./../bootstrap/js/bootstrap.bundle.js"></script>
    <style>
    .font-head{
        font-size:2rem;
        font-weight:bold;
        border-radius:10px;
        backdrop-filter:blur(10px);
        color:white;
    }
    .body{
        background-color: #f0f0f0;
    }
    .text{
        border-radius:20px;
        color:white;
        background-color: orange ;
    }
</style>
</head>
<body class="body">
    <div class="container text-center">
        <div style="height:100px;"></div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="card shadow" style = "border-radius:10px;">
                    <div class="card-body">
                <div class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner" style="object-fit:cover; max-height:200px;">
                        <div class="carousel-item active">
                            <img src="./../img/96593450.jpeg" class="w-100 h-25" alt="">
                        </div>
                        <div class="carousel-item ">
                            <img src="./../img/547312468.jpg" class="w-100 h-25"  alt="">
                        </div>
                        <div class="carousel-item ">
                            <img src="./../img/752162104.jpeg" class="w-100 h-25" alt="">
                        </div>
                    </div>
                </div>
                <div class="mt-2"></div>
                <?php 
                $type = $db->select("type_rest","*");
                while($fetchtype = $type->fetch_object()){
                ?>
                <h2 class="text" align="center"><?=$fetchtype->name_typerest?></h2>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                    <?php
                    if(isset($_POST['like']) && isset($_POST['search']) && isset($_POST['search']) != ''){
                        $search = $_POST['search'];
                        $rest = $db->select("rest","*","WHERE status_rest = 1 AND type_rest = $fetchtype->id_typerest AND name_rest LIKE '%$search%'");
                    }else{
                        $rest = $db->select("rest","*","WHERE status_rest = 1 AND type_rest = $fetchtype->id_typerest ");
                    }
                    while($fetchrest = $rest->fetch_object()){
                    ?>
                        <a href="./showfood.php?id_rest=<?=$fetchrest->id_rest?>" style="text-decoration:none;">
                            <div class="col mb-2">
                        <div class="card shadow" style="max-height:190px;">
                            <img src="./../img/<?=$fetchrest->img_rest?>" class="img-fluid" style="max-height:80px;" alt="">
                            <div class="card-body">
                                <h5><?=$fetchrest->name_rest?></h5>
                               <div class="card-title">
                                <p><?=$fetchrest->address_rest?></pz>
                               </div>
                            </div>
                        </div>
                    </div>
                    </a>
                    <?php } ?>
                </div>
                <?php } ?>
                </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
</body>
</html>