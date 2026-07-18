<?php

require_once 'config/config.php';

if (!isset($_GET['id'])) {
    header("Location:index.php");
    exit;
}

$id = (int) $_GET['id'];

/*
|--------------------------------------------------------------------------
| Ambil Data Subkategori + Kategori
|--------------------------------------------------------------------------
*/

$sql = mysqli_query($conn, "
SELECT
    subkategori.*,
    kategori.nama_kategori,
    kategori.warna
FROM subkategori
INNER JOIN kategori
ON kategori.id=subkategori.kategori_id
WHERE subkategori.id='$id'
AND subkategori.status='Aktif'
");

if(mysqli_num_rows($sql)==0){
    header("Location:index.php");
    exit;
}

$data = mysqli_fetch_assoc($sql);

?>
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($data['nama_subkategori']); ?></title>

    <link rel="icon" type="image/x-icon" href="assets/img/logo-sma.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <nav class="navbar navbar-light bg-white shadow-sm">

        <div class="container">

            <a href="kategori.php?id=<?= $data['kategori_id']; ?>" class="btn btn-light rounded-pill">

                <i class="bi bi-arrow-left"></i>

            </a>

            <span class="font-weight-bold">

                <?= htmlspecialchars($data['nama_subkategori']); ?>

            </span>

            <span style="width:40px"></span>

        </div>

    </nav>

    <section class="py-5">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-7">

                    <div class="card border-0 shadow-sm">

                        <div class="card-body p-5 text-center">

                            <div class="mb-4">

                                <div class="kategori-icon-large mx-auto"
                                    style="background:<?= htmlspecialchars($data['warna']); ?>">

                                    <i class="bi <?= htmlspecialchars($data['icon']); ?>"></i>

                                </div>

                            </div>

                            <h2 class="font-weight-bold">

                                <?= htmlspecialchars($data['nama_subkategori']); ?>

                            </h2>

                            <h6 class="text-primary">

                                <?= htmlspecialchars($data['nama_kategori']); ?>

                            </h6>

                            <hr>
                            <div class="mb-4">

                                <?php if (!empty($data['deskripsi'])) : ?>

                                <p class="text-muted">

                                    <?= nl2br(htmlspecialchars($data['deskripsi'])); ?>

                                </p>

                                <?php else : ?>

                                <p class="text-muted">

                                    Aplikasi ini merupakan bagian dari layanan
                                    <strong><?= htmlspecialchars($data['nama_kategori']); ?></strong>.
                                    Silakan klik tombol di bawah untuk membuka aplikasi.

                                </p>

                                <?php endif; ?>

                            </div>

                            <div class="row text-left mb-4">

                                <div class="col-md-6 mb-3">

                                    <strong>Kategori</strong>

                                    <br>

                                    <span class="text-muted">

                                        <?= htmlspecialchars($data['nama_kategori']); ?>

                                    </span>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <strong>Status</strong>

                                    <br>

                                    <span class="badge badge-success">

                                        Aktif

                                    </span>

                                </div>

                            </div>

                            <div class="text-center">

                                <a href="redirect.php?id=<?= $data['id']; ?>" class="btn btn-primary btn-pill px-5">

                                    <i class="bi bi-box-arrow-up-right"></i>

                                    Buka Aplikasi

                                </a>

                            </div>

                            <div class="text-center mt-3">

                                <a href="kategori.php?id=<?= $data['kategori_id']; ?>"
                                    class="btn btn-outline-secondary btn-pill">

                                    <i class="bi bi-arrow-left"></i>

                                    Kembali

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

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