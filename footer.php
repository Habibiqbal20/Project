<section class="footer-basic">
    <footer>
        <div class="footer-container">
            <div class="heading">
                <h2>Tesya Lobster Farm</h2>
            </div>
            <div class="footer-class">
                <div class="aboutFooter" style="text-align: center;">
                    <h3>Tentang Kami</h3>
                    <ul>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="aboutFooter" style="text-align: center;">
                    <h3>Sosial Media Kami</h3>
                    <ul>
                        <li><a href="https://www.instagram.com/tesyalobsterfarm/" target="_blank">Instagram</a></li>
                        <li><a href="https://www.tiktok.com/@tesyalobfarm" target="_blank">Tiktok</a></li>
                        <?php
                        $sqlAdmin = "SELECT * FROM admin";
                        $resultAdmin = $conn->query($sqlAdmin);

                        if( $resultAdmin->num_rows > 0 ) {
                            if( $rowAdmin = $resultAdmin->fetch_assoc() ) {
                        ?>
                        <li><a href="https://wa.me/+62<?=substr($rowAdmin['no_telp'], 1)?>  " target="_blank">WhatsApp</a></li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="aboutFooter" style="text-align: center;">
                    <h3>Dibuat Oleh</h3>
                    <ul>
                        <li><a href="https://www.instagram.com/habib.iqbal.l/" target="_blank">Habib Iqbal</a></li>
                        <li><a href="https://www.instagram.com/aaazzz230703/" target="_blank">Anita Zahra</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <p class="copyright" id="year"></p>
    </footer>
</section>
<script>
    const id = document.getElementById('year');
    const hari = new Date();

    id.innerHTML = 'copyright ' + hari.getFullYear();
</script>