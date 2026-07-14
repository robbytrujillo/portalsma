<?php

session_start();

require_once "../config/config.php";

/*
|--------------------------------------------------------------------------
| Cek Login
|--------------------------------------------------------------------------
*/

if (!isset($_SESSION['login'])) {

    header("Location: login.php");
    exit;

}

/*
|--------------------------------------------------------------------------
| Statistik Dashboard
|--------------------------------------------------------------------------
*/

$totalKategori = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM kategori")
);

$totalSubkategori = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM subkategori")
);

$totalUser = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM users")
);

?>
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body class="bg-light">
    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->

        <div class="bg-white border-right sidebar-admin" id="sidebar-wrapper">

            <div class="sidebar-heading text-center py-4">

                <h4 class="font-weight-bold text-primary">

                    Portal Admin

                </h4>

            </div>

            <div class="list-group list-group-flush">

                <a href="dashboard.php" class="list-group-item list-group-item-action active">

                    <i class="bi bi-speedometer2"></i>

                    Dashboard

                </a>

                <a href="kategori.php" class="list-group-item list-group-item-action">

                    <i class="bi bi-grid"></i>

                    Kategori

                </a>

                <a href="subkategori.php" class="list-group-item list-group-item-action">

                    <i class="bi bi-folder2-open"></i>

                    Subkategori

                </a>

                <a href="users.php" class="list-group-item list-group-item-action">

                    <i class="bi bi-people"></i>

                    Users

                </a>

                <!-- <a href="logout.php" class="list-group-item list-group-item-action text-danger">

                    <i class="bi bi-box-arrow-right"></i>

                    Logout

                </a> -->
                <a href="logout.php" class="dropdown-item text-danger btn-logout">

                    <i class="bi bi-box-arrow-right mr-2"></i>

                    Logout

                </a>

            </div>

        </div>

        <!-- Page Content -->

        <div id="page-content-wrapper" class="w-100">
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">

                <button class="btn btn-primary" id="menu-toggle">

                    <i class="bi bi-list"></i>

                </button>

                <span class="ml-3 font-weight-bold">

                    Dashboard

                </span>

            </nav>

            <div class="container-fluid mt-4">

                <div class="row">

                    <div class="col-md-4 mb-4">

                        <div class="card border-0 shadow-sm">

                            <div class="card-body">

                                <div class="d-flex justify-content-between">

                                    <div>

                                        <h6>Total Kategori</h6>

                                        <h2>

                                            <?= $totalKategori['total']; ?>

                                        </h2>

                                    </div>

                                    <i class="bi bi-grid display-4 text-primary"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4 mb-4">

                        <div class="card border-0 shadow-sm">

                            <div class="card-body">

                                <div class="d-flex justify-content-between">

                                    <div>

                                        <h6>Total Subkategori</h6>

                                        <h2>

                                            <?= $totalSubkategori['total']; ?>

                                        </h2>

                                    </div>

                                    <i class="bi bi-folder2-open display-4 text-success"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4 mb-4">

                        <div class="card border-0 shadow-sm">

                            <div class="card-body">

                                <div class="d-flex justify-content-between">

                                    <div>

                                        <h6>Total Admin</h6>

                                        <h2>

                                            <?= $totalUser['total']; ?>

                                        </h2>

                                    </div>

                                    <i class="bi bi-people display-4 text-warning"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>
                <?php

/*
|--------------------------------------------------------------------------
| Data Terbaru
|--------------------------------------------------------------------------
*/

$qKategori = mysqli_query($conn, "
SELECT *
FROM kategori
ORDER BY created_at DESC
LIMIT 5
");

$qSubkategori = mysqli_query($conn, "
SELECT
subkategori.*,
kategori.nama_kategori
FROM subkategori
INNER JOIN kategori
ON kategori.id=subkategori.kategori_id
ORDER BY subkategori.created_at DESC
LIMIT 5
");

?>

                <div class="row">

                    <!-- ================= WELCOME ================= -->

                    <div class="col-lg-12 mb-4">

                        <div class="card border-0 shadow-sm">

                            <div class="card-body">

                                <h4 class="font-weight-bold">

                                    Selamat Datang 👋

                                </h4>

                                <p class="text-muted mb-0">

                                    Selamat datang di Dashboard Portal Sekolah.
                                    Gunakan menu di sebelah kiri untuk mengelola kategori,
                                    subkategori, pengguna, dan pengaturan portal.

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <!-- ================= KATEGORI TERBARU ================= -->

                    <div class="col-lg-6 mb-4">

                        <div class="card border-0 shadow-sm">

                            <div class="card-header bg-white">

                                <strong>

                                    Kategori Terbaru

                                </strong>

                            </div>

                            <div class="table-responsive">

                                <table class="table table-hover mb-0">

                                    <thead>

                                        <tr>

                                            <th>#</th>

                                            <th>Nama</th>

                                            <th>Status</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php
                        $no = 1;
                        while($k = mysqli_fetch_assoc($qKategori)):
                        ?>

                                        <tr>

                                            <td><?= $no++; ?></td>

                                            <td>

                                                <?= htmlspecialchars($k['nama_kategori']); ?>

                                            </td>

                                            <td>

                                                <?php if($k['status']=="Aktif"): ?>

                                                <span class="badge badge-success">

                                                    Aktif

                                                </span>

                                                <?php else: ?>

                                                <span class="badge badge-danger">

                                                    Nonaktif

                                                </span>

                                                <?php endif; ?>

                                            </td>

                                        </tr>

                                        <?php endwhile; ?>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                    <!-- ================= SUB KATEGORI TERBARU ================= -->

                    <div class="col-lg-6 mb-4">

                        <div class="card border-0 shadow-sm">

                            <div class="card-header bg-white">

                                <strong>

                                    Subkategori Terbaru

                                </strong>

                            </div>

                            <div class="table-responsive">

                                <table class="table table-hover mb-0">

                                    <thead>

                                        <tr>

                                            <th>#</th>

                                            <th>Nama</th>

                                            <th>Kategori</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php
                        $no = 1;
                        while($s = mysqli_fetch_assoc($qSubkategori)):
                        ?>

                                        <tr>

                                            <td><?= $no++; ?></td>

                                            <td>

                                                <?= htmlspecialchars($s['nama_subkategori']); ?>

                                            </td>

                                            <td>

                                                <?= htmlspecialchars($s['nama_kategori']); ?>

                                            </td>

                                        </tr>

                                        <?php endwhile; ?>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>
                <?php

/*
|--------------------------------------------------------------------------
| Layanan Terpopuler
|--------------------------------------------------------------------------
*/

$qPopular = mysqli_query($conn, "
SELECT
    nama_subkategori,
    total_click
FROM subkategori
ORDER BY total_click DESC, nama_subkategori ASC
LIMIT 5
");

$chartLabel = [];
$chartData  = [];

mysqli_data_seek($qPopular, 0);

while ($row = mysqli_fetch_assoc($qPopular)) {

    $chartLabel[] = $row['nama_subkategori'];
    $chartData[]  = (int)$row['total_click'];

}

mysqli_data_seek($qPopular, 0);

?>

                <div class="row">

                    <!-- QUICK MENU -->

                    <div class="col-lg-4 mb-4">

                        <div class="card border-0 shadow-sm">

                            <div class="card-header bg-white">

                                <strong>Quick Menu</strong>

                            </div>

                            <div class="card-body">

                                <a href="kategori.php" class="btn btn-primary btn-block mb-3">

                                    <i class="bi bi-grid"></i>

                                    Kelola Kategori

                                </a>

                                <a href="subkategori.php" class="btn btn-success btn-block mb-3">

                                    <i class="bi bi-folder2-open"></i>

                                    Kelola Subkategori

                                </a>

                                <a href="users.php" class="btn btn-info btn-block mb-3">

                                    <i class="bi bi-people"></i>

                                    Kelola User

                                </a>

                                <a href="setting.php" class="btn btn-warning btn-block">

                                    <i class="bi bi-gear"></i>

                                    Pengaturan Website

                                </a>

                            </div>

                        </div>

                    </div>

                    <!-- LAYANAN TERPOPULER -->

                    <div class="col-lg-8 mb-4">

                        <div class="card border-0 shadow-sm">

                            <div class="card-header bg-white">

                                <strong>

                                    Layanan Paling Banyak Diakses

                                </strong>

                            </div>

                            <div class="table-responsive">

                                <table class="table table-hover mb-0">

                                    <thead>

                                        <tr>

                                            <th>No</th>

                                            <th>Layanan</th>

                                            <th>Total Klik</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php

                        $no = 1;

                        while($pop = mysqli_fetch_assoc($qPopular)) :

                        ?>

                                        <tr>

                                            <td><?= $no++; ?></td>

                                            <td>

                                                <?= htmlspecialchars($pop['nama_subkategori']); ?>

                                            </td>

                                            <td>

                                                <span class="badge badge-primary">

                                                    <?= number_format($pop['total_click']); ?>

                                                </span>

                                            </td>

                                        </tr>

                                        <?php endwhile; ?>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-12">

                        <div class="card border-0 shadow-sm">

                            <div class="card-header bg-white">

                                <strong>

                                    Statistik Akses Layanan

                                </strong>

                            </div>

                            <div class="card-body">

                                <canvas id="chartPortal" height="90"></canvas>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <footer class="bg-white mt-4 py-3 border-top">

                <div class="container-fluid">

                    <div class="text-center">

                        <small class="text-muted">

                            Copyright &copy;

                            <?= date('Y'); ?>

                            IT Development Portal Sekolah

                        </small>

                    </div>

                </div>

            </footer>

        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    $("#menu-toggle").click(function(e) {

        e.preventDefault();

        $("#wrapper").toggleClass("toggled");

    });

    const ctx = document.getElementById("chartPortal");

    new Chart(ctx, {

        type: 'bar',

        data: {

            labels: <?= json_encode($chartLabel); ?>,

            datasets: [{

                label: 'Jumlah Klik',

                data: <?= json_encode($chartData); ?>

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            legend: {
                display: false
            }

        }

    });
    </script>

</body>

</html>