<?php

$pageTitle = "Kategori";

require_once "../config/config.php";

include "includes/header.php";

include "includes/sidebar.php";

include "includes/navbar.php";


/*
|--------------------------------------------------------------------------
| Proses Tambah Kategori
|--------------------------------------------------------------------------
*/

if (isset($_POST['simpan'])) {

    $nama       = trim($_POST['nama_kategori']);
    $icon       = trim($_POST['icon']);
    $warna      = trim($_POST['warna']);
    $urutan     = (int) $_POST['urutan'];
    $status     = trim($_POST['status']);
    $deskripsi  = trim($_POST['deskripsi']);

    if ($nama == '') {

        echo "<script>
            Swal.fire({
                icon:'error',
                title:'Gagal',
                text:'Nama kategori wajib diisi.'
            });
        </script>";

    } else {

        $cek = mysqli_query($conn, "
            SELECT id
            FROM kategori
            WHERE nama_kategori='" . mysqli_real_escape_string($conn, $nama) . "'
            LIMIT 1
        ");

        if (mysqli_num_rows($cek) > 0) {

            echo "<script>
                Swal.fire({
                    icon:'warning',
                    title:'Kategori sudah ada'
                });
            </script>";

        } else {

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
                VALUES (?,?,?,?,?,?,NOW())"
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

                echo "<script>
                    window.location='kategori.php?success=1';
                </script>";
                exit;

            } else {

                echo "<script>
                    Swal.fire({
                        icon:'error',
                        title:'Database Error',
                        text:'".addslashes(mysqli_error($conn))."'
                    });
                </script>";

            }

            mysqli_stmt_close($stmt);

        }

    }

}


/*
|--------------------------------------------------------------------------
| Ambil Data Kategori
|--------------------------------------------------------------------------
*/

$query = mysqli_query($conn, "

SELECT *

FROM kategori

ORDER BY urutan ASC,nama_kategori ASC

");

?>

<div class="row">

    <div class="col-lg-12">

        <div class="card">

            <div class="card-header bg-white">

                <div class="row align-items-center">

                    <div class="col-md-6">

                        <h4 class="mb-0">

                            Data Kategori

                        </h4>

                    </div>

                    <div class="col-md-6 text-md-right mt-3 mt-md-0">

                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">

                            <i class="bi bi-plus-circle"></i>

                            Tambah Kategori

                        </button>

                    </div>

                </div>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover" id="tableKategori">

                        <thead class="thead-light">

                            <tr>

                                <th width="60">

                                    No

                                </th>

                                <th>

                                    Icon

                                </th>

                                <th>

                                    Nama

                                </th>

                                <th>

                                    Warna

                                </th>

                                <th>

                                    Status

                                </th>

                                <th width="160">

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

                                <td>

                                    <?= $no++; ?>

                                </td>

                                <td>

                                    <span
                                        class="d-inline-flex align-items-center justify-content-center rounded-circle text-white"
                                        style="width:45px;height:45px;background:<?= htmlspecialchars($row['warna']); ?>;">

                                        <i class="bi <?= htmlspecialchars($row['icon']); ?>"></i>

                                    </span>

                                </td>

                                <td>

                                    <strong>

                                        <?= htmlspecialchars($row['nama_kategori']); ?>

                                    </strong>

                                </td>

                                <td>

                                    <span class="badge badge-light">

                                        <?= htmlspecialchars($row['warna']); ?>

                                    </span>

                                </td>

                                <td>

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

                                <td>

                                    <button class="btn btn-warning btn-sm">

                                        <i class="bi bi-pencil"></i>

                                    </button>

                                    <a href="kategori_hapus.php?id=<?= $row['id']; ?>"
                                        class="btn btn-danger btn-sm btn-delete">

                                        <i class="bi bi-trash"></i>

                                    </a>

                                </td>

                            </tr>

                            <?php endwhile; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- =====================================================
     MODAL TAMBAH KATEGORI
====================================================== -->

<div class="modal fade" id="modalTambah" tabindex="-1">

    <div class="modal-dialog modal-lg">

        <form method="POST">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">

                        Tambah Kategori

                    </h5>

                    <button class="close" data-dismiss="modal">

                        &times;

                    </button>

                </div>

                <div class="modal-body">

                    <div class="form-group">

                        <label>Nama Kategori</label>

                        <input type="text" name="nama_kategori" class="form-control" required>

                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">

                            <label>Bootstrap Icon</label>

                            <input type="text" name="icon" class="form-control" placeholder="bi-grid">

                        </div>

                        <div class="form-group col-md-6">

                            <label>Warna</label>

                            <input type="color" name="warna" class="form-control" value="#0d6efd">

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">

                            <label>Urutan</label>

                            <input type="number" name="urutan" class="form-control" value="1">

                        </div>

                        <div class="form-group col-md-6">

                            <label>Status</label>

                            <select name="status" class="form-control">

                                <option value="Aktif">

                                    Aktif

                                </option>

                                <option value="Nonaktif">

                                    Nonaktif

                                </option>

                            </select>

                        </div>

                    </div>

                    <div class="form-group">

                        <label>Deskripsi</label>

                        <textarea name="deskripsi" rows="4" class="form-control"></textarea>

                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-secondary" data-dismiss="modal" type="button">

                        Batal

                    </button>

                    <button class="btn btn-primary" type="submit" name="simpan">

                        <i class="bi bi-save"></i>

                        Simpan

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<? include "includes/footer.php"; ?>