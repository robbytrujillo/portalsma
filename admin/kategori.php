<?php

$pageTitle = "Kategori";

require_once "../config/config.php";

include "includes/header.php";

include "includes/sidebar.php";

include "includes/navbar.php";

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