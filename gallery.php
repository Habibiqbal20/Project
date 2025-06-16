<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gallery Page</title>
    <link rel="stylesheet" href="asset/css/main.css" />
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
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="product.php">Product</a></li>
                    <li><a href="">Gallery</a></li>
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
    <h1 class="title">My Gallery</h1>
    <div class="gallery-wrapper">
        <div class="gallery-grid">
            <!-- Gambar -->
            <div class="gallery-item">
                <img src="asset/images/Gallery/16-18 CM.jpg" alt="Photo">
                <div class="overlay-text">Lobster 16-18 CM</div>
            </div>
            <div class="gallery-item">
                <img src="asset/images/Gallery/16-18 CM.jpg" alt="Photo">
                <div class="overlay-text">Lobster 16-18 CM</div>
            </div>
            <div class="gallery-item">
                <img src="asset/images/Gallery/14-15 CM.jpg" alt="Photo">
                <div class="overlay-text">Lobster 14-15 CM</div>
            </div>
            <div class="gallery-item">
                <img src="asset/images/Gallery/3.jpg" alt="Photo">
                <div class="overlay-text">Fakta Menarik</div>
            </div>
            <div class="gallery-item">
                <video class="hover-video" muted loop playsinline>
                    <source src="asset/images/Gallery/hasil.mp4" type="video/mp4">
                </video>
                <div class="overlay-text">Harga Lobster</div>
            </div>
            <div class="gallery-item">
                <img src="asset/images/Gallery/11-13 CM.jpg" alt="Photo">
                <div class="overlay-text">Lobster 11 13 CM</div>
            </div>
            <div class="gallery-item">
                <img src="asset/images/Gallery/2.jpg" alt="Photo">
                <div class="overlay-text">Did you know</div>
            </div>
            <div class="gallery-item">
                <video class="hover-video" muted loop playsinline>
                    <source src="asset/images/Gallery/Video 2.mp4" type="video/mp4">
                </video>
                <div class="overlay-text">Ukuran Lobster</div>
            </div>
            <div class="gallery-item">
                <img src="asset/images/Gallery/8-10 CM.jpg" alt="Photo">
                <div class="overlay-text">Lobster 8 10 CM</div>
            </div>
            <div class="gallery-item">
                <img src="asset/images/Gallery/1.jpg" alt="Photo">
                <div class="overlay-text">Did you know</div>
            </div>
            <div class="gallery-item">
                <video class="hover-video" muted loop playsinline>
                    <source src="asset/images/Gallery/Hasil Video.mp4" type="video/mp4">
                </video>
                <div class="overlay-text">Lokasi Usaha</div>
            </div>
            <div class="gallery-item">
                <img src="asset/images/Gallery/5-7 CM.jpg" alt="Photo">
                <div class="overlay-text">Lobster 5 7 CM</div>
            </div>
        </div>
    </div>



    <script>
        const videos = document.querySelectorAll('.hover-video');

        videos.forEach(video => {
            const container = video.closest('.gallery-item');

            container.addEventListener('mouseenter', () => {
                video.play();
            });

            container.addEventListener('mouseleave', () => {
                video.pause();
            });
        });
    </script>

</body>

</html>