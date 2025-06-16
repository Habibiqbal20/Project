<?php

include 'data/function.php';
session_start();
if(!isset($_SESSION['ADMIN'])) {
    header("location: javascript://history.go(-1)");
    exit;
}

if (isset($_POST['submit'])) {
    //var_dump(komentarUser($_POST));die;
    if (signUp ($_POST) > 0) {
        echo  "<script>
                    alert('Anda telah berhasil mendaftar')
                    location.replace('login.php');
                </script>";
    } else {
        echo "<script>
                alert('Gagal mendaftar')
                location.replace('sign-up.php');
            </script>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/css/main.css">
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
                    <li><a href="gallery.php">Gallery</a></li>
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
                    <h2>Daftarkan diri anda</h2>
                </div>
            </div>
            <div class="field-input">
                <form action="" method="post">
                    <div class="user-type">
                        <input type="text" name="userType" id="" placeholder="Email" value="User" required readonly>
                    </div>
                    <div class="email">
                        <input type="email" name="email" id="" placeholder="Email" required>
                    </div>
                    <div class="username">
                        <input type="text" name="username" id="" placeholder="Username" required>
                    </div>
                    <div class="password">
                        <input type="password" name="password" id="" placeholder="Password" required>
                    </div>
                    <div class="password-confirm">
                        <input type="password" name="confirm-password" id="" placeholder="Masukkan Kembali Password Anda" required>
                    </div>
                    <div class="login-button">
                        <button type="submit" name="submit">DAFTAR</button>
                    </div>
                </form>
            </div>
            <div class="buat-akun">
                <p>Sudah ada akun?</p>
                <a href="login.php">Masuk</a>
            </div>
        </div>
    </section>
    <?php include 'footer.php' ?>
</body>

</html>