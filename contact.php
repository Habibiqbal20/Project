<?php
session_start();
include 'data/function.php';
if (isset($_POST['submit'])) {
    if (contactUs($_POST) > 0) {
        $_SESSION['notif'] = [
            'title' => 'success',
            'text' => 'Saran anda sudah diteruskan ke admin'
        ];
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
    <title>Contact</title>
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
                    <li><a href="" class="active">Contact</a></li>
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
    <section class="main-hero-contact">
        <div class="hero-content">
            <div class="content">
                <h1>Contact Us</h1>
            </div>
        </div>
        <div class="contact">
            <div class="contact-img">
                <img src="asset/images/product/_MG_6716.JPG" alt="Image 3">
            </div>
        </div>
    </section>
    <section class="main-contact">
        <div class="content">
            <div class="contact">
                <div class="heading">
                    <h2>Punya Saran?</h2>
                    <p>Kami disini untuk anda! Apa yang bisa kami bantu?</p>
                </div>
                <div class="form">
                    <form action="" method="post">
                        <div class="name">
                            <label for="nama">Nama :</label>
                            <input type="text" name="nama" id="nama" placeholder="Nama" required>
                        </div>
                        <div class="WhatsApp">
                            <label for="email">No Hp/WhatsApp :</label>
                            <input type="number" name="WhatsApp" id="WhatsApp" placeholder="No Hp/WhatsApp" required>
                        </div>
                        <div class="pesan">
                            <label for="pesan">Masukan Anda :</label>
                            <textarea class="textarea" name="saran" id="pesan" cols="30" rows="10" placeholder="Masukan Anda" required></textarea>
                        </div>
                        <div class="submit">
                            <button type="submit" name="submit">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="follow-us">
                <div class="heading">
                    <h2>Ikuti Kami di</h2>
                </div>
                <div class="follow-us-content">
                    <div class="social-media">
                        <div class="heading">
                            <h2>Sosial Media</h2>
                        </div>
                        <div class="instagram">
                            <a href="https://www.instagram.com/tesyalobsterfarm/" target="_blank">
                                <img src="asset/images/instagram.png" alt="">
                                <p>@tesyalobsterfarm</p>
                            </a>
                        </div>
                        <div class="tiktok">
                            <a href="https://www.tiktok.com/@tesyalobfarm" target="_blank">
                                <img src="asset/images/tiktok.png" alt="">
                                <p>@tesyalobfarm</p>
                            </a>
                        </div>
                    </div>
                    <div class="informasi">
                        <div class="heading">
                            <h2>Kontak Kami</h2>
                        </div>
                        <div class="alamat">
                            <a href="https://maps.app.goo.gl/zVocLfWkD5NjDWAy6" target="_blank">
                                <img src="asset/images/—Pngtree—colored location line vector single_5099910.png" alt="">
                                <p>Kuta Pinang, Tebing Syahbandar (Klik Untuk Melihat Lokasi)</p>
                            </a>
                        </div>
                        <?php
                        $sqlAdmin = "SELECT * FROM admin";
                        $resultAdmin = $conn->query($sqlAdmin);

                        if( $resultAdmin->num_rows > 0 ) {
                            if( $rowAdmin = $resultAdmin->fetch_assoc() ) {
                        ?>
                        <div class="alamat">
                            <a href="https://wa.me/+62<?=substr($rowAdmin['no_telp'], 1)?>" target="_blank">
                                <img src="asset/images/whatsapp.png" alt="">
                                <p><?=$rowAdmin['no_telp']?></p>
                            </a>
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
    <?php include 'footer.php'?>
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
    <script src="asset/js/script.js"></script>
</body>

</html>