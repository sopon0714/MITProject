<!--############################### start Sidebar ############################### -->
<ul class="navbar-nav  sidebar sidebar-dark accordion  " style="background-color: #bf4040" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon ">
            <i class="fas fa-hotel"></i>
        </div>
        <div class="sidebar-brand-text mx-3">หอพักอยู่ดีมีสุข</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-1">

    </li>
    <li class='nav-item'>
        <a class='nav-link collapsed' href="../../views/profile/profile.php" data-toggle='' data-target='' aria-expanded='true' aria-controls=''>
            <i class="fas fa-user-alt"></i>
            <span>บัญชีผู้ใช้</span>
        </a>
    </li>

    <li class='nav-item'>
        <a class='nav-link collapsed' href="../../views/agreement/agreement.php" data-toggle='collapse' data-target='#link' aria-expanded='true' aria-controls='link-2'>
            <i class="fas fa-users"></i>
            <span>การจัดการผู้ใช้</span>
        </a>
        <div id='link' class='collapse' aria-labelledby='headingTwo' data-parent='#accordionSidebar'>
            <div class=' py-2 collapse-inner rounded' style='border-left: 2px solid white; border-radius: 0% !important;'>
                <div class="background-color-sideber" style="background-color: #bf4040" id="accordionSidebar">
                    <a class='nav-link' href="../../views/agreement/agreement.php">การจัดการผู้เช่า</a>
                    <a class='nav-link' href='../Booking/reserved_detail_reserver.php'>การจัดการผู้ดูแล</a>
                </div>
            </div>
        </div>
    </li>

    <li class='nav-item'>
        <a class='nav-link collapsed' href="../../views/config/config.php" data-toggle='' data-target='' aria-expanded='true' aria-controls=''>
            <i class="fas fa-wrench"></i>
            <span>การจัดการหอพัก</span>
        </a>
    </li>
    <li class='nav-item'>
        <a class='nav-link collapsed' href="../../views/room/room.php" data-toggle='' data-target='' aria-expanded='true' aria-controls=''>
            <i class="fas fa-key"></i>
            <span>การจัดการห้อง</span>
        </a>
    </li>
    <li class='nav-item'>
        <a class='nav-link collapsed' href="../../views/payment/payment.php" data-toggle='' data-target='' aria-expanded='true' aria-controls=''>
            <i class="fas fa-hand-holding-usd"></i>
            <span>การจัดการชำระค่าเช่ารายเดือน</span>
        </a>
    </li>
    <li class='nav-item'>
        <a class='nav-link collapsed' href="../../views/inform/showinform.php" data-toggle='' data-target='' aria-expanded='true' aria-controls=''>
            <i class="fas fa-comment-dots"></i>
            <span>แสดงคำร้อง</span>
        </a>
    </li>
    <li class='nav-item'>
        <a class='nav-link' href='../../logout.php'>
            <i class='material-icons'>meeting_room</i>
            <span>ออกจากระบบ</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class=" text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!--############################### end Sidebar ############################### -->