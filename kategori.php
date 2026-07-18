<?php

require_once 'config/config.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

/*
|--------------------------------------------------------------------------
| Ambil Data Kategori
|--------------------------------------------------------------------------
*/

$sqlKategori = mysqli_query($conn, "
SELECT *
FROM kategori
WHERE id='$id'
AND status='Aktif'
");

if (mysqli_num_rows($sqlKategori) == 0) {
    header("Location: index.php");
    exit;
}

$kategori = mysqli_fetch_assoc($sqlKategori);

/*
|--------------------------------------------------------------------------
| Ambil Semua Subkategori
|--------------------------------------------------------------------------
*/

$sqlSub = mysqli_query($conn, "
SELECT *
FROM subkategori
WHERE kategori_id='$id'
AND status='Aktif'
ORDER BY urutan ASC
");

?>
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($kategori['nama_kategori']); ?></title>

    <link rel="icon" type="image/x-icon" href="assets/img/logo-sma.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <!-- ================= NAVBAR ================= -->

    <nav class="navbar navbar-light bg-white shadow-sm">

        <div class="container">

            <a href="index.php" class="btn btn-light rounded-pill">

                <i class="bi bi-arrow-left"></i>

            </a>

            <span class="navbar-brand mb-0 font-weight-bold">

                <?= htmlspecialchars($kategori['nama_kategori']); ?>

            </span>

            <span style="width:40px"></span>

        </div>

    </nav>

    <!-- ================= HEADER ================= -->

    <section class="py-5">

        <div class="container text-center">

            <div class="kategori-header">

                <div class="kategori-icon-large" style="background:<?= $kategori['warna']; ?>">

                    <i class="bi <?= $kategori['icon']; ?>"></i>

                </div>

                <h2 class="mt-4 font-weight-bold">

                    <?= htmlspecialchars($kategori['nama_kategori']); ?>

                </h2>

                <p class="text-muted">

                    Pilih salah satu layanan di bawah ini.

                </p>

            </div>

        </div>

    </section>

    <section class="pb-5">

        <div class="container">

            <div class="row">
                <?php if (mysqli_num_rows($sqlSub) > 0) : ?>

                <?php while ($sub = mysqli_fetch_assoc($sqlSub)) : ?>

                <div class="col-12 col-md-6 col-lg-4 mb-4">

                    <div class="card border-0 shadow-sm h-100 subkategori-card">

                        <div class="card-body">

                            <div class="d-flex align-items-center mb-3">

                                <div class="subkategori-icon mr-3">

                                    <i class="bi <?= htmlspecialchars($sub['icon']); ?>"></i>

                                </div>

                                <div>

                                    <h5 class="mb-1 font-weight-bold">

                                        <?= htmlspecialchars($sub['nama_subkategori']); ?>

                                    </h5>

                                    <small class="text-muted">

                                        <?= htmlspecialchars($kategori['nama_kategori']); ?>

                                    </small>

                                </div>

                            </div>

                            <p class="text-muted">

                                <?= !empty($sub['deskripsi'])
                            ? htmlspecialchars($sub['deskripsi'])
                            : 'Klik tombol di bawah untuk membuka aplikasi.'; ?>

                            </p>

                            <a href="<?= htmlspecialchars($sub['url']); ?>"
                                class="btn btn-primary rounded-pill btn-pill btn-block" target="_blank">

                                <i class="bi bi-box-arrow-up-right"></i>

                                Buka Aplikasi

                            </a>

                        </div>

                    </div>

                </div>

                <?php endwhile; ?>

                <?php else : ?>

                <div class="col-12">

                    <div class="alert alert-warning text-center p-4">

                        <i class="bi bi-exclamation-circle display-4 d-block mb-3"></i>

                        <h5>Belum Ada Layanan</h5>

                        <p class="mb-0">

                            Sub kategori pada menu
                            <strong><?= htmlspecialchars($kategori['nama_kategori']); ?></strong>
                            belum tersedia.

                        </p>

                    </div>

                </div>

                <?php endif; ?>

            </div>

        </div>

    </section>

    <footer class="footer py-4 bg-white">

        <div class="container-fluid px-4 text-center">
            <h6 class="mb-0"><b>Copyright &copy; <script>
                    document.write(new Date().getFullYear())
                    </script> <a href="https://robbyilham.com/" target="_blank">by</a> IT Development IHBS</b></h6>
        </div>

    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/app.js"></script>

</body>

</html>