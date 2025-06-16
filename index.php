<?php
session_start();
include 'data/function.php';

if ( isset($_COOKIE['qnw22yuUDphYb32ttuBono86OIBtTPMu3']) && isset($_COOKIE['qn4543w22U76NHH87uehjrpoJjoiuihUG97'])) {
    $ID = $_COOKIE['qnw22yuUDphYb32ttuBono86OIBtTPMu3'];//ID
    $USER_NAME = $_COOKIE['qn4543w22U76NHH87uehjrpoJjoiuihUG97'];//NAMA DI HASH
    // var_dump($USER_NAME);die;

    $result = mysqli_query($conn, "SELECT * FROM admin WHERE ID = '$ID'") ;
    $row = mysqli_fetch_assoc($result);

    if ( $USER_NAME === hash('sha256', $row['nama_admin']) ) {
        $_SESSION["ADMIN"] = true;
        $_SESSION["USERNAME"] = $row["nama_admin"];
        $_SESSION["ID"] = $row["ID"];
        setcookie('qnw22yuUDphYb32ttuBono86OIBtTPMu3', $row['ID'], time() + 86400 * 7);
        setcookie('qn4543w22U76NHH87uehjrpoJjoiuihUG97',hash('sha256', $row['nama_admin']), time() + 86400 * 7);
    }
}

if (isset($_POST["submit"])) {
    if (addProduct($_POST) > 0) {
        echo  "<script>
                    alert('Data Berhasil Ditambahkan')
                    location.replace('index.php')
                </script>";
    } else {
        echo  "<script>
                    alert('Data Gagal Ditambahkan')
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
    <link rel="stylesheet" href="asset/fontawesome-free-6.2.1/css/all.css">
    <link rel="stylesheet" href="node_modules/aos/dist/aos.css">
    <title>Tesya Lobster Farm</title>
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
                    <li><a href="" class="active">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="product.php">Product</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <?php
                    error_reporting(0);
                    if ($_SESSION['USER'] == true) {
                    ?>
                        <li><button id="logout">Logout</button></li>
                    <?php
                    }elseif ($_SESSION['ADMIN'] === true) {
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

    <section class="main-hero">
        <div class="hero-content">
            <div class="content">
                <h1 data-aos="fade-down">Selamat Datang di Tesya Lobster Farm</h1>
                <button class="explore-btn" id="scroll" data-aos="fade-down" data-aos-delay="600" data-aos-duration="1500">Explore</button>
            </div>
        </div>
        <div class="carousel">
            <div class="carousel-item active">
                <img src="asset/images/homepage/_MG_6604.JPG" alt="Image 1">
            </div>
            <div class="carousel-item">
                <img src="asset/images/homepage/_MG_6701.JPG" alt="Image 2">
            </div>
            <div class="carousel-item">
                <img src="asset/images/homepage/_MG_6716.JPG" alt="Image 3">
            </div>
        </div>
        <button class="prev" data-aos="fade-right">‹</button>
        <button class="next" data-aos="fade-left">›</button>
    </section>

    <section class="about">
        <div class="col-about">
            <div class="col-text" data-aos="fade-down">
                <div class="top-heading">
                    <p>About Us</p>
                </div>
                <div class="heading">
                    <h2>Menghadirkan Lobster Air Tawar Yang Berkualitas Tinggi</h2>
                </div>
                <div class="main-about">
                    <p>Selamat datang di Tesya Lobster Farm, tempat terbaik untuk mendapatkan lobster air tawar berkualitas tinggi! Kami berdedikasi untuk menyediakan lobster air tawar yang sehat, segar, dan berkualitas.

                        Dengan pengalaman dan keahlian di bidang budidaya lobster, kami memastikan setiap lobster dipelihara dengan penuh perhatian dan dalam kondisi lingkungan yang terjaga.</p>
                </div>
                <div class="read-more">
                    <button id="readMore">Read More</button>
                </div>
            </div>
            <div class="col-img" data-aos="fade-down" data-aos-delay="250">
                <div class="img">
                    <img src="asset/images/homepage/about.jpg" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="col-services">
        <div class="main-services">
            <div class="header-services">
                <div class="title">
                    <h1>Kepuasan anda adalah yang utama</h1>
                </div>
                <div class="sub-title">
                    <p>Memberikan layanan yang kami punya demi kenyamanan anda.</p>
                </div>
            </div>
            <div class="available-services">
                <div class="main-available">
                    <div class="services">
                        <?php
                        $sql = "SELECT * FROM services";
                        $result = $conn->query($sql);
                        $i = 0;
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $i++;
                        ?>

                        <div class="card" data-aos="fade-up" data-aos-offset="220" data-aos-delay="<?=$i?>00">
                            <img class="one" src="asset/images/service/<?= $row['image'] ?>" alt="">
                            <div class="information-services">
                                <h3 class="service"><?= $row['services'] ?></h3>
                                <p class="description"><?= $row['description'] ?></p>
                                <?php
                                if( $i ==  '1') {
                                echo ' <a href="about.php#quality">Explore <i class="fas fa-external-link-alt"></i></a>';
                                }elseif ( $i == '2' ) {
                                echo '<a href="about.php#course">Explore <i class="fas fa-external-link-alt"></i></a>';
                                }else {
                                echo '<a href="about.php#shipping">Explore <i class="fas fa-external-link-alt"></i></a>';
                                }
                                ?>
                                
                            </div>
                        </div>
                        <?php
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="col-collection" id="barang">
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
                        $i = 0;
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $i++;
                        ?>
                                <div class="card" data-aos="fade-down" data-aos-offset="0" data-aos-delay="<?=$i?>00">
                                    <?php
                                    $namaProduk = $row['uniq_code'];
                                    $sqlGambar = "SELECT * FROM foto_produk WHERE uniq_code = '$namaProduk'";
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
                                        <a href="product.php?U=<?= $row['ID'] ?>">Detail</a>
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

    <section>
        <div class="ulasan_pembeli">
            <div class="heading">
                <h2>Ulasan Terbaik Dari Pembeli Kami</h2>
            </div>
            <div class="container">
                <?php
                $sqlUlasan = "SELECT * FROM komentar WHERE rating = '5' ORDER BY RAND() LIMIT 3";
                $resultUlasan = $conn->query($sqlUlasan);
                $i = 0;
                if ($resultUlasan->num_rows > 0) {
                    while ($rowUlasan = $resultUlasan->fetch_assoc()) {
                        $i++
                ?>
                        <div class="box" data-aos="zoom-out" data-aos-offset="10" data-aos-delay="<?=$i?>00">
                            <?php
                            $idBarangUlasan = $rowUlasan['id_barang'];
                            $sqlBarang = "SELECT * FROM product WHERE ID= '$idBarangUlasan'";
                            $resultBarang = $conn->query($sqlBarang);

                            if ($resultBarang->num_rows > 0) {
                                while ($rowBarang = $resultBarang->fetch_assoc()) {
                            ?>
                                    <div class="nama-dan-rating">
                                        <div class="nama-barang">
                                            <h2><?= $rowBarang['product_name'] ?></h2>
                                        </div>
                                        <div class="rating">
                                            <p>⭐️⭐️⭐️⭐️⭐️</p>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                            <div class="komentar">
                                <p><?= $rowUlasan['komentar'] ?></p>
                            </div>
                            <div class="user">
                                <div class="foto">
                                    <img src="asset/images/6e5f8e7edb35cd19d02d9a0907217b9e.jpg" alt="" width="50px">
                                </div>
                                <div class="information">
                                    <div class="nama">
                                        <h2><?= $rowUlasan['nama_user'] ?></h2>
                                    </div>
                                    <div class="date">
                                        <p><?= $rowUlasan['tanggal'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                }

                ?>
            </div>
        </div>
    </section>
    <!-- Lokasi Kami Section -->
    <section class="lokasi-kami">
        <div class="lokasi-container">
            <div class="lokasi-text" data-aos="fade-up" data-aos-offset="100" data-aos-delay="100">
                <h2>Lokasi Kami</h2>
                <p>Kami berlokasi di tempat yang mudah dijangkau dan strategis, sehingga memudahkan Anda untuk berkunjung langsung ke tempat kami. Dengan fasilitas yang lengkap dan lingkungan yang nyaman, kami siap melayani Anda dengan sepenuh hati. Jangan ragu untuk datang dan temui kami secara langsung!</p>
            </div>
            <div class="lokasi-map" data-aos="fade-up" data-aos-offset="100" data-aos-delay="400">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d994.5599586228312!2d99.20857008319138!3d3.2943665068116164!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sid!2sid!4v1747205865532!5m2!1sid!2sid"
                    width="100%"
                    height="300"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </section>
    <?php include 'footer.php' ?>
    <script src="asset/js/script.js"></script>
    <script src="node_modules/aos/dist/aos.js"></script>
    <script>
        AOS.init({
            once : true,
            duration : 1200,
        });
    </script>
</body>

</html>