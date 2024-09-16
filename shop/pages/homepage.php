<?php
if(isset($_POST['save'])){
    $namef = $_POST['namef'];
    $price = $_POST['price'];
    $dis = $_POST['dis'];
    $type_f = $_POST['type_f'];
    $file = $_FILES['img'];
    if($file['name'] != ''){
        $fileN = $db->uploadfile($file);
    }else{
        $fileN = "default.png";
    }
    $list = [
        'name_f' => $namef,
        'price_f' => $price,
        'discount_f' => $dis,
        'type_f' => $type_f,
        'img_f' => $fileN,
        'id_rest' => $userid
    ];
    $rowinsert = $db->insertwhere("food",$list,"(SELECT * FROM food WHERE name_f = '$namef')");
    if($rowinsert > 0){
        $db->setalert("success","เพิ่มอาหารที่ต้องการเสร็จสิ้น !");
        return;
    }else{
        $db->setalert("error","มีอาหารจานนี้ในร้านแล้ว !");
        return;
    }
}
if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $namef = $_POST['namef'];
    $price = $_POST['price'];
    $dis = $_POST['dis'];
    $type_f = $_POST['type_f'];
    $fileold = $_POST['imgold'];
    $file = $_FILES['img'];
    if($file['name'] != ''){
        $fileN = $db->uploadfile($file);
    }else{
        $fileN = $fileold;
    }
    $list = [
        'name_f' => $namef,
        'price_f' => $price,
        'discount_f' => $dis,
        'type_f' => $type_f,
        'img_f' => $fileN
    ];
    $db->update("food",$list,"id_f = $id");
    if($db->query){
        $db->setalert("warning","แก้ไขอาหารที่ต้องการเสร็จสิ้น !");
        return;
    }else{
        $db->setalert("error","ERROR !");
        return;
    }
}
if(isset($_POST['del'])){
    $id = $_POST['id'];
    $db->delete("food","id_f = $id");
    if($db->query){
        $db->setalert("error","ลบอาหารที่ต้องการเสร็จสิ้น !");
        return;
    }else{
        $db->setalert("error","ERROR !");
        return;
    }
}
?>
<div class="container text-center">
    <div class="" style = "height:50px;"></div>
    <div class="row mb-3">
        <p class="fw-bold fs-2 text-start">ยินดีต้อนรับคุณ<?= $adfetch->name_rest ?></p>
        <div class="mt-3 mb-4">
            <?php include_once('./component/carousel.php') ?>
        </div>
    </div>  
    <div class="row justify-content-between mb-3">
        <div class="col-9">
            <p class="fw-bold fs-4 text-start">รายละเอียดอาหารภายในร้าน</p>
        </div>
        <div class="col-3 text-end">
            <?php include_once('./component/food.php') ?>
        </div>
    </div>
    <div class="card shadow" style = "border-radius:10px;">
        <div class="card-body">
            <?php $db->loadalert(); ?>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope = "col">รูป</th>
                        <th scope = "col">ชื่ออาหาร</th>
                        <th scope = "col">ราคาอาหาร</th>
                        <th scope = "col">ส่วนลด</th>
                        <th scope = "col">ประเภท</th>
                        <th scope = "col">แก้ไขอาหาร</th>
                        <th scope = "col">จัดการอาหาร</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $db->select("food,type_f","*","WHERE food.id_rest = $userid AND type_f.id_typef = food.type_f");
                    while($fetch = $result->fetch_object()){
                    ?>
                        <tr>
                            <td><img src="./../img/<?= $fetch->img_f ?>" style = "width:7rem; height:80px; object-fit:cover;" alt="" class="img-fluid"></td>
                            <td><?= $fetch->name_f ?></td>
                            <td><?= $fetch->price_f ?></td>
                            <td><?= $fetch->discount_f ?></td>
                            <td>
                                <span class="badge bg-success rounded-pill fs-6"><?= $fetch->name_typef ?></span>
                            </td>
                            <td><?php include('./component/editfood.php') ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="id" value = "<?= $fetch->id_f ?>">
                                    <input type="submit" value="ลบ" name = "del" class = "btn btn-danger rounded-pill" onclick = "return confirm('ต้องการลบหรือไม่?')">
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>