<?php

$pageTitle = "Kategori";

require_once "../config/config.php";

/*
|--------------------------------------------------------------------------
| Cek Login
|--------------------------------------------------------------------------
*/

if (!isset($_SESSION['id'])) {

    header("Location: login.php");
    exit;

}

/*
|--------------------------------------------------------------------------
| Include Template
|--------------------------------------------------------------------------
*/

include "includes/header.php";
include "includes/sidebar.php";
include "includes/navbar.php";

/*
|--------------------------------------------------------------------------
| CSRF Token
|--------------------------------------------------------------------------
*/

if (empty($_SESSION['csrf'])) {

    $_SESSION['csrf'] = bin2hex(random_bytes(32));

}

/*
|--------------------------------------------------------------------------
| Flash Notification
|--------------------------------------------------------------------------
*/

$flash = null;

if (isset($_GET['success'])) {

    $flash = [
        'icon'  => 'success',
        'title' => 'Berhasil',
        'text'  => 'Kategori berhasil ditambahkan.'
    ];

}

if (isset($_GET['update'])) {

    $flash = [
        'icon'  => 'success',
        'title' => 'Berhasil',
        'text'  => 'Kategori berhasil diperbarui.'
    ];

}

if (isset($_GET['delete'])) {

    $flash = [
        'icon'  => 'success',
        'title' => 'Berhasil',
        'text'  => 'Kategori berhasil dihapus.'
    ];

}

if (isset($_GET['error'])) {

    $flash = [
        'icon'  => 'error',
        'title' => 'Gagal',
        'text'  => 'Terjadi kesalahan.'
    ];

}

/*
|--------------------------------------------------------------------------
| Proses Tambah
|--------------------------------------------------------------------------
*/

if (isset($_POST['simpan'])) {

    if (
        !isset($_POST['csrf']) ||
        $_POST['csrf'] !== $_SESSION['csrf']
    ) {

        exit("Invalid CSRF Token");

    }

    $nama       = trim($_POST['nama_kategori']);
    $icon       = trim($_POST['icon']);
    $warna      = trim($_POST['warna']);
    $urutan     = (int) $_POST['urutan'];
    $status     = trim($_POST['status']);
    $deskripsi  = trim($_POST['deskripsi']);

    if ($nama == "") {

        $flash = [
            'icon'  => 'warning',
            'title' => 'Peringatan',
            'text'  => 'Nama kategori wajib diisi.'
        ];

    } else {

        $stmt = mysqli_prepare(
            $conn,
            "SELECT id
             FROM kategori
             WHERE nama_kategori=?
             LIMIT 1"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "s",
            $nama
        );

        mysqli_stmt_execute($stmt);

        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {

            mysqli_stmt_close($stmt);

            $flash = [
                'icon'  => 'warning',
                'title' => 'Peringatan',
                'text'  => 'Nama kategori sudah digunakan.'
            ];

        } else {

            mysqli_stmt_close($stmt);

            $stmt = mysqli_prepare(
                $conn,
                "INSERT INTO kategori
                (
                    nama_kategori,
                    icon,
                    warna,
                    deskripsi,
                    urutan,
                    status,
                    created_at
                )
                VALUES
                (
                    ?,?,?,?,?,?,NOW()
                )"
            );

            mysqli_stmt_bind_param(
                $stmt,
                "ssssis",
                $nama,
                $icon,
                $warna,
                $deskripsi,
                $urutan,
                $status
            );

            if (mysqli_stmt_execute($stmt)) {

                mysqli_stmt_close($stmt);

                header("Location:kategori.php?success=1");
                exit;

            }

            mysqli_stmt_close($stmt);

            $flash = [
                'icon'  => 'error',
                'title' => 'Database Error',
                'text'  => mysqli_error($conn)
            ];

        }

    }

}

/*
|--------------------------------------------------------------------------
| Proses Update
|--------------------------------------------------------------------------
*/

if (isset($_POST['update'])) {

    if (
        !isset($_POST['csrf']) ||
        $_POST['csrf'] !== $_SESSION['csrf']
    ) {

        exit("Invalid CSRF Token");

    }

    $id         = (int) $_POST['id'];
    $nama       = trim($_POST['nama_kategori']);
    $icon       = trim($_POST['icon']);
    $warna      = trim($_POST['warna']);
    $urutan     = (int) $_POST['urutan'];
    $status     = trim($_POST['status']);
    $deskripsi  = trim($_POST['deskripsi']);

    $stmt = mysqli_prepare(
        $conn,
        "UPDATE kategori
        SET
            nama_kategori=?,
            icon=?,
            warna=?,
            urutan=?,
            status=?,
            deskripsi=?
        WHERE id=?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "sssissi",
        $nama,
        $icon,
        $warna,
        $urutan,
        $status,
        $deskripsi,
        $id
    );

    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);

        header("Location:kategori.php?update=1");
        exit;

    }

    mysqli_stmt_close($stmt);

    $flash = [
        'icon'  => 'error',
        'title' => 'Database Error',
        'text'  => mysqli_error($conn)
    ];

}

/*
|--------------------------------------------------------------------------
| Ambil Data
|--------------------------------------------------------------------------
*/

$query = mysqli_query(
    $conn,
    "SELECT *
     FROM kategori
     ORDER BY urutan ASC, nama_kategori ASC"
);

if (!$query) {

    die("Query Error : " . mysqli_error($conn));

}

$totalKategori = mysqli_num_rows($query);
?>

<div class="container-fluid">

    <div class="row mb-4">

        <div class="col-12">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div>

                    <h3 class="font-weight-bold mb-1">

                        <i class="bi bi-grid text-primary mr-2"></i>

                        Manajemen Kategori

                    </h3>

                    <small class="text-muted">

                        Kelola kategori Portal Sekolah

                    </small>

                </div>

                <button class="btn btn-primary mt-3 mt-md-0" data-toggle="modal" data-target="#modalTambah"
                    style="border-radius:30px;">

                    <i class="bi bi-plus-circle mr-1"></i>

                    Tambah Kategori

                </button>

            </div>

        </div>

    </div>

    <!-- Statistik -->

    <div class="row mb-4">

        <div class="col-md-4 mb-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex align-items-center">

                        <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center"
                            style="width:60px;height:60px;">

                            <i class="bi bi-grid-fill h4 mb-0"></i>

                        </div>

                        <div class="ml-3">

                            <small class="text-muted">

                                Total Kategori

                            </small>

                            <h3 class="font-weight-bold mb-0">

                                <?= $totalKategori; ?>

                            </h3>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Card -->

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white border-0">

            <div class="row align-items-center">

                <div class="col-md-6">

                    <h5 class="mb-0">

                        Daftar Kategori

                    </h5>

                </div>

                <div class="col-md-6 text-md-right">

                    <small class="text-muted">

                        Total :

                        <strong>

                            <?= $totalKategori; ?>

                        </strong>

                        Data

                    </small>

                </div>

            </div>

        </div>

        <div class="card-body">

            <?php if($totalKategori>0): ?>

            <div class="table-responsive">

                <table class="table table-hover table-bordered align-middle" id="tableKategori" width="100%">

                    <thead class="thead-light">

                        <tr>

                            <th width="60">

                                No

                            </th>

                            <th width="90">

                                Icon

                            </th>

                            <th>

                                Nama

                            </th>

                            <th width="90">

                                Urutan

                            </th>

                            <th width="120">

                                Status

                            </th>

                            <th width="180">

                                Aksi

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php

                    $no=1;

                    while($row=mysqli_fetch_assoc($query)):

                    ?>

                        <tr>

                            <td class="text-center">

                                <?= $no++; ?>

                            </td>

                            <td class="text-center">

                                <div style="

                                width:50px;

                                height:50px;

                                background:<?= htmlspecialchars($row['warna']); ?>;

                                border-radius:50%;

                                display:flex;

                                align-items:center;

                                justify-content:center;

                                color:#fff;

                                margin:auto;

                                ">

                                    <i class="bi <?= htmlspecialchars($row['icon']); ?>">

                                    </i>

                                </div>

                            </td>

                            <td>

                                <strong>

                                    <?= htmlspecialchars($row['nama_kategori']); ?>

                                </strong>

                                <?php if(!empty($row['deskripsi'])): ?>

                                <br>

                                <small class="text-muted">

                                    <?= htmlspecialchars($row['deskripsi']); ?>

                                </small>

                                <?php endif; ?>

                            </td>

                            <td class="text-center">

                                <span class="badge badge-info">

                                    <?= $row['urutan']; ?>

                                </span>

                            </td>

                            <td class="text-center">

                                <?php if($row['status']=="Aktif"): ?>

                                <span class="badge badge-success">

                                    Aktif

                                </span>

                                <?php else: ?>

                                <span class="badge badge-danger">

                                    Nonaktif

                                </span>

                                <?php endif; ?>

                            </td>

                            <td class="text-center">

                                <button class="btn btn-warning btn-sm btn-edit" data-id="<?= $row['id']; ?>"
                                    data-nama="<?= htmlspecialchars($row['nama_kategori']); ?>"
                                    data-icon="<?= htmlspecialchars($row['icon']); ?>"
                                    data-warna="<?= htmlspecialchars($row['warna']); ?>"
                                    data-urutan="<?= $row['urutan']; ?>" data-status="<?= $row['status']; ?>"
                                    data-deskripsi="<?= htmlspecialchars($row['deskripsi']); ?>" data-toggle="modal"
                                    data-target="#modalEdit" title="Edit">

                                    <i class="bi bi-pencil-square"></i>

                                </button>

                                <a href="kategori_hapus.php?id=<?= $row['id']; ?>"
                                    class="btn btn-danger btn-sm btn-delete" title="Hapus">

                                    <i class="bi bi-trash"></i>

                                </a>

                            </td>

                        </tr>

                        <?php endwhile; ?>

                    </tbody>

                </table>

            </div>

            <?php else: ?>

            <div class="text-center py-5">

                <i class="bi bi-folder2-open display-3 text-secondary">

                </i>

                <h4 class="mt-3">

                    Belum Ada Data Kategori

                </h4>

                <p class="text-muted">

                    Klik tombol Tambah Kategori untuk membuat kategori pertama.

                </p>

                <button class="btn btn-primary" style="border-radius:30px;" data-toggle="modal"
                    data-target="#modalTambah">

                    <i class="bi bi-plus-circle mr-2"></i>

                    Tambah Kategori

                </button>

            </div>

            <?php endif; ?>

        </div>

    </div>

</div>