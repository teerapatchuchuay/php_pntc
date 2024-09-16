<?php
if(isset($_POST['save'])){
    $nametype = $_POST['nametype'];
    $list = [
        'name_typerest' => $nametype
    ];
    $rowinsert = $db->insertwhere("type_rest",$list,"(SELECT * FROM type_rest WHERE name_typerest = '$nametype')");
    if($rowinsert > 0){
        $db->setalert("success","สร้างประเภทร้านที่ต้องการเสร็จสิ้น !");
        return;
    }else{
        $db->setalert("error","มีประเภทนี้ในระบบแล้ว !");
        return;
    }
}
if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $nametype = $_POST['nametype'];
    $list = [
        'name_typerest' => $nametype
    ];
    $db->update('type_rest',$list,"id_typerest = $id");
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
    $db->delete('type_rest',"id_typerest = $id");
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
                    $result = $db->select('type_rest',"*");
                    $i = "0";
                    while($fetch = $result->fetch_object()){
                        $i++;
                    ?>
                        <tr>
                            <th scope = "col"><?= $i ?></th>
                            <td><?= $fetch->name_typerest ?></td>
                            <td><?php include('./component/edit.php') ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="id" value = "<?= $fetch->id_typerest ?>">
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