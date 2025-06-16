<section class="footer-basic">
    <footer>
        <div class="footer-container">
            <div class="footer-class">
                <div class="about" style="text-align: center;">
                    <h3>Tesya Lobster Farm</h3>
                    <ul>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="contact.php">Contact</a></li>
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