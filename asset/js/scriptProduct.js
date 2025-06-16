//Ubah Gambar Start
const productPage = document.getElementsByClassName('kolom-produk"')
const mainPhoto = document.getElementById('main-photo');
const thumbnails = document.querySelectorAll('.thumbnail');

if (productPage) {
  thumbnails.forEach(thumbnail => {
    thumbnail.addEventListener('click', function () {
      // Animasi fade out
      mainPhoto.style.opacity = 0;

      setTimeout(() => {
        // Setelah 300ms, tukar gambar
        let tempSrc = mainPhoto.src;
        mainPhoto.src = this.src;
        this.src = tempSrc;

        // Animasi fade in
        mainPhoto.style.opacity = 1;
      }, 300);
    });
  });

  //Ubah Gambar End


  //Modal Gambar Start

  const modal = document.getElementById("image-modal");
  const modalImg = document.getElementById("modal-img");
  const mainImage = document.getElementById("main-photo");
  const closeBtn = document.querySelector(".close");

  mainImage.onclick = function () {
    modal.style.display = "flex";
    modalImg.src = this.src;
  };

  closeBtn.onclick = function () {
    modal.style.display = "none";
  };

  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };

  //Modal Gambar End


  //Preview Foto Start

  const fileInput = document.getElementById('file-input');
  const preview = document.getElementById('preview');

  fileInput.addEventListener('change', function () {
    preview.innerHTML = ''; // Hapus semua preview sebelumnya

    const files = Array.from(this.files);
    if (!files.length) return;

    files.forEach((file, index) => {
      const reader = new FileReader();
      reader.onload = function (e) {
        const wrapper = document.createElement('div');
        wrapper.className = 'image-wrapper';

        const img = document.createElement('img');
        img.src = e.target.result;

        const buttons = document.createElement('div');
        buttons.className = 'overlay-buttons';

        const delBtn = document.createElement('button');
        delBtn.textContent = '❌';
        delBtn.onclick = () => {
          wrapper.remove();
          removeFile(index);
        };

        buttons.appendChild(delBtn);
        wrapper.appendChild(img);
        wrapper.appendChild(buttons);
        preview.appendChild(wrapper);
      };
      reader.readAsDataURL(file);
    });
  });

  // Optional: Menghapus file dari input (karena input.files bersifat read-only)
  function removeFile(indexToRemove) {
    const dt = new DataTransfer();
    const files = Array.from(fileInput.files);
    files.forEach((file, index) => {
      if (index !== indexToRemove) {
        dt.items.add(file);
      }
    });
    fileInput.files = dt.files;
  }
  //Preview Foto End



  //Rating Start
  const range = document.getElementById('rating');
  const ratingStars = document.getElementById('rating-stars');
  const ratingNumber = document.getElementById('rating-number');

  function updateRatingDisplay(value) {
    // Tampilkan bintang
    ratingStars.textContent = '⭐️'.repeat(value);

    // Tampilkan angka saat slider digerakkan
    ratingNumber.style.display = 'block';
    ratingNumber.textContent = `${value} / 5`;

    // Ubah warna slider berdasarkan nilai
    let color = '';
    switch (parseInt(value)) {
      case 1: color = '#ff4d4d'; break; // merah
      case 2: color = '#ff944d'; break; // oranye
      case 3: color = '#ffcc00'; break; // kuning
      case 4: color = '#99cc00'; break; // hijau muda
      case 5: color = '#33cc33'; break; // hijau
    }

    const percentage = (value - 1) * 25;
    range.style.background = `linear-gradient(to right, ${color} 0%, ${color} ${percentage}%, #ddd ${percentage}%, #ddd 100%)`;
  }

  range.addEventListener('input', () => {
    updateRatingDisplay(range.value);
  });
  // Inisialisasi
  updateRatingDisplay(range.value);
  //Rating End


  
  //uniqCode Start
  function generateUniqueCode() {
    const prefix = "UNQ";
    const date = new Date().toISOString().slice(0, 10).replace(/-/g, "");
    const random = Math.random().toString(36).substr(2, 6).toUpperCase(); // 6 karakter acak
    return `${prefix}-${date}-${random}`;
  }
  document.getElementById("kodeUnik").value = generateUniqueCode();
  //uniqCode End  
}

const whatsApp = document.getElementById('whatsapp');
whatsApp.addEventListener('click', () => {
  const nomor = whatsApp.dataset.admin;
  const barang = whatsApp.dataset.barang;
  const harga = whatsApp.dataset.harga;
  const pesan = `Halo, saya ingin memesan:\n\nProduk: ${barang}\nHarga Rp. ${harga}\nApakah masih tersedia?`;
  const link = `https://wa.me/+62${nomor}?text=${encodeURIComponent(pesan)}`;
  window.open(link, "_blank");
})

const balasButtons = document.querySelectorAll('#balas');
const forms = document.querySelectorAll('#form');

balasButtons.forEach((button, index) => {
  button.addEventListener('click', () => {
    console.log('oke');
    forms[index].classList.toggle('display');
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const tombolHapus = document.querySelectorAll("#hapus");

  tombolHapus.forEach(function (tombol) {
    tombol.addEventListener("click", function (e) {
      e.preventDefault(); // Cegah langsung pindah halaman
      const url = this.getAttribute("href");

      Swal.fire({
        title: "Apakah kamu yakin?",
        text: "Data akan dihapus secara permanen!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal"
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = url;
        }
      });
    });
  });
});

// const hapus = document.querySelectorAll('#hapus');
// if (hapus) {
//   hapus.forEach((link) => {
//     link.addEventListener('click', (e) => {
//       const konfirmasi = confirm('Apakah anda yakin ingin menghapus?');
//       if (!konfirmasi) {
//         e.preventDefault();
//       }
//     })
//   })
// }
