<?php
session_start();

require_once "../config/config.php";

/*
|--------------------------------------------------------------------------
| Jika sudah login
|--------------------------------------------------------------------------
*/

if (isset($_SESSION['login'])) {
    header("Location: dashboard.php");
    exit;
}

$error = '';

/*
|--------------------------------------------------------------------------
| Proses Login
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username == '' || $password == '') {

        $error = "Username dan Password wajib diisi.";

    } else {

        $username = mysqli_real_escape_string($conn, $username);

        $query = mysqli_query($conn, "
            SELECT *
            FROM users
            WHERE username='$username'
            LIMIT 1
        ");

        if (mysqli_num_rows($query) == 1) {

            $user = mysqli_fetch_assoc($query);

            /*
            |--------------------------------------------------------------------------
            | Password Hash
            |--------------------------------------------------------------------------
            */

            if (password_verify($password, $user['password'])) {

                $_SESSION['login'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['role'] = $user['role'];

                header("Location: dashboard.php");
                exit;

            } else {

                $error = "Password yang Anda masukkan salah.";

            }

        } else {

            $error = "Username tidak ditemukan.";

        }

    }

}
?>

<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Administrator</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
    body {

        background: #F6F8FD;

        font-family: 'Poppins', sans-serif;

    }

    .login-box {

        min-height: 100vh;

        display: flex;

        justify-content: center;

        align-items: center;

    }

    .login-card {

        width: 100%;

        max-width: 420px;

        border: none;

        border-radius: 20px;

        box-shadow: 0 15px 40px rgba(0, 0, 0, .08);

    }

    .logo {

        width: 90px;

        height: 90px;

        border-radius: 50%;

        background: #0d6efd;

        color: #fff;

        display: flex;

        align-items: center;

        justify-content: center;

        margin: auto;

        font-size: 38px;

    }

    .btn-primary {

        border-radius: 30px;

        height: 48px;

    }

    .form-control {

        border-radius: 30px;

        height: 48px;

    }
    </style>

</head>

<body>

    <div class="container">

        <div class="login-box">

            <div class="card login-card">

                <div class="card-body p-5">
                    <div class="text-center mb-4">

                        <div class="logo">

                            <i class="bi bi-mortarboard-fill"></i>

                        </div>

                        <h3 class="mt-3 font-weight-bold">

                            Portal Sekolah

                        </h3>

                        <p class="text-muted">

                            Login Administrator

                        </p>

                    </div>

                    <?php if($error!=""): ?>

                    <div class="alert alert-danger">

                        <?= htmlspecialchars($error); ?>

                    </div>

                    <?php endif; ?>

                    <form method="POST">

                        <div class="form-group">

                            <label>

                                Username

                            </label>

                            <input type="text" name="username" class="form-control" required>

                        </div>

                        <div class="form-group">

                            <label>

                                Password

                            </label>

                            <div class="input-group">

                                <input type="password" id="password" name="password" class="form-control" required>

                                <div class="input-group-append">

                                    <button type="button" class="btn btn-light" id="showPassword">

                                        <i class="bi bi-eye"></i>

                                    </button>

                                </div>

                            </div>

                        </div>

                        <div class="form-group">

                            <button class="btn btn-primary btn-block">

                                Login

                            </button>

                        </div>

                    </form>
                    <hr>

                    <div class="text-center">

                        <small class="text-muted">

                            Copyright &copy;
                            <?= date('Y'); ?>
                            IT Development

                        </small>

                    </div>

                </div>
                <!-- End Card Body -->

            </div>
            <!-- End Card -->

        </div>
        <!-- End Login Box -->

    </div>
    <!-- End Container -->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    $(function() {

        /*
        |--------------------------------------------------------------------------
        | Fokus ke Username
        |--------------------------------------------------------------------------
        */

        $("input[name='username']").trigger("focus");

        /*
        |--------------------------------------------------------------------------
        | Show / Hide Password
        |--------------------------------------------------------------------------
        */

        $("#showPassword").click(function() {

            let password = $("#password");

            let icon = $(this).find("i");

            if (password.attr("type") === "password") {

                password.attr("type", "text");

                icon.removeClass("bi-eye")
                    .addClass("bi-eye-slash");

            } else {

                password.attr("type", "password");

                icon.removeClass("bi-eye-slash")
                    .addClass("bi-eye");

            }

        });

        /*
        |--------------------------------------------------------------------------
        | Loading Button Saat Login
        |--------------------------------------------------------------------------
        */

        $("form").submit(function() {

            let button = $(this).find("button[type='submit']");

            button.prop("disabled", true);

            button.html(
                '<span class="spinner-border spinner-border-sm mr-2"></span>Memproses...'
            );

        });

    });
    </script>

</body>

</html>