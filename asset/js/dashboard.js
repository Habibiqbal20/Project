// Dashboard Admin
// Menangani toggle sidebar ketika tombol ☰ diklik

const sideBarHeading = document.querySelector(".sidebar-header");

sideBarHeading.addEventListener("click", function () {
  document.getElementById("sidebar").classList.toggle("open");
  //console.log('oke');
});
// Menutup sidebar jika pengguna mengklik di luar sidebar
document.addEventListener("click", function (event) {
  var sidebar = document.getElementById("sidebar");
  if (!sidebar.contains(event.target) && !sideBarHeading.contains(event.target)) {
    sidebar.classList.remove("open");
  }
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

const hapusAdmin = document.querySelectorAll('#hapusAdmin');
if (hapusAdmin) {
  hapusAdmin.forEach((linkAdmin) => {
    linkAdmin.addEventListener('click', (e) => {
      const konfirmasiAdmin = confirm('Apakah anda yakin ingin menghapus?');
      if (!konfirmasiAdmin) {
        e.preventDefault();
      }
    })
  })
}


// Dashboard Admin

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

function generateUniqueCode() {
  const prefix = "UNQ";
  const date = new Date().toISOString().slice(0, 10).replace(/-/g, "");
  const random = Math.random().toString(36).substr(2, 6).toUpperCase(); // 6 karakter acak
  return `${prefix}-${date}-${random}`;
}
document.getElementById("kodeUnik").value = generateUniqueCode();
//uniqCode End  