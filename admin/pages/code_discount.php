<?php 
if(isset($_POST['add_code'])){
    $code = $_POST['code'];
    $price = $_POST['price'];
    $data = [
        'code' => $code,
        'price' => $price
    ];
    $db->insert("codes_discount",$data);
    if($db->query){
        $db->setalert("success","เพิ่มโค้ดส่วนลดสำเร็จ");
        return;
    }else{
        $db->setalert("error","เกิดข้อผิดพลาด"); 
        return;
    }
}
if(isset($_POST['del'])){
    $id = $_POST['id'];
    $db->delete("codes_discount","id_code = $id");
    if($db->query){
        $db->setalert("error","ลบสำเร็จ");
        return;
    }else{
        $db->setlert("erorr","เกิดข้อผิดพลาด");
        return;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>addcode_discont</title>
</head>
<body>
    <div class="container text-center">
        <div style="height:100px;"></div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <?php $db->loadalert(); ?>
                <form action="" method="post">
                <div class="card">
                    <div class="card-header" style="background-color:#ffff;">
                    <label for="">เพิ่มโค้ดส่วนลด</label>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                           <input type="text" name="code" class="form-control" placeholder="โค้ดส่วนลด">
                        </div>
                        <div class="mb-2">
                            <input type="text" name="price" placeholder="ส่วนลด" class="form-control">
                        </div>
                        <div class="mb-2" align="center">
                            <input type="submit" value="บันทึก" name="add_code" class="btn btn-success" style="border-radius:20px;">
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
        <div style="height:50px;"></div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <form action="" method="post">
                <div class="card">
                    <div class="card-header" style="background-color:#ffff;">
                        <label for="">จัดการโค้ดส่วนลด</label>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>โค้ดส่วนลด</th>
                                    <th>ส่วนลด(บาท)</th>
                                    <th>ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php 
                                    $code = $db->select("codes_discount","*");
                                    while($fetch = $code->fetch_object()){
                                    ?>
                                <tr>
                                    <td class="col-2"><?=$fetch->id_code?></td>
                                    <td class="col-4"><?= $fetch->code ?></td>
                                    <td><?= $fetch->price ?></td>
                                    <td class="col-2">
                                        <input type="hidden" name="id" value="<?= $fetch->id_code ?>">
                                        <input type="submit" value="ลบ" name="del" class="btn btn-danger" style="border-radius:20px;">
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>