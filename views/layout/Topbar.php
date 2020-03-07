<!--############################### start Topbar ############################### -->
<?php
$DATAUSER = $_SESSION['DATAUSER'] ?? NULL;
?>
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <ul>
        <div class="text-left " style="padding-top:20px;color: #bf4040;">
            <h5>ระบบบริหารจัดการหอพักอยู่ดีมีสุข</h5>
        </div>
    </ul>
    <ul class="navbar-nav ml-auto">


        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $DATAUSER['title'] . $DATAUSER['firstname'] . " " . $DATAUSER['lastname']; ?><br><span style="color: tomato;float:right;"><?= "({$DATAUSER['type']})" ?></span></span>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="../../views/profile/profile.php">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    บัญชีผู้ใช้
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../../logout.php">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    ออกจากระบบ
                </a>
            </div>
        </li>
    </ul>
</nav>
<!--############################### end Topbar ############################### -->