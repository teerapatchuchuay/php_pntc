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
    <style>
        .customer{
            background-color:#f9ac4c;
        }
    </style>
</head>
<body>
    <nav class=" navbar navbar-expand-sm navbar-dark customer">
        <div class="container-fluid">
            <a href="" class="navbar-brand">ระบบสั่งจองอาหาร</a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="./index.php?menu=0" class="nav-link <?= $menu == '0' ? 'active' : '' ?>">หน้าแรก</a>
                    </li>
                    <li class="nav-item">
                        <a href="./index.php?menu=1" class="nav-link <?= $menu == '1' ? 'active' : '' ?>">แก้ไขข้อมูล</a>
                    </li>
                    <li class="nav-item">
                        <a href="./index.php?menu=2"class="nav-link <?= $menu == '2' ? 'active' : '' ?>">ประวัติการสั่งซื้อ</a>
                    </li>
                    <li class="nav-item">
                        <a href="./../gen/login.php" class="nav-link">เข้าสู่ระบบและสมัครสมาชิก</a>
                    </li>
                </ul>
                <ul class="nav nav-link">
                    <form action="" method="post" class="d-flex ">
                        <input type="text" name="serach"  class="form-control me-2">
                        <input type="submit" value="ค้นหา"  name="like" class="btn btn-success" placeholder = "ค้นหาร้านที่ท่านต้องการ">
                    </form>
                </ul>
                <ul class=" nav nav-link">
                 <a href="./../logout.php" class="btn btn-danger " onclick = "return confirm('ต้องการออกจากระบบหรือไม่?')">ออกจากระบบ</a>
                </ul>
            </div>
        </div>
    </nav>
</body>
</html>