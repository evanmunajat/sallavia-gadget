// Ambil semua link navbar
const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

// Ambil pathname dari URL saat ini (contoh: /produk)
const currentPath = window.location.pathname;

// Loop tiap link
navLinks.forEach(link => {
  const linkPath = new URL(link.href).pathname;

  // Hapus class active dari semua
  link.classList.remove('active');

  // Kalau path-nya sama, tambahin class active
  if (linkPath === currentPath) {
    link.classList.add('active');
  }

  // Tambahkan event click supaya langsung aktif pas diklik
  link.addEventListener('click', function() {
    navLinks.forEach(l => l.classList.remove('active'));
    this.classList.add('active');
  });
});
  
  
  document.addEventListener("DOMContentLoaded", () => {
    const carousel = document.getElementById("categoryCarousel");

    // Gandakan isi carousel biar looping-nya seamless
    const clone = carousel.innerHTML;
    carousel.innerHTML += clone;

    let scrollSpeed = 0.5; // kecepatan scroll (px per frame)
    let scrollPosition = 0;

    function scroll() {
      scrollPosition += scrollSpeed;
      if (scrollPosition >= carousel.scrollWidth / 2) {
        scrollPosition = 0; // reset posisi ke awal (biar looping halus)
      }
      carousel.style.transform = `translateX(${-scrollPosition}px)`;
      requestAnimationFrame(scroll);
    }

    scroll();

    // Pause kalau dihover
    carousel.addEventListener("mouseenter", () => (scrollSpeed = 0));
    carousel.addEventListener("mouseleave", () => (scrollSpeed = 0.5));
  });


// testimoni

document.addEventListener("DOMContentLoaded", function() {
  const prevBtn = document.querySelector(".carousel-buttons .prev");
  const nextBtn = document.querySelector(".carousel-buttons .next");
  const group = document.querySelector(".testimoni-group");
  const cards = document.querySelectorAll(".card");

  const cardWidth = cards[0].offsetWidth + 16; // width + gap
  let currentIndex = 0;

  const maxIndex = cards.length - Math.floor(document.querySelector(".carousel-wrapper").offsetWidth / cardWidth);

  function updateCarousel() {
    group.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
  }

  nextBtn.addEventListener("click", () => {
    if(currentIndex < maxIndex) {
      currentIndex++;
      updateCarousel();
    }
  });

  prevBtn.addEventListener("click", () => {
    if(currentIndex > 0) {
      currentIndex--;
      updateCarousel();
    }
  });
});


// hambuger togle 
const toggler = document.querySelector('.custom-toggler');

toggler.addEventListener('click', function() {
  this.classList.toggle('active');
});


 function changeMainImage(src) {
    const mainImage = document.getElementById('mainImage');
    mainImage.style.opacity = 0;
    setTimeout(() => {
      mainImage.src = src;
      mainImage.style.opacity = 1;
    }, 200);

    // ubah border aktif
    document.querySelectorAll('.thumb-image').forEach(img => {
      img.classList.remove('active');
    });
    event.target.classList.add('active');
  }