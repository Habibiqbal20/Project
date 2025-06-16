<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/css/main.css">
    <link rel="stylesheet" href="node_modules/aos/dist/aos.css">
    <title>About Us</title>
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
                    <li><a href="" class="active">About</a></li>
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

    <section class="main-hero-about-us">
        <div class="hero-content">
            <div class="content">
                <h1 class="brand" data-aos="fade-right">Selamat Datang di <p>Tesya Lobster Farm</p>
                </h1>
                <P class="p" data-aos="fade-left">Selamat datang di Tesya Lobster Farm, tempat terbaik untuk mendapatkan lobster air tawar berkualitas tinggi! Kami berdedikasi untuk menyediakan lobster air tawar yang sehat, segar, dan berkualitas.

                    Dengan pengalaman dan keahlian di bidang budidaya lobster, kami memastikan setiap lobster dipelihara dengan penuh perhatian dan dalam kondisi lingkungan yang terjaga.</P>
            </div>
        </div>
        <div class="about-us">
            <div class="about-us-img">
                <img src="asset/images/product/_MG_6716.JPG" alt="Image 3">
            </div>
        </div>
    </section>
    <section class="main-about-us">
        <div class="content">
            <div class="who-we-are" data-aos="fade-right">
                <div class="heading">
                    <h2>Siapa Kami</h3>
                </div>
                <div class="text">
                    <p>Selamat datang di Tesya Lobster Farm, tempat terbaik untuk mendapatkan lobster air tawar berkualitas tinggi! Kami berdedikasi untuk menyediakan lobster air tawar yang sehat, segar, dan berkualitas.</p>
                    <p>Dengan pengalaman dan keahlian di bidang budidaya lobster, kami memastikan setiap lobster dipelihara dengan penuh perhatian dan dalam kondisi lingkungan terbaik.</p>
                    <p>Di Tesya Lobster Farm, kami juga berkomitmen untuk mengedukasi masyarakat tentang pentingnya budidaya berkelanjutan, menjaga lingkungan, dan mendukung keberlanjutan sektor perikanan lokal. Terima kasih telah mempercayai kami untuk memenuhi kebutuhan lobster air tawar Anda!</p>
                </div>
            </div>
            <div class="why-choose-us" data-aos="fade-left" data-aos-offset="350">
                <div class="heading">
                    <h2>Kenapa Memilih Kami</h3>
                </div>
                <div class="text">
                    <p>Selamat datang di Tesya Lobster Farm, tempat terbaik untuk mendapatkan lobster air tawar berkualitas tinggi! Kami berdedikasi untuk menyediakan lobster air tawar yang sehat, segar, dan berkualitas.</p>
                    <p>Dengan pengalaman dan keahlian di bidang budidaya lobster, kami memastikan setiap lobster dipelihara dengan penuh perhatian dan dalam kondisi lingkungan terbaik.</p>
                    <p>Di Tesya Lobster Farm, kami juga berkomitmen untuk mengedukasi masyarakat tentang pentingnya budidaya berkelanjutan, menjaga lingkungan, dan mendukung keberlanjutan sektor perikanan lokal. Terima kasih telah mempercayai kami untuk memenuhi kebutuhan lobster air tawar Anda!</p>
                </div>
            </div>
        </div>
    </section>
    <section class="services-about">
        <div class="quality" id="quality" data-aos="fade-up">
            <div class="heading">
                <h2>Kualitas Terbaik</h2>
            </div>
            <div class="content left">
                <div class="image">
                    <img src="asset/images/service/premium quality product guaranteed-2.png" alt="">
                </div>
                <div class="text">
                    <p>Lobster air tawar dengan kualitas terbaik serta layanan pelanggan pelatihan yang ramah dengan harga yang terjangkau dan ramah di kantong.</p>
                    <p>Kami menjamin kesehatan setiap lobster dengan proses seleksi yang ketat dan perawatan profesional. Didukung oleh sistem pengiriman yang aman dan cepat, produk kami selalu sampai dalam kondisi prima. Kepuasan pelanggan adalah prioritas utama kami, mulai dari pemesanan hingga pendampingan budidaya.</p>
                    <p>Bergabunglah bersama pelanggan kami di seluruh Indonesia yang telah merasakan manfaat dan kualitas dari layanan kami.</p>
                </div>
            </div>
        </div>
        <div class="course" id="course" data-aos="fade-left">
            <div class="heading">
                <h2>Pelatihan Budidaya</h2>
            </div>
            <div class="content right">
                <div class="text">
                    <p>
                    Selain menjual lobster, kami juga memberikan kepada Anda pelatihan budidaya lobster, tentang bagaimana melakukan budidaya lobster yang baik dan benar.</p>
                    <p>Pelatihan ini mencakup panduan lengkap mulai dari pemilihan indukan, pengelolaan air, pemberian pakan, hingga pemeliharaan harian. Kami berkomitmen membantu Anda memahami setiap tahapan budidaya dengan metode yang mudah diterapkan dan berorientasi pada hasil.
                    </p>
                    <p>
                    Didampingi oleh tim berpengalaman, Anda tidak hanya membeli produk, tetapi juga mendapatkan ilmu dan dukungan berkelanjutan untuk keberhasilan usaha Anda.
                    </p>
                </div>
                <div class="image">
                    <img src="asset/images/service/training2.png" alt="">
                </div>
            </div>
        </div>
        <div class="shipping" id="shipping" data-aos="fade-right">
            <div class="heading">
                <h2>Pengiriman Cepat</h2>
            </div>
            <div class="content left">
                <div class="image">
                    <img src="asset/images/service/package-1.png" alt="">
                </div>
                <div class="text">
                    <p>Nikmati kenyamanan pengiriman cepat untuk lobster pilihan Anda. Dengan layanan terpercaya kami, lobster berkualitas tiba tepat waktu, memenuhi harapan pengiriman.
                    </p>
                    <p>
                    Kami memastikan setiap pengemasan dilakukan dengan standar terbaik untuk menjaga kualitas dan kelangsungan hidup lobster selama proses pengiriman. Didukung oleh mitra logistik yang handal, pengiriman dilakukan secara efisien ke berbagai wilayah. 
                    </p>
                    <p>
                    Kepuasan Anda adalah prioritas kami, mulai dari pemesanan hingga lobster sampai di tangan Anda dengan kondisi optimal.
                    </p>
                </div>
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