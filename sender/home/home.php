<?php 
$db = new db();
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
            <div class="col-2"></div>
            <div class="col-8">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 align="center">ร้านอาหารที่ออร์เดอร์</h2>
                    </div>
                </div>
                <div class="mt-2"></div>
                <div class="card shadow">
                    <div class="card-body">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                        <?php 
                        $rest = $db->select("orderd,rest","*","WHERE orderd.id_rest = rest.id_rest AND status_or = 2 ");
                        while($fetchrest = $rest->fetch_object()){
                        ?>
                        <div class="col">
                            <a href="./showfood.php?id_rest=<?=$fetchrest->id_rest?>" style=" text-decoration:none;">
                            <div class="card shadow">
                                <img src="./../img/<?=$fetchrest->img_rest?>" class="img-fluid " style=" object-fit:cover;max-height:100px;  " alt="">
                                <div class="card-body">
                                    <h5><?=$fetchrest->name_rest?></h5>
                                    <div class="card-title">
                                        <h5><?=$fetchrest->address_rest?></h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>
                        <?php } ?> 
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
</body>
</html>