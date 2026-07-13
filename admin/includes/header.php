<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config/config.php';

// Cek login
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

// Ambil data admin (opsional)
$admin = null;
if (isset($_SESSION['user_id'])) {

    $id = (int) $_SESSION['user_id'];

    $queryAdmin = mysqli_query($conn, "
        SELECT *
        FROM users
        WHERE id='$id'
        LIMIT 1
    ");

    if ($queryAdmin && mysqli_num_rows($queryAdmin) > 0) {
        $admin = mysqli_fetch_assoc($queryAdmin);
    }
}

// Judul halaman
$pageTitle = $pageTitle ?? 'Portal Sekolah';
?>
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="Portal Sekolah">

    <meta name="author" content="IT Development">

    <title><?= htmlspecialchars($pageTitle); ?></title>
    <!-- Bootstrap 4 -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Bootstrap Icons -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Google Font -->

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Custom CSS -->

    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
    body {

        font-family: 'Poppins', sans-serif;

        background: #F6F8FD;

        overflow-x: hidden;

    }

    a {

        text-decoration: none;

    }

    .wrapper {

        display: flex;

        min-height: 100vh;

    }

    #content {

        width: 100%;

        min-height: 100vh;

        transition: .3s;

    }

    .card {

        border: none;

        border-radius: 20px;

        box-shadow: 0 10px 25px rgba(0, 0, 0, .05);

    }

    .btn {

        border-radius: 30px;

    }

    /* ===========================
   PRELOADER
=========================== */

    #preloader {

        position: fixed;

        top: 0;

        left: 0;

        width: 100%;

        height: 100%;

        background: #F6F8FD;

        display: flex;

        align-items: center;

        justify-content: center;

        z-index: 99999;

    }

    /* ===========================
   PAGE
=========================== */

    #content {

        min-height: 100vh;

    }

    /* ===========================
   CARD
=========================== */

    .card {

        transition: .3s;

    }

    .card:hover {

        transform: translateY(-4px);

    }

    /* ===========================
   TABLE
=========================== */

    .table thead th {

        border-top: none;

    }

    /* ===========================
   BADGE
=========================== */

    .badge {

        padding: 7px 12px;

        border-radius: 20px;

    }
    </style>

</head>

<body>

    <div class="wrapper">
        <!-- =============================
     PRELOADER
============================== -->

        <div id="preloader">

            <div class="spinner-border text-primary" role="status">

                <span class="sr-only">
                    Loading...
                </span>

            </div>

        </div>

        <!-- =============================
     ALERT AREA
============================== -->

        <div id="alert-area" class="container-fluid mt-3">

        </div>

        <!-- =============================
     MAIN CONTENT
============================== -->

        <div id="content" class="w-100">