<?php
session_start();
include 'data/function.php';
if (!isset($_SESSION['ADMIN'])) {
    header("location: javascript://history.go(-1)");
    exit;
}
if (isset($_POST['submit'])) {
    //var_dump(komentarUser($_POST));die;
    if (addProduct($_POST) > 0) {
        $_SESSION['notif'] = [
            'type' => 'success', 
            'text' => 'Produk berhasil ditambahkan'
        ];
    }
    header('Location: dashboard.php');
    exit;
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
                    <li class="active"><a href="">Tambah Barang</a></li>
                </ul>
            </div>
        </div>
        <div class="main-content">
            <section class="produk-section">
                <div class="heading">
                    <h2>Tambah Barang</h2>
                </div>
                <div class="container">
                    <div class="field-input">
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="text" name="uniq-code" id="kodeUnik" value="" readonly hidden>
                            <div class="nama-barang">
                                <label for="nama-barang">Nama Barang :</label>
                                <input type="text" name="namaBarang" id="nama-barang" placeholder="Nama barang" required>
                            </div>
                            <div class="harga">
                                <label for="harga">Harga :</label>
                                <input type="number" name="harga" id="harga" placeholder="Harga barang" required>
                            </div>
                            <div class="stok">
                                <label for="stok">Ketersedian</label>
                                <select name="stok" id="stok">
                                    <option value="Tersedia">Tersedia</option>
                                    <option value="Tidak Tersedia">Tidak Tersedia</option>
                                </select>
                            </div>
                            <div class="deskripsi">
                                <label for="Keterangan-Barang">Keterangan Barang :</label>
                                <textarea name="deskripsi" id="Keterangan-Barang" cols="30" rows="10"></textarea>
                            </div>
                            <div class="input-foto">
                                <div class="upload-section">
                                    <label for="file-input" class="upload-box">+</label>
                                    <div id="preview"></div>
                                </div>
                                <input type="file" name="images[]" id="file-input" multiple accept="image/*">
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