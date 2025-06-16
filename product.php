<?php
session_start();
include 'data/function.php';
error_reporting(0);
$U = $_GET['U'];

if (isset($_POST['komentar_user'])) {
    $hasil = komentarUser($_POST);
    if ($hasil > 0) {
        $_SESSION['notif'] = [
            'type' => 'success', 
            'text' => 'Komentar berhasil ditambahkan'
        ];
    } elseif ($hasil === false) {
        $_SESSION['notif'] = [
            'type' => 'error', 
            'text' => 'Batas maksimal foto adalah 5'
        ];
    }
    header("Location: product.php?U=$U"); // redirect ke halaman target
    exit;
}

if (isset($_POST['balas'])) {
    if (reply($_POST) > 0) {
        $_SESSION['notif'] = [
            'type' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Balasan berhasil ditambahkan'
        ];
    } else {
        $_SESSION['notif'] = [
            'type' => 'error',
            'title' => 'Gagal!',
            'text' => 'Balasan gagal ditambahkan'
        ];
    }
    header("Location: product.php?U=$U");
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/css/main.css">
    <script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <title>Product</title>
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
                    <?php
                    if ($U = $U) {
                    ?>
                        <li><a href="product.php" class="active">Product</a></li>
                    <?php
                    } else {
                    ?>
                        <li><a href="" class="active">Product</a></li>
                    <?php
                    }
                    ?>
                    <li><a href="contact.php">Contact</a></li>
                    <?php
                    error_reporting(0);
                    if ($_SESSION['USER'] == true) {
                    ?>
                        <li><button id="logout">Logout</button></li>
                    <?php
                    } elseif ($_SESSION['ADMIN'] === true) {
                    ?>
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><button id="logout">Logout</button></li>
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
    <?php
    if ($U = $U) {
        $sql = "SELECT * FROM product WHERE ID = '$U'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if ($row = $result->fetch_assoc()) {
    ?>
                <div class="kolom-produk">
                    <div class="product-row">
                        <div class="img">
                            <?php
                            $uniqCode = $row['uniq_code'];
                            $sqlFoto = "SELECT * FROM foto_produk WHERE uniq_code = '$uniqCode'";
                            $resultFoto = $conn->query($sqlFoto);

                            if ($resultFoto->num_rows > 0) {
                                if ($rowFoto = $resultFoto->fetch_assoc()) {
                            ?>
                                    <img id="main-photo" src="asset/upload/<?= $rowFoto['gambar'] ?>" alt="">
                                    <div id="image-modal" class="modal">
                                        <span class="close">&times;</span>
                                        <img class="modal-content" id="modal-img">
                                    </div>
                                    <div class="more-photo">
                                        <?php
                                        $sqlThumb = "SELECT * FROM foto_produk WHERE uniq_code = '$uniqCode' LIMIT 100 OFFSET 1";
                                        $resultThumb = $conn->query($sqlThumb);

                                        if ($resultThumb->num_rows > 0) {
                                            while ($rowThumb = $resultThumb->fetch_assoc()) {
                                        ?>
                                                <div class="foto" id="thumbnails">
                                                    <img class="thumbnail" src="asset/upload/<?= $rowThumb['gambar'] ?>" alt="">
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="product-information">
                            <div class="information">
                                <div class="nama-produk">
                                    <h3><?= $row['product_name'] ?></h3>
                                    <?php
                                    $sqlCount = "SELECT COUNT(rating) AS total_rating FROM komentar WHERE id_barang = '$U'";
                                    $resultCount = $conn->query($sqlCount);
                                    $data = mysqli_fetch_assoc($resultCount);
                                    $totalRating = $data['total_rating'];
                                    if ($totalRating > '0') {
                                        $sqlRating = "SELECT AVG(rating) AS rata_rata FROM komentar WHERE id_barang = '$U'";
                                        $resultRating = $conn->query($sqlRating);
                                        if ($resultRating->num_rows > 0) {
                                            if ($rowRating = $resultRating->fetch_assoc()) {
                                    ?>
                                                <div class="rating">
                                                    <h5 class="p1">• ⭐️ <?= number_format($rowRating['rata_rata'], 1) ?> </h5>
                                                    <h5 class="p2">(<?= $totalRating ?> rating)</h5>
                                                </div>
                                        <?php
                                            }
                                        }
                                    } else {
                                        ?>
                                        <div class="rating">
                                            <h5 class="p1">• ⭐️ Belum ada rating </h5>
                                            <h5 class="p2">(0 rating)</h5>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="detail-produk">
                                    <div class="heading">
                                        <h5>Detail</h5>
                                    </div>
                                    <div class="harga">
                                        <p>Harga :
                                        <p>Rp.<?= number_format($row['price'], 0, ',', '.') ?></p>
                                        </p>
                                    </div>
                                    <div class="stok">
                                        <p>Stok :
                                        <p><?=$row['stok']?></p>
                                        </p>
                                    </div>
                                    <div class="keterangan">
                                        <h4 class="heading-text">Keterangan Produk</h4>
                                        <div class="isi">
                                            <h4 class="text"><?=$row['description']?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $sqlAdmin = "SELECT * FROM admin";
                            $resultAdmin = $conn->query($sqlAdmin);

                            if( $resultAdmin->num_rows > 0 ) {
                                if( $rowAdmin = $resultAdmin->fetch_assoc() ) {
                            ?>
                            <div class="whatsapp">
                                <button id="whatsapp" data-barang="<?=$row['product_name']?>" data-harga="<?=number_format($row['price'], 0, ',', '.')?>" data-admin="<?=substr($rowAdmin['no_telp'], 1)?>">WhatsApp</button>
                            </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="comment-input" id="form-komentar">
                            <div class="heading">
                                <h3>Ulasan Anda</h3>
                            </div>
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="text" name="id_barang" id="" value="<?= $U ?>" style="display: none;" readonly>
                                <!-- <input type="text" name="id_user" id="" value="<?= $_SESSION["ID"] ?>" style="display: none;" readonly> -->
                                <input type="date" name="tanggal" id="tanggal" style="display: none;" readonly>
                                <input type="text" name="kodeUnik" id="kodeUnik" readonly style="display: none;">
                                <div class="rating">
                                    <div class="rating-input">
                                        <label for="rating">Rating:</label>
                                        <input type="range" id="rating" name="rating" min="1" max="5" step="1" value="5" required>
                                        <div id="rating-stars">⭐️⭐️⭐️</div>
                                    </div>
                                    <div id="rating-number" style="display: none;">3 / 5</div>
                                </div>
                                <div class="nama">
                                    <label for="nama">Nama :</label>
                                    <input type="text" name="nama" id="nama" required>
                                </div>
                                <div class="input-foto">
                                    <div class="upload-section">
                                        <label for="file-input" class="upload-box">+</label>
                                        <div id="preview"></div>
                                    </div>
                                    <input type="file" name="images[]" id="file-input" multiple accept="image/*">
                                </div>
                                <div class="komentar">
                                    <label for="komentar">Komentar :</label>
                                    <textarea class="textarea" name="komentar" id="komentar" cols="30" rows="10" required></textarea>
                                </div>
                                <div class="submit">
                                    <button type="submit" name="komentar_user">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="users-comments">
                        <div class="comment">
                            <div class="heading">
                                <h3>Ulasan Pembeli</h3>
                            </div>
                            <div class="container-rating">
                                <div class="box-rating">
                                    <?php
                                    if ($totalRating > '0') {
                                    ?>
                                        <h1>⭐️ <?= number_format($rowRating['rata_rata'], 1) ?><span>/</span><span>5</span></h1>
                                        <h1 class="total_rating">
                                            • <?= $totalRating ?> rating
                                        </h1>
                                    <?php
                                    } else {
                                    ?>
                                        <h1>⭐️ -<span>/</span><span>5</span></h1>
                                        <h1 class="total_rating">
                                            • 0 rating
                                        </h1>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="box-rating-bar">
                                    <div class="rating-bars">
                                        <?php
                                        $idBarang = $U;
                                        $query = mysqli_query($conn, "SELECT rating FROM komentar WHERE id_barang = $idBarang");
                                        $ratings = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
                                        $total = 0;
                                        $totalScore = 0;
                                        while ($row = mysqli_fetch_assoc($query)) {
                                            $rate = (int)$row['rating'];
                                            if (isset($ratings[$rate])) {
                                                $ratings[$rate]++;
                                                $total++;
                                                $totalScore += $rate;
                                            }
                                        }
                                        $average = $total > 0 ? round($totalScore / $total, 1) : 0;
                                        for ($i = 5; $i >= 1; $i--) {
                                        ?>
                                            <div class="rating-row">
                                                <span><?= $i ?> ⭐️</span>
                                                <div class="bar">
                                                    <div class="fill" style="width: <?= $total > 0 ? ($ratings[$i] / $total * 100) : 0 ?>%;"></div>
                                                </div>
                                                <span><?= $ratings[$i] ?></span>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $sql = "SELECT * FROM komentar WHERE id_barang = $U";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $kode = $row['kode_unik'];
                            ?>
                            <div class="users-comment-column">
                                <div class="user-information">
                                    <div class="nama">
                                        <p><?= $row['nama_user'] ?></p>
                                    </div>
                                    <div class="tanggal-komentar">
                                        <p><?= $row['tanggal'] ?></p>
                                    </div>
                                    <?php
                                    $rating = $row['rating'];
                                    if ($rating == '1') {
                                    ?>
                                        <div class="rating">
                                            <p>⭐️</p>
                                        </div>
                                    <?php
                                    } elseif ($rating == '2') {
                                    ?>
                                        <div class="rating">
                                            <p>⭐️⭐️</p>
                                        </div>
                                    <?php
                                    } elseif ($rating == '3') {
                                    ?>
                                        <div class="rating">
                                            <p>⭐️⭐️⭐️</p>
                                        </div>
                                    <?php
                                    } elseif ($rating == '4') {
                                    ?>
                                        <div class="rating">
                                            <p>⭐️⭐️⭐️⭐️</p>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="rating">
                                            <p>⭐️⭐️⭐️⭐️⭐️</p>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="review">
                                    <div class="text">
                                        <p><?= $row['komentar'] ?></p>
                                    </div>
                                    <div class="container-foto">
                                        <?php
                                        $uniqCode = $row['kode_unik'];
                                        $sqlFoto = "SELECT * FROM foto_komentar WHERE kode_unik = '$uniqCode'";
                                        $resultFoto = $conn->query($sqlFoto);
                                        if ($resultFoto->num_rows > 0) {
                                            while ($rowFoto = $resultFoto->fetch_assoc()) {
                                        ?>
                                                <div class="foto">
                                                    <img src="asset/upload/<?= $rowFoto['foto'] ?>" alt="">
                                                </div>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php
                                $sqlReplyCount = "SELECT COUNT(*) as total FROM reply WHERE uniq_code = '$uniqCode'";
                                $resultReplyCount = $conn->query($sqlReplyCount);
                                $rowReplyCount = $resultReplyCount->fetch_assoc();

                                $jumlahData = $rowReplyCount['total'];
                                if ($jumlahData == '0') {
                                    if ( isset($_SESSION['ADMIN']) ) {
                                ?>
                                <div class="action">
                                    <a href="hapus-komentar.php?UC=<?=$kode?>&ID=<?=$U?>" id="hapus">Hapus</a>
                                    <a id="balas">Balas</a>
                                </div>
                                <?php
                                    }
                                ?>
                                <div class="reply display" id="form">
                                    <form action="" method="post">
                                        <input type="text" name="balasan" placeholder="Balasan anda" autofocus>
                                        <input type="text" name="id_barang" id="" value="<?= $U ?>" >
                                        <input type="text" name="uniq_code" value="<?= $uniqCode ?>" >
                                        <input type="text" name="tanggal" id="tanggal">
                                        <button type="submit" name="balas">Balas</button>
                                    </form>
                                </div>
                                <?php
                                } else {
                                    $sqlReply = "SELECT * FROM reply WHERE uniq_code = '$uniqCode'";
                                    $resultReply = $conn->query($sqlReply);

                                    if ($resultReply->num_rows > 0) {
                                        if ($rowReply = $resultReply->fetch_assoc()) {
                                    ?>
                                    <div class="reply">
                                        <div class="reply-heading">
                                            <div class="nama">
                                                <p>Admin</p>
                                            </div>
                                            <div class="tanggal-balas">
                                                <p><?= $rowReply['tanggal'] ?></p>
                                            </div>
                                        </div>
                                        <div class="reply-comment">
                                            <p><?= $rowReply['balasan'] ?></p>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <?php
                                }
                            } else {
                            ?>
                            <div class="komentar-kosong">
                                <img src="asset/images/no-comment.png" alt="No Comments" class="ikon-kosong">
                                <h4>Belum ada komentar</h4>
                                <p>Yuk jadi orang pertama yang memberikan ulasan untuk produk ini!</p>
                                <a href="#form-komentar" class="tombol-komentar">Tulis Komentar</a>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
    } else {
        ?>
        <section class="col-collection-product" id="barang">
            <div class="main-collection">
                <div class="header-collection">
                    <div class="title">
                        <h1>Lobster yang kami jual kepada anda</h1>
                    </div>
                </div>

                <div class="available-collection">
                    <div class="main-available-collection">
                        <div class="collection">
                            <?php
                            $sql = "SELECT * FROM product LIMIT 8";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <div class="card">
                                        <?php
                                        $namaProduk = $row['product_name'];
                                        $sqlGambar = "SELECT * FROM foto_produk where product_name = '$namaProduk'";
                                        $resultGambar = $conn->query($sqlGambar);

                                        if( $resultGambar->num_rows > 0 ) {
                                            $rowGambar = $resultGambar->fetch_assoc();
                                        ?>
                                        <img src="asset/upload/<?= $rowGambar['gambar'] ?>" alt="">
                                        <?php
                                        }
                                        ?>
                                        <div class="collection-detail">
                                            <?php
                                            $idBarang = $row['ID'];
                                            $sqlCount = "SELECT COUNT(rating) AS total_rating FROM komentar WHERE id_barang = '$idBarang'";
                                            $resultCount = $conn->query($sqlCount);
                                            $data = mysqli_fetch_assoc($resultCount);
                                            $totalRating = $data['total_rating'];

                                            $queryRating = mysqli_query($conn, "SELECT AVG(rating) as avg_rating FROM komentar WHERE id_barang = '$idBarang'");
                                            $dataRating = mysqli_fetch_assoc($queryRating);
                                            $avgRating = round($dataRating['avg_rating'], 1);
                                            $rating = $avgRating;
                                            $percent = ($rating / 5) * 100;
                                            ?>
                                            <div class="star-rating">
                                                <span class="stars-back">★★★★★</span>
                                                <span class="stars-front" style="width: <?= $percent ?>%;">★★★★★</span>
                                            </div>
                                            <div class="rating-info">
                                                <h4 class="number-rating"><?= $rating ?>/ 5</h4>
                                                <h4 class="total-rating">(<?= $totalRating ?> Rating)</h4>
                                            </div>
                                            <h3><?= $row['product_name'] ?></h3>
                                            <p class="des"><?= $row['description'] ?></p>
                                            <p class="p">Rp. <?= number_format($row["price"], 0, ',', '.') ?></p>
                                        </div>
                                        <div class="buy-button">
                                            <a href="?U=<?= $row['ID'] ?>">Detail</a>
                                        </div>
                                    </div>
                            <?php
                                }
                            } else {
                                echo 'none';
                            }
                            ?>

                        </div>
                    </div>
                    <!-- <div class="show-all">
                        <a href="">Show All <i class="fas fa-external-link-alt"></i></a>
                    </div> -->
                </div>
            </div>
        </section>
    <?php
    }
    ?>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');
            const todayStr = `${yyyy}-${mm}-${dd}`;

            const tanggalEl = document.getElementById('tanggal');
            if (tanggalEl) {
                tanggalEl.value = todayStr;
            }

            const semuaTanggal = document.querySelectorAll('#tanggal');
            semuaTanggal.forEach(el => {
                el.value = todayStr;
            });
        });
    </script>
    <script src="asset/js/scriptProduct.js"></script>
    <script src="asset/js/script.js"></script>

</body>

</html>