<?php

require_once 'config/config.php';

$keyword = '';

if (isset($_GET['keyword'])) {

    $keyword = trim($_GET['keyword']);

}

$keywordDB = mysqli_real_escape_string($conn, $keyword);

/*
|--------------------------------------------------------------------------
| Cari Kategori
|--------------------------------------------------------------------------
*/

$sqlKategori = mysqli_query($conn, "

SELECT *

FROM kategori

WHERE status='Aktif'

AND (

nama_kategori LIKE '%$keywordDB%'

OR deskripsi LIKE '%$keywordDB%'

)

ORDER BY urutan ASC

");

/*
|--------------------------------------------------------------------------
| Cari Subkategori
|--------------------------------------------------------------------------
*/

$sqlSub = mysqli_query($conn, "

SELECT

subkategori.*,

kategori.nama_kategori

FROM subkategori

INNER JOIN kategori

ON kategori.id=subkategori.kategori_id

WHERE subkategori.status='Aktif'

AND (

subkategori.nama_subkategori LIKE '%$keywordDB%'

OR subkategori.deskripsi LIKE '%$keywordDB%'

)

ORDER BY subkategori.urutan ASC

");

?>
<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pencarian</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <nav class="navbar navbar-light bg-white shadow-sm">

        <div class="container">

            <a href="index.php" class="btn btn-light rounded-pill">

                <i class="bi bi-arrow-left"></i>

            </a>

            <span class="font-weight-bold">

                Pencarian

            </span>

            <span style="width:40px"></span>

        </div>

    </nav>

    <section class="py-5">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-8">

                    <form method="GET">

                        <div class="input-group">

                            <input type="text" name="keyword" class="form-control"
                                placeholder="Cari kategori atau layanan..." value="<?= htmlspecialchars($keyword); ?>">

                            <div class="input-group-append">

                                <button class="btn btn-primary" type="submit">

                                    <i class="bi bi-search"></i>

                                    Cari

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

            <div class="mt-5">
                <!-- ================= HASIL KATEGORI ================= -->

                <?php if (!empty($keyword)) : ?>

                <h4 class="mb-4 font-weight-bold">

                    <i class="bi bi-grid text-primary"></i>

                    Hasil Kategori

                </h4>

                <div class="row">

                    <?php if (mysqli_num_rows($sqlKategori) > 0) : ?>

                    <?php while ($kategori = mysqli_fetch_assoc($sqlKategori)) : ?>

                    <div class="col-md-6 mb-4">

                        <div class="card border-0 shadow-sm h-100 kategori-card">

                            <div class="card-body">

                                <div class="d-flex align-items-center">

                                    <div class="kategori-icon mr-3"
                                        style="background: <?= htmlspecialchars($kategori['warna']); ?>;">

                                        <i class="bi <?= htmlspecialchars($kategori['icon']); ?>"></i>

                                    </div>

                                    <div>

                                        <h5 class="mb-1">

                                            <?= htmlspecialchars($kategori['nama_kategori']); ?>

                                        </h5>

                                        <small class="text-muted">

                                            <?= !empty($kategori['deskripsi'])
                                            ? htmlspecialchars($kategori['deskripsi'])
                                            : 'Kategori layanan sekolah'; ?>

                                        </small>

                                    </div>

                                </div>

                                <div class="mt-3">

                                    <a href="kategori.php?id=<?= $kategori['id']; ?>" class="btn btn-primary btn-pill">

                                        Lihat Kategori

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                    <?php endwhile; ?>

                    <?php else : ?>

                    <div class="col-12">

                        <div class="alert alert-light border">

                            Tidak ditemukan kategori yang sesuai.

                        </div>

                    </div>

                    <?php endif; ?>

                </div>

                <hr class="my-5">

                <!-- ================= HASIL SUBKATEGORI ================= -->

                <h4 class="mb-4 font-weight-bold">

                    <i class="bi bi-folder2-open text-success"></i>

                    Hasil Layanan

                </h4>

                <div class="row">

                    <?php if (mysqli_num_rows($sqlSub) > 0) : ?>

                    <?php while ($sub = mysqli_fetch_assoc($sqlSub)) : ?>

                    <div class="col-md-6 mb-4">

                        <div class="card border-0 shadow-sm h-100 subkategori-card">

                            <div class="card-body">

                                <div class="d-flex align-items-center">

                                    <div class="subkategori-icon mr-3">

                                        <i class="bi <?= htmlspecialchars($sub['icon']); ?>"></i>

                                    </div>

                                    <div>

                                        <h5 class="mb-1">

                                            <?= htmlspecialchars($sub['nama_subkategori']); ?>

                                        </h5>

                                        <small class="text-muted">

                                            <?= htmlspecialchars($sub['nama_kategori']); ?>

                                        </small>

                                    </div>

                                </div>

                                <div class="mt-3">

                                    <a href="subkategori.php?id=<?= $sub['id']; ?>" class="btn btn-success btn-pill">

                                        Lihat Detail

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                    <?php endwhile; ?>

                    <?php else : ?>

                    <div class="col-12">

                        <div class="alert alert-light border">

                            Tidak ditemukan layanan yang sesuai.

                        </div>

                    </div>

                    <?php endif; ?>

                </div>

                <?php else : ?>

                <div class="text-center py-5">

                    <i class="bi bi-search display-3 text-muted"></i>

                    <h4 class="mt-3">

                        Cari layanan sekolah

                    </h4>

                    <p class="text-muted">

                        Ketik nama kategori atau layanan pada kotak pencarian di atas.

                    </p>

                </div>

                <?php endif; ?>

            </div>

        </div>

    </section>

    <footer class="bg-white py-4 mt-5">

        <div class="container">

            <div class="text-center">

                <small class="text-muted">

                    Copyright &copy;
                    <?= date('Y'); ?>
                    IT Development

                </small>

            </div>

        </div>

    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/app.js"></script>

</body>

</html>