<div class="container text-center">
    <div class="" style = "height:50px;"></div>
    <div class="row mb-3">
        <p class="fw-bold fs-2 text-start">ยินดีต้อนรับคุณ<?= $adfetch->fname_user ?>  <?= $adfetch->lname_user ?></p>
        <div class="mt-3 mb-4">
            <?php include_once('./component/carousel.php') ?>
        </div>
        <p class="fw-bold fs-4 text-center">รายละเอียดเว็ปไซค์</p>
    </div>
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4">

        <div class="col">
            <div class="card" style = "background-color:yellowgreen; color:#f0f0f0; max-width:540px;">
                <div class="row g-0">
                    <div class="col-4">
                        <img src="../img/p.svg" style = "width:10rem; object-fit:cover;" alt="" class="img-fluid mb-2 mt-2">
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                            <div class="card-title h5">จำนวนสมาชิกทั้งหมด</div>
                            <?php
                            $result = $db->select("users","*","WHERE type_user = 2");
                            $user = $result->num_rows;
                            ?>
                            <div class="card-text">มีทั้งหมด <?= $user ?> คน</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card" style = "background-color:skyblue; color:#f0f0f0; max-width:540px;">
                <div class="row g-0">
                    <div class="col-4">
                        <img src="../img/p.svg" style = "width:10rem; object-fit:cover;" alt="" class="img-fluid mb-2 mt-2">
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                            <div class="card-title h5">จำนวนผู้ส่งอาหารทั้งหมด</div>
                            <?php
                            $result = $db->select("users","*","WHERE type_user = 3");
                            $user = $result->num_rows;
                            ?>
                            <div class="card-text">มีทั้งหมด <?= $user ?> คน</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card" style = "background-color:tomato; color:#f0f0f0; max-width:540px;">
                <div class="row g-0">
                    <div class="col-4">
                        <img src="../img/b.svg" style = "width:10rem; object-fit:cover;" alt="" class="img-fluid mb-2 mt-2">
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                            <div class="card-title h5">จำนวนร้านอาหารทั้งหมด</div>
                            <?php
                            $result = $db->select("rest","*");
                            $user = $result->num_rows;
                            ?>
                            <div class="card-text">มีทั้งหมด <?= $user ?> ร้าน</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card" style = "background-color:salmon; color:#f0f0f0; max-width:540px;">
                <div class="row g-0">
                    <div class="col-4">
                        <img src="../img/c.svg" style = "width:10rem; object-fit:cover;" alt="" class="img-fluid mb-2 mt-2">
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                            <div class="card-title h5">จำนวนออร์เดอร์ทั้งหมด</div>
                            <?php
                            $result = $db->select("orderd","*");
                            $user = $result->num_rows;
                            ?>
                            <div class="card-text">มีทั้งหมด <?= $user ?> รายการ</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>