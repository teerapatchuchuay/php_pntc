<div class="bg-light text-dark p-2">
    <div class="text-center text-dark mt-4">
        <h4>Admin Food Delivery</h4>
    </div>
    <div class="text-center mb-2 mt-2">
        <img src="./../img/<?= $adfetch->img_rest ?>" alt="" style = "height:80px; width:80px; object-fit:cover;" class="img-fluid rounded-circle">
    </div>
    <ul class="nav nav-pills flex-column mt-4 mt-sm-0">
        <li class="nav-item py-2 py-sm-0"><a href="index.php?menu=0" class="nav-link <?= $menu == '0' ? 'active' : '' ?>">หน้าแรก</a></li>
        <li class="nav-item py-2 py-sm-0"><a href="index.php?menu=2" class="nav-link <?= $menu == '2' ? 'active' : '' ?>">จัดการประเภทอาหาร</a></li>
        <li class="nav-item py-2 py-sm-0"><a href="index.php?menu=1" class="nav-link <?= $menu == '1' ? 'active' : '' ?>">จัดการออร์เดอร์</a></li>
        <li class="nav-item py-2 py-sm-0"><a href="index.php?menu=4" class="nav-link <?= $menu == '4' ? 'active' : '' ?>">สรุปรายได้</a></li>
        <li class="nav-item py-2 py-sm-0"><a href="index.php?menu=3" class="nav-link <?= $menu == '3' ? 'active' : '' ?>">การตั้งค่า</a></li>
        <li class="nav-item py-2 py-sm-0"><a href="./../logout.php" class="btn btn-danger mt-4" onclick = "return confirm('ต้องการออกจากระบบหรือไม่?')">ออกจากระบบ</a></li>
    </ul>
</div>