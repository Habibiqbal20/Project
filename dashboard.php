<?php
session_start();
include 'data/function.php';
if (!isset($_SESSION['ADMIN'])) {
    header("location: javascript://history.go(-1)");
    exit;
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
                    <li class="active"><a href="">Dashboard</a></li>
                    <li><a href="tambah-barang.php">Tambah Barang</a></li>
                    <!-- <li><a href="tambah-admin.php">Tambah Admin</a></li> -->
                </ul>
            </div>
        </div>
        <div class="main-content">
            <section class="produk-section" id="produk">
                <div class="heading">
                    <h2>Daftar Produk</h2>
                </div>
                <div class="container">
                    <table class="produk-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            $limit = 5;
                            $offset = ($page - 1) * $limit;

                            $totalQuery = "SELECT COUNT(*) as total FROM product";
                            $totalResult = $conn->query($totalQuery);
                            $totalData = $totalResult->fetch_assoc()['total'];
                            $totalPages = ceil($totalData / $limit);

                            $sql = "SELECT * FROM product LIMIT $limit OFFSET $offset";
                            $result = $conn->query($sql);

                            $i = $offset + 1; // supaya nomor urut sesuai halaman
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td><?= $i++ ?>.</td>
                                        <td>
                                            <?php
                                            $namaProduk = $row['uniq_code'];
                                            $sqlGambar = "SELECT * FROM foto_produk WHERE uniq_code = '$namaProduk' LIMIT 1";
                                            $resultGambar = $conn->query($sqlGambar);
                                            if ($resultGambar->num_rows > 0) {
                                                $rowGambar = $resultGambar->fetch_assoc();
                                            ?>
                                                <img src="asset/upload/<?= $rowGambar['gambar'] ?>" alt="" width="70%">
                                            <?php } ?>
                                        </td>
                                        <td><a href="product.php?U=<?= $row['ID'] ?>"><?= $row['product_name'] ?></a></td>
                                        <td>Rp. <?= number_format($row["price"], 0, ',', '.') ?></td>
                                        <td><?= $row['stok'] ?></td>
                                        <td><?= $row['description'] ?></td>
                                        <td class="aksi">
                                            <a href="update.php?code=<?= $row['uniq_code'] ?>" class="edit">Edit</a>
                                            <a href="hapus-produk.php?UC=<?= $row['uniq_code'] ?>" class="hapus" id="hapus">Hapus</a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="pagination">
                    <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                        <a href="?page=<?= $p ?>#produk" style=" <?= $p == $page ? 'background:#007bff; color:white;' : '' ?>">
                            <?= $p ?>
                        </a>
                    <?php endfor; ?>
                </div>

            </section>
            <!-- Daftar Admin -->
            <section class="admin-section">
                <h2>Daftar Admin</h2>
                <div class="container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No HP</th>
                                <th>Password</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sqlAdmin = "SELECT * FROM admin";
                            $resultAdmin = $conn->query($sqlAdmin);
                            $i = 1;
                            if ($resultAdmin->num_rows > 0) {
                                while ($rowAdmin = $resultAdmin->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td><?= $i++ ?>.</td>
                                        <td><?= $rowAdmin['nama_admin'] ?></td>
                                        <td><?= $rowAdmin['email'] ?></td>
                                        <td><?= $rowAdmin['no_telp'] ?></td>
                                        <td><?= $rowAdmin['password'] ?></td>
                                        <td class="aksi">
                                            <a href="edit-admin.php?ID=<?= $rowAdmin['ID'] ?>" class="edit">Edit</a>
                                            <!-- <a href="hapus-admin.php?ID=<?= $rowAdmin['ID'] ?>" class="hapus" id="hapusAdmin">Hapus</a> -->
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
            <section class="admin-section" id="saran">
                <h2>Saran</h2>
                <div class="container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>No HP</th>
                                <th>Saran</th>
                            </tr>
                        </thead>
                        <?php
                        // Ambil nomor halaman dari parameter URL
                        $page_saran = isset($_GET['page_saran']) ? (int)$_GET['page_saran'] : 1;
                        $limit_saran = 5; // jumlah entri per halaman
                        $offset_saran = ($page_saran - 1) * $limit_saran;

                        // Hitung total data saran
                        $totalQuerySaran = "SELECT COUNT(*) as total FROM kotak_saran";
                        $totalResultSaran = $conn->query($totalQuerySaran);
                        $totalDataSaran = $totalResultSaran->fetch_assoc()['total'];
                        $totalPagesSaran = ceil($totalDataSaran / $limit_saran);

                        // Ambil data dengan pagination
                        $sqlSaran = "SELECT * FROM kotak_saran ORDER BY id DESC LIMIT $limit_saran OFFSET $offset_saran";
                        $resultSaran = $conn->query($sqlSaran);
                        $i = $offset_saran + 1;
                        ?>
                        <tbody>
                            <?php
                            if ($resultSaran->num_rows > 0) {
                                while ($rowSaran = $resultSaran->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td><?= $i++ ?>.</td>
                                        <td><?= htmlspecialchars($rowSaran['Nama']) ?></td>
                                        <td><?= htmlspecialchars($rowSaran['WhatsApp']) ?></td>
                                        <td><?= htmlspecialchars($rowSaran['Saran']) ?></td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="4">Tidak ada data saran.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="pagination">
                    <?php for ($p = 1; $p <= $totalPagesSaran; $p++): ?>
                        <a href="?page_saran=<?= $p ?>&page_produk=<?= $page_produk ?>#saran"
                            style="<?= $p == $page_saran ? 'background:#007bff; color:white;' : '' ?>">
                            <?= $p ?>
                        </a>
                    <?php endfor; ?>
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