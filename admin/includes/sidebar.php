<?php

$currentPage = basename($_SERVER['PHP_SELF']);

$namaAdmin = "Administrator";

if (!empty($admin['nama'])) {
    $namaAdmin = $admin['nama'];
}

?>

<!-- Overlay Mobile -->

<div id="sidebar-overlay"></div>

<!-- Sidebar -->

<div id="sidebar">

    <!-- Logo -->

    <!-- <div class="sidebar-header">

        <div class="logo-icon">

            <i class="bi bi-mortarboard-fill"></i>

        </div>

        <h4>

            Portal Sekolah

        </h4>

        <small>

            <?= htmlspecialchars($namaAdmin); ?>

        </small>

    </div> -->
    <div class="sidebar-header">

        <button id="close-sidebar" class="btn btn-light btn-sm d-lg-none float-right">

            <i class="bi bi-x-lg"></i>

        </button>

        <div class="logo-icon">

            <i class="bi bi-mortarboard-fill"></i>

        </div>

        <h4>

            Portal Sekolah

        </h4>

        <small>

            <?= htmlspecialchars($namaAdmin); ?>

        </small>

    </div>

    <!-- Menu -->

    <ul class="sidebar-menu">

        <li>

            <a href="dashboard.php" class="<?= $currentPage=='dashboard.php'?'active':''; ?>">

                <i class="bi bi-speedometer2"></i>

                Dashboard

            </a>

        </li>

        <li>

            <a href="kategori.php" class="<?= $currentPage=='kategori.php'?'active':''; ?>">

                <i class="bi bi-grid"></i>

                Kategori

            </a>

        </li>

        <li>

            <a href="subkategori.php" class="<?= $currentPage=='subkategori.php'?'active':''; ?>">

                <i class="bi bi-folder2-open"></i>

                Subkategori

            </a>

        </li>

        <li>

            <a href="users.php" class="<?= $currentPage=='users.php'?'active':''; ?>">

                <i class="bi bi-people"></i>

                User

            </a>

        </li>

        <li>

            <a href="setting.php" class="<?= $currentPage=='setting.php'?'active':''; ?>">

                <i class="bi bi-gear"></i>

                Pengaturan

            </a>

        </li>

    </ul>
    <!-- Footer Sidebar -->

    <div class="sidebar-footer">

        <a href="logout.php" class="btn btn-danger btn-block">

            <i class="bi bi-box-arrow-right"></i>

            Logout

        </a>

    </div>

</div>