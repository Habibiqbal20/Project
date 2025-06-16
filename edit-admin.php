<?php
session_start();
include 'data/function.php';
if (!isset($_SESSION['ADMIN'])) {
    header("location: javascript://history.go(-1)");
    exit;
}
if (isset($_POST['submit'])) {
    if (updateAdmin($_POST) > 0) {
        $_SESSION['notif'] = [
            'type' => 'success',
            'text' => 'Data berhasil diedit'
        ];
        header('Location: dashboard.php');
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
                    <li><a href="">Tambah Barang</a></li>
                    <li><a href="tambah-admin.php">Tambah Admin</a></li>
                </ul>
            </div>
        </div>
        <div class="main-content">
            <section class="produk-section">
                <div class="heading">
                    <h2>Ubah Data Admin</h2>
                </div>
                <div class="container">
                    <div class="field-input">
                        <form action="" method="post">
                            <?php
                            $id = $_GET['ID'];
                            $sql = "SELECT * FROM admin WHERE ID = '$id'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                            ?>
                            <input type="text" value="<?=$id?>" name="id" hidden>
                                <div class="nama-admin">
                                    <label for="nama-admin">Nama Admin :</label>
                                    <input type="text" name="namaAdmin" id="nama-admin" placeholder="Nama Admin" value="<?= $row['nama_admin'] ?>" required>
                                </div>
                                <div class="email">
                                    <label for="Email">Email :</label>
                                    <input type="text" name="email" id="Email" placeholder="Email" value="<?= $row['email'] ?>" required>
                                </div>
                                <div class="no-hp">
                                    <label for="No-hp">No HP :</label>
                                    <input type="text" name="no-hp" id="No-hp" placeholder="Nomor HP" value="<?= $row['no_telp'] ?>" required>
                                </div>
                                <div class="pass">
                                    <label for="pass">Password :</label>
                                    <input type="text" name="pass" id="pass" placeholder="Password" value="<?= $row['password'] ?>" required>
                                </div>
                                <div class="tambah-button">
                                    <button type="submit" name="submit">Ubah</button>
                                </div>
                            <?php
                            }
                            ?>
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