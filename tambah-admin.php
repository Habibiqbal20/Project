<?php
session_start();
include 'data/function.php';
if (!isset($_SESSION['ADMIN'])) {
    header("location: javascript://history.go(-1)");
    exit;
}

if ( isset($_POST['submit']) ) {
    if( addAdmin($_POST) > 0 ) {
        echo  "<script>
                    alert('Admin Berhasil Ditambahkan')
                    location.replace('dashboard.php');
                </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/css/main.css">
    <title>Dashboard Admin</title>
</head>

<body>
    <nav>
        <div class="main">
            <div class="logo">
                <h1>
                    <a href="">Tesya Lobster Farm</a>
                </h1>
            </div>
            <div class="list">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="product.php">Product</a></li>
                    <li><a href="gallery.php">Gallery</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <?php
                    error_reporting(0);
                    if ($_SESSION['USER'] === true) {
                    ?>
                        <li><button id="logout">Logout</button></li>
                    <?php
                    } elseif ($_SESSION['ADMIN'] === true) {
                    ?>
                        <li><a href="dashboard.php" class="active">Dashboard</a></li>
                        <li><button id="logout">Logout</button></li>
                    <?php
                    } else {
                    ?>
                        <li><button id="login">Login</button></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="menu-btn">
                <div class="menu-btn__burger"></div>
            </div>
        </div>
    </nav>
    <div class="dashboard">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="box">
                <div class="sidebar-header">
                    <h3>Admin Dashboard</h3>
                </div>
                <ul class="sidebar-menu">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="tambah-barang.php">Tambah Barang</a></li>
                    <li class="active"><a href="">Tambah Admin</a></li>
                </ul>
            </div>
        </div>
        <div class="main-content">
            <section class="produk-section">
                <div class="heading">
                    <h2>Tambah Admin</h2>
                </div>
                <div class="container">
                    <div class="field-input">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="nama-barang">
                                <label for="nama-admin">Nama Admin :</label>
                                <input type="text" name="namaAdmin" id="nama-barang" placeholder="Nama Admin" required>
                            </div>
                            <div class="nama-barang">
                                <label for="email">Email :</label>
                                <input type="text" name="email" id="email" placeholder="Email" required>
                            </div>
                            <div class="nama-barang">
                                <label for="pass">Password :</label>
                                <input type="text" name="pass" id="pass" placeholder="Password" required>
                            </div>
                            <div class="harga">
                                <label for="no-hp">No Telp :</label>
                                <input type="number" name="no-hp" id="no-hp" placeholder="No Telp" required>
                            </div>
                            <div class="tambah-button">
                                <button type="submit" name="submit">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script src="asset/js/dashboard.js"></script>
    <script src="asset/js/script.js"></script>
</body>

</html>