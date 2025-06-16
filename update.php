<?php
session_start();
include 'data/function.php';
$uniqCode = $_GET['code'];
if (!isset($_SESSION['ADMIN'])) {
    header("location: javascript://history.go(-1)");
    exit;
}
if (isset($_POST['submit'])) {
    if (update($_POST) > 0) {
        $_SESSION['notif'] = [
            'type' => 'success', 
            'text' => 'Data produk berhasil diubah'
        ];
        header('Location: dashboard.php');
        exit;
    }else {
        $_SESSION['notif'] = [
            'type' => 'success', 
            'text' => 'Foto produk berhasil ditambahkan'
        ];
        header('Location: update.php?code='.$uniqCode);
    }
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/css/main.css">
    <script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
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
                            <?php
                            
                            $sql = "SELECT * FROM product WHERE uniq_code = '$uniqCode'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                            ?>
                                <input type="text" value="<?=$row['uniq_code']?>" name="uniq_code" hidden>
                                <div class="nama-barang">
                                    <label for="nama-barang">Nama Barang :</label>
                                    <input type="text" name="namaBarang" id="nama-barang" placeholder="Nama barang" value="<?= $row['product_name'] ?>" required>
                                </div>
                                <div class="harga">
                                    <label for="harga">Harga :</label>
                                    <input type="number" name="harga" id="harga" placeholder="Harga barang" value="<?= $row['price'] ?>" required>
                                </div>
                                <div class="stok">
                                    <label for="stok">Ketersedian</label>
                                    <?php
                                    if ($row['stok'] = 'Tersedia') {
                                    ?>
                                        <select name="stok" id="stok">
                                            <option value="Tersedia">Tersedia</option>
                                            <option value="Tidak Tersedia">Tidak Tersedia</option>
                                        </select>
                                    <?php
                                    } elseif($row['stok'] = 'Tidak Tersedia') {
                                    ?>
                                        <select name="stok" id="stok">
                                            <option value="Tidak Tersedia">Tidak Tersedia</option>
                                            <option value="Tersedia">Tersedia</option>
                                        </select>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="deskripsi">
                                    <label for="Keterangan-Barang">Keterangan Barang :</label>
                                    <textarea name="deskripsi" id="Keterangan-Barang" cols="30" rows="10"><?= $row['description'] ?></textarea>
                                </div>
                                <div class="input-foto">
                                    <div class="upload-section">
                                        <label for="file-input" class="upload-box">+</label>
                                        <div id="preview"></div>
                                    </div>
                                    <input type="file" name="images[]" id="file-input" multiple accept="image/*">
                                </div>
                                <div class="tambah-button">
                                    <button type="submit" name="submit">Ubah</button>
                                </div>
                            <?php
                            }
                            ?>
                        </form>
                        <form action="" method="post">
                            <label for="" class="ubah-foto">Ubah Foto</label>
                            <div class="foto">
                                <?php
                                $sqlFoto = "SELECT * FROM foto_produk WHERE uniq_code = '$uniqCode'";
                                $resultFoto = $conn->query($sqlFoto);

                                if ($resultFoto->num_rows > 0) {
                                    while ($rowFoto = $resultFoto->fetch_assoc()) {
                                ?>
                                        <div class="row">
                                            <img src="asset/upload/<?= $rowFoto['gambar'] ?>" alt="">
                                            <div class="hapus-foto">
                                                <a href="hapus-foto.php?UC=<?=$rowFoto['gambar']?>&produk=<?=$uniqCode?>" id="hapus">Hapus</a>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
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
    <script src="asset/js/dashboard.js"></script>
    <script src="asset/js/script.js"></script>
</body>

</html>