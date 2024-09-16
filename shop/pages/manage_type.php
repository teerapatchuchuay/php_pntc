<?php
if(isset($_POST['save'])){
    $nametype = $_POST['nametype'];
    $list = [
        'name_typef' => $nametype,
        'id_rest' => $userid
    ];
    $rowinsert = $db->insertwhere("type_f",$list,"(SELECT * FROM type_f WHERE name_typef = '$nametype')");
    if($rowinsert > 0){
        $db->setalert("success","สร้างประเภทอาหารที่ต้องการเสร็จสิ้น !");
        return;
    }else{
        $db->setalert("error","มีประเภทนี้ในระบบแล้ว !");
        return;
        echo $db->geterror();
    }
}
if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $nametype = $_POST['nametype'];
    $list = [
        'name_typef' => $nametype
    ];
    $db->update('type_f',$list,"id_typef = $id");
    if($db->query){
        $db->setalert("warning","แก้ไขประเภทที่ต้องการเสร็จสิ้น !");
        return;
    }else{
        $db->setalert("error","ERROR !");
        return;
    }
}
if(isset($_POST['del'])){
    $id = $_POST['id'];
    $db->delete('type_f',"id_typef = $id");
    if($db->query){
        $db->setalert("error","ลบประเภทที่ต้องการเสร็จสิ้น !");
        return;
    }else{
        $db->setalert("error","ERROR !");
        return;
    }
}
?>
<div class="container text-center">
    <div class="" style = "height:50px;"></div>
    <div class="row justify-content-between">
        <div class="col-9">
            <p class="fw-bold fs-2 text-start">จัดการประเภทร้านอาหาร</p>
        </div>
        <div class="col-3 text-end">
            <?php include_once('./component/type.php'); ?>
        </div>
    </div>
    <div class="card shadow" style = "border-radius:10px;">
        <div class="card-body">
            <?php $db->loadalert(); ?>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope = "col">ลำดับ</th>
                        <th scope = "col">ชื่อประเภท</th>
                        <th scope = "col">แก้ไขประเภท</th>
                        <th scope = "col">ผู้จัดการประเภท</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $db->select('type_f',"*","WHERE id_rest = $userid");
                    $i = "0";
                    while($fetch = $result->fetch_object()){
                        $i++;
                    ?>
                        <tr>
                            <th scope = "col"><?= $i ?></th>
                            <td><?= $fetch->name_typef ?></td>
                            <td><?php include('./component/edit.php') ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="id" value = "<?= $fetch->id_typef ?>">
                                    <input type="submit" value="ลบ" class = "btn btn-danger rounded-pill" name = "del" onclick = "return confirm('ต้องการลบหรือไม่?')">
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>