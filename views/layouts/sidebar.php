<?php session_start();
if (!isset($_SESSION['id_users'])) {
    header('Location: login.php');
}
 ?>

<div class="off-canvas-overlay" data-toggle="sidebar"></div>
<div class="sidebar-panel">
    <div class="brand">
        <!-- toggle offscreen menu -->
        <a href="javascript:;" data-toggle="sidebar" class="toggle-offscreen hidden-lg-up">
            <i class="material-icons">menu</i>
        </a>
        <!-- /toggle offscreen menu -->
        <!-- logo -->
        <!-- <a class="brand-logo">
            <img class="expanding-hidden" src="../assets/images/logo.png" alt="" />
        </a> -->
        <a class="brand-logo">
            <span style="color: #000; font-size: 18px;"><strong>Multi Attribute Utility Theory</strong></span>
        </a>
        <!-- /logo -->
    </div>
    <div class="nav-profile dropdown">
        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
            <div class="user-image">
                <img src="../assets/images/avatar.jpg" class="avatar img-circle" alt="user" title="user" />
            </div>
            <div class="user-info expanding-hidden">
                <?php echo ucfirst($_SESSION['nama']) ?>
                <small class="bold"><?php echo ucfirst($_SESSION['role']) ?></small>
            </div>
        </a>
        <div class="dropdown-menu">
            <!-- <div class="dropdown-divider"></div> -->
            <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
    </div>
    <!-- main navigation -->
    <nav>
        <p class="nav-title">NAVIGATION</p>
        <ul class="nav">
            <!-- dashboard -->
            <li>
                <a href="index.php">
                    <i class="material-icons text-primary">home</i>
                    <span>Home</span>
                </a>
            </li>
            <?php if($_SESSION['role'] == 'admin'){ ?>
            <li>
                <a href="kriteria.php">
                    <i class="material-icons text-primary">assignment</i>
                    <span>Kriteria</span>
                </a>
            </li>
            <li>
                <a href="karyawan.php">
                    <i class="material-icons text-primary">people</i>
                    <span>Karyawan</span>
                </a>
            </li>
            <li>
                <a href="cek_hitung.php">
                    <i class="material-icons text-primary">rate_review</i>
                    <span>Penilaian</span>
                </a>
            </li>
            <?php } ?>
            <li>
                <a href="history.php">
                    <i class="material-icons text-primary">history</i>
                    <span>History</span>
                </a>
            </li>

            <!-- /charts -->
        </ul>

    </nav>
    <!-- /main navigation -->
</div>