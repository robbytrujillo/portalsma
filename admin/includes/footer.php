    </div>
    <!-- End Container Fluid -->

    <footer class="bg-white border-top mt-5 py-3">

        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-md-6 text-center text-md-left">

                    <small class="text-muted">

                        Copyright &copy;

                        <?= date('Y'); ?>

                        IT Development

                    </small>

                </div>

                <div class="col-md-6 text-center text-md-right">

                    <small class="text-muted">

                        Portal Sekolah v1.0

                    </small>

                </div>

            </div>

        </div>

    </footer>

    </div>
    <!-- End Content -->

    </div>
    <!-- End Wrapper -->

    <!-- JQuery -->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Chart JS -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- SweetAlert -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom JS -->

    <script src="../assets/js/app.js"></script>

    <!-- DataTables -->

    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>

    <script>
$(function() {

    /*
    |--------------------------------------------------------------------------
    | Buka Sidebar
    |--------------------------------------------------------------------------
    */

    $("#menu-toggle").click(function() {

        $("#sidebar").addClass("show");

        $("#sidebar-overlay").fadeIn(200);

    });

    /*
    |--------------------------------------------------------------------------
    | Tutup Sidebar
    |--------------------------------------------------------------------------
    */

    $("#sidebar-overlay").click(function() {

        $("#sidebar").removeClass("show");

        $(this).fadeOut(200);

    });

});
    </script>

    <script>
$(document).ready(function() {

    /*
    |--------------------------------------------------------------------------
    | PRELOADER
    |--------------------------------------------------------------------------
    */

    $("#preloader").fadeOut(400);

    /*
    |--------------------------------------------------------------------------
    | AUTO CLOSE ALERT
    |--------------------------------------------------------------------------
    */

    setTimeout(function() {

        $(".alert").fadeOut();

    }, 3000);

});

/*
|--------------------------------------------------------------------------
| TOGGLE SIDEBAR
|--------------------------------------------------------------------------
*/

$("#menu-toggle").click(function() {

    $("#sidebar").addClass("show");

    $("#sidebar-overlay").fadeIn(200);

});

$("#close-sidebar").click(function() {

    $("#sidebar").removeClass("show");

    $("#sidebar-overlay").fadeOut(200);

});

$("#sidebar-overlay").click(function() {

    $("#sidebar").removeClass("show");

    $(this).fadeOut(200);

});

/*
|--------------------------------------------------------------------------
| DESKTOP
|--------------------------------------------------------------------------
*/

$(window).resize(function() {

    if ($(window).width() > 991) {

        $("#sidebar").removeClass("show");

        $("#sidebar-overlay").hide();

    }

});

/*
|--------------------------------------------------------------------------
| DELETE CONFIRMATION
|--------------------------------------------------------------------------
*/

$(".btn-delete").click(function(e) {

    e.preventDefault();

    let url = $(this).attr("href");

    Swal.fire({

        title: 'Hapus data?',

        text: 'Data yang dihapus tidak dapat dikembalikan.',

        icon: 'warning',

        showCancelButton: true,

        confirmButtonColor: '#0d6efd',

        cancelButtonColor: '#dc3545',

        confirmButtonText: 'Ya, Hapus'

    }).then((result) => {

        if (result.isConfirmed) {

            window.location = url;

        }

    });

});

/*
|--------------------------------------------------------------------------
| Konfirmasi Logout
|--------------------------------------------------------------------------
*/

$(".btn-logout").click(function(e) {

    e.preventDefault();

    let url = $(this).attr("href");

    Swal.fire({

        title: "Logout",

        text: "Apakah Anda yakin ingin keluar dari sistem?",

        icon: "question",

        showCancelButton: true,

        confirmButtonColor: "#0d6efd",

        cancelButtonColor: "#6c757d",

        confirmButtonText: "Ya, Logout",

        cancelButtonText: "Batal"

    }).then((result) => {

        if (result.isConfirmed) {

            window.location = url;

        }

    });

});

$(".btn-edit").click(function() {

    $("#edit_id").val($(this).data("id"));

    $("#edit_nama").val($(this).data("nama"));

    $("#edit_icon").val($(this).data("icon"));

    $("#edit_warna").val($(this).data("warna"));

    $("#edit_urutan").val($(this).data("urutan"));

    $("#edit_status").val($(this).data("status"));

    $("#edit_deskripsi").val($(this).data("deskripsi"));

});
    </script>

    <script>
$(function() {

    /*
    |--------------------------------------------------------------------------
    | Preview Bootstrap Icon
    |--------------------------------------------------------------------------
    */

    $("#iconTambah").on("keyup change", function() {

        let icon = $(this).val();

        if (icon == "") {

            icon = "bi-grid-fill";

        }

        $("#previewIconTambah").html(

            '<i class="bi ' + icon + '"></i>'

        );

    });

    /*
    |--------------------------------------------------------------------------
    | Preview Warna
    |--------------------------------------------------------------------------
    */

    $("#warnaTambah").change(function() {

        $("#previewWarnaTambah").css(

            "background",

            $(this).val()

        );

    });

    /*
    |--------------------------------------------------------------------------
    | Loading Button
    |--------------------------------------------------------------------------
    */

    $("#formTambahKategori").submit(function() {

        $("#btnSimpanKategori")

            .prop("disabled", true)

            .html('<span class="spinner-border spinner-border-sm mr-2"></span>Menyimpan...');

    });

});
    </script>

    <script>
$(function() {

    /*
    |--------------------------------------------------------------------------
    | Mengisi Modal Edit
    |--------------------------------------------------------------------------
    */

    $(".btn-edit").click(function() {

        $("#edit_id").val($(this).data("id"));

        $("#edit_nama").val($(this).data("nama"));

        $("#edit_icon").val($(this).data("icon"));

        $("#edit_warna").val($(this).data("warna"));

        $("#edit_urutan").val($(this).data("urutan"));

        $("#edit_status").val($(this).data("status"));

        $("#edit_deskripsi").val($(this).data("deskripsi"));

        $("#previewIconEdit").html(

            '<i class="bi ' + $(this).data("icon") + '"></i>'

        );

        $("#previewWarnaEdit").css(

            "background",

            $(this).data("warna")

        );

    });

    /*
    |--------------------------------------------------------------------------
    | Preview Icon
    |--------------------------------------------------------------------------
    */

    $("#edit_icon").keyup(function() {

        let icon = $(this).val();

        if (icon == "") {

            icon = "bi-grid-fill";

        }

        $("#previewIconEdit").html(

            '<i class="bi ' + icon + '"></i>'

        );

    });

    /*
    |--------------------------------------------------------------------------
    | Preview Warna
    |--------------------------------------------------------------------------
    */

    $("#edit_warna").change(function() {

        $("#previewWarnaEdit").css(

            "background",

            $(this).val()

        );

    });

    /*
    |--------------------------------------------------------------------------
    | Loading Button
    |--------------------------------------------------------------------------
    */

    $("#formEditKategori").submit(function() {

        $("#btnUpdateKategori")

            .prop("disabled", true)

            .html(

                '<span class="spinner-border spinner-border-sm mr-2"></span>Mengupdate...'

            );

    });

});
    </script>

    <script>
$(function() {

    $("#tableKategori").DataTable({

        responsive: true,

        autoWidth: false,

        pageLength: 10,

        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],

        order: [
            [3, "asc"]
        ],

        language: {

            search: "Cari :",

            lengthMenu: "Tampilkan _MENU_ data",

            zeroRecords: "Data tidak ditemukan",

            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",

            infoEmpty: "Tidak ada data",

            paginate: {

                first: "Awal",

                last: "Akhir",

                next: "›",

                previous: "‹"

            }

        }

    });

});
    </script>

    <script>
$(function() {

    $('[data-toggle="tooltip"]').tooltip();

});
    </script>

    </body>

    </html>