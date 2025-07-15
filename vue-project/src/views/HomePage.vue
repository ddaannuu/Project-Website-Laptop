<template>
  <body>
    <!-- slider -->
    <div id="carouselExample" class="carousel slide carousel-fade" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
      </div>

      <div class="carousel-inner">
        <div class="carousel-item active c-item" data-bs-interval="10000">
          <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <video width="100%" height="auto" autoplay muted loop playsinline>
              <source src="../assets/video/Lenovo LEGION 2.mp4" type="video/mp4" />
              <source src="../assets/video/Lenovo LEGION 2.mp4" type="video/ogg" class="d-block w-100 c-img" alt="..." />
            </video>
          </div>
        </div>

        <div class="carousel-item active c-item" data-bs-interval="10000">
          <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <video width="100%" height="auto" autoplay muted loop playsinline>
              <source src="../assets/video/Acer.mp4" type="video/mp4" />
              <source src="../assets/video/Acer.mp4" type="video/ogg" class="d-block w-100 c-img" alt="..." />
            </video>
          </div>
        </div>
        <div class="carousel-item active c-item" data-bs-interval="10000">
          <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <video width="100%" height="auto" autoplay muted loop playsinline>
              <source src="../assets/video/Macbook.mp4" type="video/mp4" />
              <source src="../assets/video/Macbook.mp4" type="video/ogg" class="d-block w-100 c-img" alt="..." />
            </video>
          </div>
        </div>
        <div class="carousel-item active c-item" data-bs-interval="10000">
          <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <video width="100%" height="auto" autoplay muted loop playsinline>
              <source src="../assets/video/MSI.mp4" type="video/mp4" />
              <source src="../assets/video/MSI.mp4" type="video/ogg" class="d-block w-100 c-img" alt="..." />
            </video>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span></button
      >         
    </div>

    <div class="header-center" id="about-us">
      <h2 class="reveal" style="padding-top: 8rem">About Us.</h2>
    </div>

    <section class="products" id="products" style="padding-top: 7rem">
      <div class="left-top">
        <div class="product reveal">
          <img src="../assets/Images/LENOVO.png" alt="Lenovo LEGION" />
          <h2><strong>About Us</strong></h2>
          <p>
            Selamat datang di Technologia, sumber terpercaya Anda untuk segala hal tentang laptop! Kami hadir untuk membantu Anda memahami dunia teknologi yang terus berkembang, khususnya dalam hal perangkat laptop. Di sini, Anda akan
            menemukan review mendalam, perbandingan produk, panduan pembelian, hingga tips dan trik yang berguna untuk menunjang produktivitas dan pengalaman komputasi Anda.
          </p>
        </div>
        <div class="product reveal">
          <img src="../assets/Images/Lenovo LEGION.png" alt="Apple AirPods Max" />
          <h2><strong>Our Team</strong></h2>
          <p>
            Tim kami terdiri dari para penggemar teknologi dan profesional IT yang berdedikasi untuk memberikan informasi yang akurat, terbaru, dan mudah dipahami. Kami percaya bahwa memilih laptop yang tepat bukan sekadar soal spesifikasi
            tinggi, tetapi juga soal kebutuhan dan kenyamanan pengguna.
          </p>
        </div>
      </div>
      <div class="left-bottom">
        <div class="product reveal">
          <img src="../assets/Images/Popular Product.png" alt="Apple Vision Pro" />
          <h2><strong>Basis Of Formation</strong></h2>
          <p>
            Pembuatan Website ini di dasarkan untuk menyelesaikan tugas project Mata Kuliah Pemrograman Web dengan menerapkan HTML,CSS,dan JavaScript kedalamnya. Dengan tujuan membuat sebuah website yang ditujukan kepada
            pelajar/mahasiswa/pekerja untuk mendapatkan sebuah informasi mengenai laptop.
          </p>
        </div>
      </div>
      <div class="right-large">
        <div class="product right-content reveal">
          <img src="../assets/Images/Asus Zenbook 14.png" alt="ZENBOOK" />
          <h2><strong>Vision and Mission</strong></h2>
          <p>
            Tujuan kami adalah menjadi panduan Anda dalam menjelajahi berbagai pilihan laptop yang tersedia di pasaran — mulai dari perangkat untuk pelajar, pekerja profesional, hingga gamer. Kami ingin memastikan Anda membuat keputusan
            yang tepat dan cerdas sebelum membeli.
          </p>
          <h5 style="margin-top: 2rem"><strong>Terima kasih telah mengunjungi website kami. Mari jelajahi teknologi bersama!</strong></h5>
        </div>
      </div>
    </section>

    <section class="categories" id="categories">
      <div class="header-center">
        <h2 class="reveal">Browse By Category</h2>
      </div>
      <div class="category-list">
        <div class="reveal">
          <a href="Workstastion" class="category-item">
            <div class="icon">🖥️</div>
            <span>Workstation</span>
          </a>
        </div>
        <div class="reveal">
          <a href="Business" class="category-item">
            <div class="icon">💼</div>
            <span>Business</span>
          </a>
        </div>
        <div class="reveal">
          <a href="Categories" class="category-item">
            <div class="icon">🎮</div>
            <span>Gaming</span>
          </a>
        </div>
        <div class="reveal">
          <a href="VideoEditing" class="category-item">
            <div class="icon">🎞️</div>
            <span>Video Editing</span>
          </a>
        </div>
        <div class="reveal">
          <a href="Students" class="category-item">
            <div class="icon">🎓</div>
            <span>Students</span>
          </a>
        </div>
      </div>
    </section>
    <!-- Navbar Product -->

    <nav class="navbar navbar-expand-lg gi">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item nav-underline" id="#NewArriv">
              <a class="nav-link active" aria-current="page" href="#NewArriv" data-tab="newArival-tab">New Arrival</a>
            </li>
            <li class="nav-item nav-underline">
              <a class="nav-link" href="#" data-tab="BestSeller-tab">Best Seller</a>
            </li>
            <li class="nav-item nav-underline">
              <a class="nav-link" href="#" data-tab="OnSale-tab">On Sale</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- New Arrival -->
    <div class="tab-content-container">
      <div class="tab-content active" id="newArival-tab">
        <div class="product-grid" id="all-products">
          <div class="product-card discount" v-for="(product, index) in products" :key="index">
            <a :href="`/product/${product.slug}`" style="text-decoration: none; color: inherit">
              <div class="image-slide-wrapper">
                <img :src="product.image_1" :alt="product.title" class="product-img first-img" style="height: 200px; width: 280px" />
                <img :src="product.image_2 || product.image_1" :alt="product.title" class="product-img second-img" style="height: 200px; width: 280px" />
              </div>
              <h3 class="product-title">{{ product.title }}</h3>
              <p>{{ product.specs }}</p>
              <div class="price-rating">
                <span class="price"> Rp{{ formatPrice(product.price) }} </span>
              </div>
            </a>
          </div>
        </div>
      </div>

      <!-- Best Seller -->
      <div class="tab-content" id="BestSeller-tab">
        <div class="product-grid" id="all-products">
          <!-- Asus ROG Zephyrus G14 -->

       
          <div class="product-card discount" v-for="(product, index) in bestSellers" :key="index">
            <a :href="`/product/${product.slug}`" style="text-decoration: none; color: inherit">
              <div class="image-slide-wrapper">
                <img :src="product.image_1" :alt="product.title" class="product-img first-img" style="height: 200px; width: 280px" />
                <img :src="product.image_2 || product.image_1" :alt="product.title" class="product-img second-img" style="height: 200px; width: 280px" />
              </div>
              <h3 class="product-title">{{ product.title }}</h3>
              <p>{{ product.specs }}</p>
              <div class="price-rating">
                <span class="price">Rp{{ formatPrice(product.price) }}</span>
              </div>
            </a>
          </div>
        </div>
      </div>

      <!-- On Sale -->
      <div class="tab-content" id="OnSale-tab">
        <div class="product-grid" id="all-products">
           <div class="product-card discount" v-for="(product, index) in onSale" :key="index">
            <a :href="`/product/${product.slug}`" style="text-decoration: none; color: inherit">
              <div class="image-slide-wrapper">
                <img :src="product.image_1" :alt="product.title" class="product-img first-img" style="height: 200px; width: 280px" />
                <img :src="product.image_2 || product.image_1" :alt="product.title" class="product-img second-img" style="height: 200px; width: 280px" />
              </div>
              <h3 class="product-title">{{ product.title }}</h3>
              <p>{{ product.specs }}</p>
              <div class="price-rating">
                <span class="price">Rp{{ formatPrice(product.price) }}</span>
              </div>
            </a>
          </div>
        </div>
        
      </div>
    </div>

    <section class="hero">
      <div class="container py-5">
        <div class="header-center">
          <h2 class="reveal">Profil Anggota</h2>
        </div>
        <div class="row g-4">
          <div class="profile-container">

            <div class="profile-card">
              <a href="profil_danu" style="text-decoration: none; color: inherit">
                <img src="../assets/Images/Danu.jpg" alt="Danu" class="profile-img" />
                <div class="profile-name">Rifky Danu Asmoro 23.11.5489</div>
                <div class="profile-desc">UI/UX - Front End Developper</div>
              </a>
            </div>

            <div class="profile-card">
            <a href="profil_baskara" style="text-decoration: none; color: inherit">
              <img src="../assets/Images/Baskara.jpg" alt="Baskara" class="profile-img" />
              <div class="profile-name">I Made Baskara Saccid Ananda 23.11.5466</div>
              <div class="profile-desc">UI/UX - Front End Developper</div>
            </a>
            </div>

            <div class="profile-card">
               <a href="profil_vianda" style="text-decoration: none; color: inherit">
              <img src="../assets/Images/Vianda.jpg" alt="Vianda" class="profile-img" />
              <div class="profile-name">Vianda Retnaningtiyas Purbandari Karetji 23.11.5445</div>
              <div class="profile-desc">UI/UX - Front End Developper</div>
              </a>
            </div>

            <div class="profile-card">
              <a href="profil_farhan" style="text-decoration: none; color: inherit">
              <img src="../assets/Images/Farhan.jpg" alt="Farhan" class="profile-img" />
              <div class="profile-name">Farhan Ardiansyah 23.11.5464</div>
              <div class="profile-desc">UI- Front End Developper</div>
              </a>
            </div>

            <div class="profile-card">
               <a href="profil_arya" style="text-decoration: none; color: inherit">
              <img src="../assets/Images/Aryo.jpg" alt="Aryo" class="profile-img" />
              <div class="profile-name">Stefanus Arya Bayu Samudra Bataona 23.11.5477</div>
              <div class="profile-desc">UI/UX - Front End Developper</div>
              </a>
            </div>


          </div>
        </div>
      </div>
    </section>
  </body>
</template>

<script>
export default {
  name: "HomePage",
  data() {
    return {
      products: [],
      bestSellers: [],
      onSale : [],
    };
  },
  methods: {
    formatPrice(value) {
      return parseInt(value).toLocaleString("id-ID");
    },
  },
  async created() {
    try {
      const res = await fetch("http://localhost/technologia/CI3/index.php/product_api/get_new_arrival");
      const data = await res.json();
      if (!data.error) {
        this.products = data;
      } else {
        console.error(data.error);
      }
    } catch (err) {
      console.error("Gagal mengambil produk:", err);
    }
    try {
      const res = await fetch("http://localhost/technologia/CI3/index.php/product_api/get_best_seller");
      const data = await res.json();
      if (!data.error) {
        this.bestSellers = data;
      } else {
        console.error(data.error);
      }
    } catch (err) {
      console.error("Gagal mengambil produk:", err);
    }
     try {
      const res = await fetch("http://localhost/technologia/CI3/index.php/product_api/get_on_sale");
      const data = await res.json();
      if (!data.error) {
        this.onSale = data;
      } else {
        console.error(data.error);
      }
    } catch (err) {
      console.error("Gagal mengambil produk:", err);
    }
  },

  mounted() {
    const tabLinks = document.querySelectorAll(".nav-link[data-tab]");
    const tabContents = document.querySelectorAll(".tab-content");

    tabLinks.forEach((link) => {
      link.addEventListener("click", function (e) {
        e.preventDefault();

        tabLinks.forEach((link) => link.classList.remove("active"));
        tabContents.forEach((content) => content.classList.remove("active"));

        this.classList.add("active");
        const tabId = this.getAttribute("data-tab");
        document.getElementById(tabId).classList.add("active");
      });
    });

    const revealElements = document.querySelectorAll(".reveal");

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            const index = Array.from(revealElements).indexOf(entry.target);
            entry.target.style.transitionDelay = `${index * 80}ms`;
            entry.target.classList.add("active");
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.1 }
    );

    revealElements.forEach((el) => {
      observer.observe(el);
    });
  },
};
</script>

<style>
.product-card {
  width: 100%;
  overflow: hidden;
  border-radius: 8px;
}

.image-slide-wrapper {
  position: relative;
  width: 100%;
  padding-top: 70%; /* kotak tetap */
  overflow: hidden;
  border-radius: 8px;
  background: #f9f9f9;
}

.product-img {
  position: absolute;
  top: 50%;
  left: 50%;
  max-width: 100%;
  max-height: 100%;
  width: auto;
  height: auto;
  transform: translate(-50%, -50%);
  object-fit: contain;
  object-position: center;
  transition: transform 0.4s ease-in-out;
  display: block;
  margin: 0;
  padding: 0;
  border: none;
}

/* Hover effect */
.first-img {
  z-index: 2;
  transform: translate(-50%, -50%) translateX(0);
}

.second-img {
  z-index: 1;
  transform: translate(-50%, -50%) translateX(100%);
}

.product-card:hover .first-img {
  transform: translate(-50%, -50%) translateX(-100%);
}

.product-card:hover .second-img {
  transform: translate(-50%, -50%) translateX(0);
}
</style>
