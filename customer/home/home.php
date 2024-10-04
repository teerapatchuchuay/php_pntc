<?php 
$db = new db();
$checkuser = isset($_SESSION['userid']);
$userid = $checkuser ? $_SESSION['userid'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .text {
            border-radius: 20px;
            background-color: orange;
            color: white;
        }
    </style>
   
</head>
<body>
    <div class="container">
        <div style="height:100px;"></div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner" style="object-fit:cover; max-height:200px;">
                                <div class="carousel-item active">
                                    <img src="./../img/1188718.jpg" class="w-100 h-25 " alt="">
                                </div>
                                <div class="carousel-item">
                                    <img src="./../img/96593450.jpeg" class="w-100 h-25 " alt="">
                                </div>
                                <div class="carousel-item">
                                    <img src="./../img/279708533.jpeg" class="w-100 h-25 " alt="">
                                </div>
                            </div>
                            <div class="mt-2"></div>
                            <?php 
                            $type = $db->select("type_rest", "*");
                            while($fetchtype = $type->fetch_object()){
                            ?>
                            <h2 class="text text-center"><?= $fetchtype->name_typerest ?></h2>
                            <div class="mt-2">
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                                    <?php 
                                    if (isset($_POST['like']) && isset($_POST['serach']) && !empty($_POST['serach'])) {
                                        $serach = $_POST['serach'];
                                        $rest = $db->select("rest", "*", "WHERE type_rest = $fetchtype->id_typerest AND name_rest LIKE '%$serach%'");
                                    } else {
                                        $rest = $db->select("rest", "*", "WHERE type_rest = $fetchtype->id_typerest");
                                    }
                                    while ($fetchrest = $rest->fetch_object()) {
                                    ?>
                                    <div class="col mb-2">
                                        <a href="./showfood.php?id_rest=<?= $fetchrest->id_rest ?>" style="text-decoration:none;">
                                            <div class="card shadow ">
                                                <img src="./../img/<?= $fetchrest->img_rest ?>" class="img-fluid" style="object-fit:cover; max-height:100px; " alt="">
                                                <div class="card-body">
                                                    <div class="card-title">
                                                        <p><?= $fetchrest->address_rest ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <?php } ?>
                                </div>
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
<script>
        window.onload = function() {
            <?php if (!$checkuser): ?>
                alert("เข้าสูระบบหรือสมัครสมาชิกก่อน");
            <?php endif; ?>
        };
    </script>
