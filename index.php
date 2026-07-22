<?php
require_once 'config/config.php';

// Ambil semua kategori aktif
$query = mysqli_query($conn, "SELECT * FROM kategori
ORDER BY urutan ASC");

?>
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Portal SMA IHBS</title>

    <link rel="icon" type="image/x-icon" href="assets/img/logo-sma.png">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

    <!-- ================= NAVBAR ================= -->

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">

        <div class="container">

            <a class="navbar-brand font-weight-bold" href="index.php">

                <!-- <i class="bi bi-mortarboard-fill text-primary"></i> -->
                <img src="assets/img/logo-sma.png" width="30" data-aos="zoom-in">

                Portal SMA IHBS

            </a>

        </div>

    </nav>

    <!-- ================= HERO ================= -->

    <section class="py-5">

        <div class="container">

            <div class="text-center">

                <h2 class="font-weight-bold">

                    Portal Digital Sekolah

                </h2>

                <p class="text-muted">

                    Seluruh layanan sekolah dalam satu wadah.

                </p>

            </div>

            <div class="row justify-content-center mt-4">

                <div class="col-md-6">

                    <input type="text" class="form-control" id="searchKategori" placeholder="Cari kategori...">

                </div>

            </div>

        </div>

    </section>

    <!-- ================= LIST KATEGORI ================= -->

    <section class="pb-5">

        <div class="container">

            <div class="row">

                <?php if(mysqli_num_rows($query) > 0) : ?>

                <?php while($row = mysqli_fetch_assoc($query)) : ?>

                <div class="col-12 col-md-6 col-lg-4 mb-4 kategori-item">

                    <div class="card border-0 shadow-sm h-100 kategori-card">

                        <div class="card-body text-center">

                            <div class="kategori-icon mb-3" style="background: <?= $row['warna']; ?>;">

                                <i class="bi <?= $row['icon']; ?>"></i>

                            </div>

                            <h5 class="font-weight-bold">

                                <?= htmlspecialchars($row['nama_kategori']); ?>

                            </h5>

                            <p class="text-muted small">

                                <?= !empty($row['deskripsi']) ? htmlspecialchars($row['deskripsi']) : 'Klik untuk melihat seluruh layanan pada kategori ini.'; ?>

                            </p>

                            <a href="kategori.php?id=<?= $row['id']; ?>" class="btn btn-primary rounded-pill btn-pill">

                                <i class="bi bi-arrow-right-circle"></i>

                                Lihat Layanan

                            </a>

                        </div>

                    </div>

                </div>

                <?php endwhile; ?>

                <?php else : ?>

                <div class="col-12">

                    <div class="alert alert-warning text-center">

                        Belum ada kategori yang tersedia.

                    </div>

                </div>

                <?php endif; ?>

            </div>

        </div>

    </section>

    <!-- ================= FOOTER ================= -->

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

    <script>
    $("#searchKategori").on("keyup", function() {

        let value = $(this).val().toLowerCase();

        $(".kategori-item").filter(function() {

            $(this).toggle(

                $(this).text().toLowerCase().indexOf(value) > -1

            );

        });

    });
    </script>

</body>

</html>