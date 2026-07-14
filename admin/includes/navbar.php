<?php

$pageTitle = $pageTitle ?? 'Dashboard';

$namaAdmin = 'Administrator';

if (!empty($admin['nama'])) {
    $namaAdmin = $admin['nama'];
}

?>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom">

    <button class="btn btn-primary d-lg-none" id="menu-toggle">

        <i class="bi bi-list"></i>

    </button>

    <div class="ml-3">

        <h5 class="mb-0 font-weight-bold">

            <?= htmlspecialchars($pageTitle); ?>

        </h5>

        <small class="text-muted">

            Portal Sekolah

        </small>

    </div>

    <div class="ml-auto d-flex align-items-center">
        <div class="dropdown">

            <a href="#" class="d-flex align-items-center text-dark dropdown-toggle" id="dropdownProfile"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-decoration:none;">

                <div class="mr-3 text-right d-none d-md-block">

                    <div class="font-weight-bold">

                        <?= htmlspecialchars($namaAdmin); ?>

                    </div>

                    <small class="text-muted">

                        Administrator

                    </small>

                </div>

                <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center"
                    style="width:45px;height:45px;">

                    <i class="bi bi-person-fill"></i>

                </div>

            </a>

            <div class="dropdown-menu dropdown-menu-right shadow border-0">

                <a class="dropdown-item" href="profile.php">

                    <i class="bi bi-person mr-2"></i>

                    Profil Saya

                </a>

                <a class="dropdown-item" href="setting.php">

                    <i class="bi bi-gear mr-2"></i>

                    Pengaturan

                </a>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item text-danger" href="logout.php">

                    <i class="bi bi-box-arrow-right mr-2"></i>

                    Logout

                </a>

            </div>

        </div>

    </div>

</nav>

<div class="container-fluid mt-4">