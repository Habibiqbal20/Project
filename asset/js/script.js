// Sidebar menu mulai
const menuBtn = document.querySelector('.menu-btn');
const slide = document.querySelector('.list');
menuBtn.addEventListener('click', () => {
    menuBtn.classList.toggle('cross');
});
menuBtn.addEventListener('click', () => {
    slide.classList.toggle('open');
});
window.addEventListener('resize', () => {
    if (window.matchMedia('(min-width : 800px)').matches) {
        slide.classList.remove('open');
        menuBtn.classList.remove('cross');
    }
})
document.addEventListener('click', (e) => {
    if (!menuBtn.contains(e.target) && !slide.contains(e.target)) {
        slide.classList.remove('open');
        menuBtn.classList.remove('cross');
    }
});

// Sidebar menu selesai



const indexPage = document.getElementsByClassName('main-hero');
// Button href dan scroll mulai

const login = document.getElementById("login");
const logout = document.getElementById("logout");
const readMore = document.getElementById('readMore');
const scroll = document.getElementById("scroll");
if (login) {
    login.addEventListener("click", function () {
        window.location.href = "login.php";
    });
}
if (logout) {
    logout.addEventListener("click", function () {
        window.location.href = "logout.php";
    });
}
readMore.addEventListener("click", function () {
    window.location.href = "about.php";
});
scroll.addEventListener("click", function () {
    document.getElementById("barang").scrollIntoView({
        behavior: "smooth"
    });
});

// Button href dan scroll selesai

// carousel mulai
const carousel = document.querySelector('.carousel');
const items = document.querySelectorAll('.carousel-item');
let currentIndex = 0;
const intervalTime = 5000;

function updateCarousel() {
    carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
}

function nextSlide() {
    currentIndex = (currentIndex + 1) % items.length;
    updateCarousel();
}
// Geser otomatis setiap 5 detik
let autoSlide = setInterval(nextSlide, intervalTime);
// Reset interval ketika tombol ditekan
const interval = document.querySelector('.next');
if (interval) {
    interval.addEventListener('click', () => {
        clearInterval(autoSlide);
        nextSlide();
        autoSlide = setInterval(nextSlide, intervalTime);
    });
}

const prevInterval = document.querySelector('.prev');
if (prevInterval) {
    prevInterval.addEventListener('click', () => {
        clearInterval(autoSlide);
        currentIndex = (currentIndex - 1 + items.length) % items.length;
        updateCarousel();
        autoSlide = setInterval(nextSlide, intervalTime);
    });
}
// carousel selesai