<?php
session_start();
error_reporting(0);
include 'data/function.php';
if ( isset($_SESSION['ADMIN']) ) {
    header("location: javascript://history.go(-1)");
    exit;
}

$email = $_POST['email'];
$password = $_POST['password'];

// if (isset($_POST['submit'])) {
//     if ( $result = mysqli_query($conn,"SELECT * FROM user WHERE email = '$email'") ) {
//         if (mysqli_num_rows($result) === 1) {
//             $row = mysqli_fetch_assoc($result);
//             $queryPassword = $row['password'];
//             if ($password == $queryPassword) {
//                 $_SESSION["USER"] = true;
//                 $_SESSION["USERNAME"] = $row["nama_user"];
//                 $_SESSION["ID"] = $row["ID"];

//                 if( isset($_POST['remember']) ) {
//                     setcookie('qnw22yuUDphYb32ttuBono86OIBtTPMu3', $row['ID'], time() + 86400 * 7);
//                     setcookie('qn4543w22U76NHH87uehjrpoJjoiuihUG97',hash('sha256', $row['nama_user']), time() + 86400 * 7);
//                 }
                
//                 header("Location: index.php"); 
//                 exit;
//             } else {
//                 echo "
//                 <script>
//                     alert('Password salah 1')
//                 </script>
//                 ";
//             }
//         }elseif ( $result = mysqli_query($conn,"SELECT * FROM admin WHERE email = '$email'") ) {
//             if ( mysqli_num_rows($result) === 1 ) {
//                 $row = mysqli_fetch_assoc($result);
//                 $queryPassword = $row['password'];
//                 if ($password == $queryPassword) {
//                     $_SESSION["ADMIN"] = true;
//                     $_SESSION["NAMA_ADMIN"] = $row["nama_admin"];
//                     $_SESSION["ID_ADMIN"] = $row["ID"];
    
//                     if( isset($_POST['remember']) ) {
//                         setcookie('ADMIN','$2y$10$9s/.dIBNCIlT7aSBOBMUtuGkNftUt7qt/nIu2joejfewoEFEI9779BK799hg6gb', time() + 86400 * 7);
//                     }
//                     header("Location: index.php"); 
//                     exit;
//                 } else {
//                     echo "
//                     <script>
//                         alert('Password salah 2')
//                     </script>
//                     ";
//                 }
//             }else {
//                 echo "
//                 <script>
//                     alert('Akun belum terdaftar')
//                 </script>
//             ";
//             }
//         }
//     }
// }
if (isset($_POST['submit'])) {
    if ( $result = mysqli_query($conn,"SELECT * FROM admin WHERE email = '$email'") ) {
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $queryPassword = $row['password'];
            if ($password == $queryPassword) {
                $_SESSION["ADMIN"] = true;
                $_SESSION["USERNAME"] = $row["nama_admin"];
                $_SESSION["ID"] = $row["ID"];

                if( isset($_POST['remember']) ) {
                    setcookie('qnw22yuUDphYb32ttuBono86OIBtTPMu3', $row['ID'], time() + 86400 * 7);
                    setcookie('qn4543w22U76NHH87uehjrpoJjoiuihUG97',hash('sha256', $row['nama_admin']), time() + 86400 * 7);
                }
                
                header("Location: index.php"); 
                exit;
            } else {
                $_SESSION['notif'] = [
                    'type' => 'error',
                    'title' => 'Gagal Login!',
                    'text' => 'Password yang anda masukkan salah'
                ];
            }
        }
        else {
            $_SESSION['notif'] = [
                'type' => 'error',
                'title' => 'Gagal Login!',
                'text' => 'Email yang anda masukkan salah'
            ];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/css/main.css">
    <script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <title>LOGIN</title>
</head>

<body class="body">
    <nav>
        <div class="main">
            <div class="logo">
                <h1>
                    <a href="">Tesya Lobster Farm</a>
                </h1>
            </div>
            <div class="list">
                <ul>
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="product.php">Product</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="menu-btn">
                <div class="menu-btn__burger"></div>
            </div>
        </div>
    </nav>
    <section class="login">
        <div class="box">
            <div class="heading">
                <div class="heading-one">
                    <h4>Masukkan detail anda</h4>
                </div>
                <div class="main-heading">
                    <h2>Selamat Datang Kembali</h2>
                </div>
            </div>
            <div class="field-input">
                <form action="" method="post">
                    <div class="email">
                        <input type="email" name="email" id="" placeholder="Email" required>
                    </div>
                    <div class="password">
                        <input type="password" name="password" id="" placeholder="Password" required>
                    </div>
                    <div class="rememberMe-forgerPass">
                        <div class="remember-me">
                            <input type="checkbox" name="remember" id="remember-me">
                            <label for="remember-me">Ingat Saya</label>
                        </div>
                        <!-- <div class="reset-password">
                            <a href="http://">Lupa password</a>
                        </div> -->
                    </div>
                    <div class="login-button">
                        <button type="submit" name="submit">LOGIN</button>
                    </div>
                </form>
            </div>
            <!-- <div class="buat-akun">
                <p>Tidak punya akun?</p>
                <a href="sign-up.php">Daftar Mudah</a>
            </div> -->
        </div>
    </section>
    <?php include 'footer.php' ?>
    <?php if (isset($_SESSION['notif'])): ?>
    <?php
        $type = $_SESSION['notif']['type'];
        $text = $_SESSION['notif']['text'];

        // Judul otomatis berdasarkan tipe
        switch ($type) {
            case 'success':
                $title = 'Berhasil!';
                break;
            case 'error':
                $title = 'Gagal!';
                break;
            case 'warning':
                $title = 'Peringatan!';
                break;
            case 'info':
                $title = 'Informasi';
                break;
            case 'question':
                $title = 'Konfirmasi';
                break;
            default:
                $title = 'Notifikasi';
        }
    ?>
    <script>
        Swal.fire({
            icon: '<?= $type ?>',
            title: '<?= $title ?>',
            text: '<?= $text ?>'
        });
    </script>
    <?php unset($_SESSION['notif']); endif; ?>
</body>

</html>