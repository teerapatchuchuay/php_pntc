<nav class=" navbar navbar-expand-sm navbar-dark " style = "background-color:#f9ac4c">
        <div class="container-fluid">
            <button class="navbar-toggler" data-bs-toggler="collapse" data-bs-target="#nav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="./index.php?menu=0" class="nav-link <?= $menu == '0' ? 'active' : '' ?>">หน้าแรก</a>
                    </li>
                    <li class="nav-item">
                        <a href="./index.php?menu=2" class="nav-link <?= $menu == '2' ? 'active' : '' ?>">จัดการประเภทอาหาร</a>
                    </li>
                    <li class="nav-item">
                        <a href="./index.php?menu=1"class="nav-link <?= $menu == '1' ? 'active' : '' ?>">จัดการออร์เดอร์</a>
                    </li>
                    <li class="nav-item">
                        <a href="./index.php?menu=4"class="nav-link <?= $menu == '4' ? 'active' : '' ?>">สรุปรายได้</a>
                    </li>
                    <li class="nav-item">
                        <a href="./index.php?menu=3"class="nav-link <?= $menu == '3' ? 'active' : '' ?>">การตั้งค่า</a>
                    </li>
                </ul>
                <ul class=" nav nav-link">
                    <a href="./../logout.php" class="btn btn-success" onclick = "return confirm('ต้องการออกจากระบบหรือไม่?')">ออกจากระบบ</a>
                </ul>
            </div>
        </div>
    </nav>