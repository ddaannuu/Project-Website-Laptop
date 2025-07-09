<template>
  <main class="container" v-if="product">
    <section class="product-detail">
      <div class="images product-carousel-wrapper" style="max-width: 400px; margin: auto">
        <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div v-for="(img, index) in product.images" :key="index" :class="['carousel-item', { active: index === 0 }]">
              <img :src="img" class="d-block w-100" :alt="`Image ${index + 1}`" />
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
      
      


      <div class="product-info">
        <h1 style="font-weight: bold">{{ product.title }}</h1>
        <h1 style="font-weight: bold">{{ product.specs }}</h1>
        <p class="price">
          Rp{{ formatPrice(product.price) }}
          <span class="old-price" v-if="product.oldPrice">Rp{{ formatPrice(product.oldPrice) }}</span>
        </p>
        <p class="status">{{ product.status }}</p>

        <div class="cart-buttons">
          <a :href="product.buyLink" target="_blank">
            <button class="add-cart">Buy Now</button>
          </a>
        </div>

        <div class="meta">
          <p>{{ product.specs }}</p>
          <p>Category: {{ product.category.join(", ") }}</p>
          <div class="social-share">
            Share:
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-whatsapp"></i></a>
            <a href="#"><i class="bi bi-facebook"></i></a>
          </div>
        </div>
      </div>
    </section>

    <nav class="navbar navbar-expand-lg gi">
      <div class="container-fluid">
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav">
            <li class="nav-item nav-underline">
              <a href="#" class="nav-link" :class="{ active: activeTab === 'description-tab' }" @click.prevent="activeTab = 'description-tab'">Description</a>
            </li>
            <li class="nav-item nav-underline">
              <a href="#" class="nav-link" :class="{ active: activeTab === 'additional-tab' }" @click.prevent="activeTab = 'additional-tab'">Additional information</a>
            </li>
            <li class="nav-item nav-underline">
              <a href="#" class="nav-link" :class="{ active: activeTab === 'qr-tab' }" @click.prevent="activeTab = 'qr-tab'">QR Code</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    

    <div class="tab-content-container">
      <div :class="['tab-content', { active: activeTab === 'description-tab' }]" id="description-tab">
        <section class="product-description">
          <p><strong>Specification:</strong></p>
          <ul v-if="product.fullSpecs && product.fullSpecs.length">
            <li v-for="(spec, index) in product.fullSpecs" :key="index">{{ spec }}</li>
          </ul>
        </section>
      </div>

      <div :class="['tab-content', { active: activeTab === 'additional-tab' }]" id="additional-tab">
        <section>
          <h3>Additional Information</h3>
          <p>{{ product.additionalInfo }}</p>
        </section>
      </div>

      <div :class="['tab-content', { active: activeTab === 'qr-tab' }]" id="qr-tab">
        <section>
          <h3>QR Code</h3>
          <img :src="product.qrCode" alt="QR Code" style="max-width: 200px" />
          <p>Scan untuk melihat produk ini di aplikasi kami.</p>
        </section>
      </div>
    </div>

    <section class="related-products" v-if="related && related.length">
      <h2 style="text-decoration: underline">Related Products</h2>
      <div class="product-grid">
        <div v-for="product in related" :key="product.id" class="product-card discount">
          <a :href="`/product/${product.slug}`" style="text-decoration: none; color: inherit">
            <div class="image-slide-wrapper">
              <img :src="product.image_1" :alt="product.title + ' default'" class="product-img first-img" style="height: 200px; width: 280px" />
              <img :src="product.image_2 || product.image_1" :alt="product.title + ' hover'" class="product-img second-img" style="height: 200px; width: 280px" />
            </div>
            <h3>{{ product.title }}</h3>
            <p>Status: {{ product.status || "Tersedia" }}</p>
            <div class="price-rating">
              <span class="price">Rp {{ formatPrice(product.price) }}</span>
            </div>
          </a>
        </div>
      </div>
    </section>
  </main>

  <div v-else-if="error">
    <p>{{ error }}</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      product: null,
      related: [],
      error: null,
      activeTab: "description-tab",
    };
  },
  async created() {
    const slug = this.$route.params.id;
    try {
 
      const res = await fetch(`http://localhost/technologia/CI3/index.php/products/get_by_slug/${slug}`);

      const data = await res.json();

      if (data.error) {
        this.error = data.error;
      } else {
        const p = data.product;

        this.product = {
          id: p.slug,
          title: p.title,
          specs: p.specs,
          price: parseInt(p.price),
          oldPrice: parseInt(p.old_price),
          status: p.status,
          images: [p.image_1, p.image_2, p.image_3].filter(Boolean),
          buyLink: p.buy_link,
          category: p.category ? p.category.split(",") : [],
          qrCode: p.qr_code,
          fullSpecs: p.description ? p.description.split("|") : [],
          additionalInfo: "Garansi 2 tahun, Tersedia di semua cabang, Dukungan purna jual tersedia, dll.",
        };

        // Ambil related products
        this.related = data.related.map((r) => ({
          id: r.slug,
          title: r.title,
          price: parseInt(r.price),
          image_1: r.image_1,
          image_2: r.image_2,
          status: r.status,
          slug: r.slug,
        }));
      }
    } catch (err) {
      this.error = "Gagal mengambil data produk.";
      console.error(err);
    }
  },
  methods: {
    formatPrice(value) {
      return parseInt(value).toLocaleString("id-ID");
    },
  },
};
</script>

<style>
body {
  font-family: "Inter", sans-serif;
  margin: 0;
  padding: 0;
  background: #fff;
  color: #222;
}

header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 40px;
  background-color: white;
  border-bottom: 1px solid #ddd;
  position: fixed;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: background-color 0.3s ease, backdrop-filter 0.3s ease;
  z-index: 1000;
  backdrop-filter: none;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 1000;
}

.tab-content {
  display: none;
}
.tab-content.active {
  display: block;
}

header.scrolled {
  background-color: rgba(255, 255, 255, 0.7); /* semi transparan */
  backdrop-filter: blur(10px); /* efek blur */
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.reveal {
  opacity: 0;
  transform: translateY(50px);
  transition: all 0.6s ease-out;
}

.reveal.active {
  opacity: 1;
  transform: translateY(0);
}

.offcanvas {
  height: 100vh; /* Mengisi seluruh tinggi viewport */
  overflow-y: auto; /* Memungkinkan scroll vertikal jika konten melebihi tinggi */
}

.sidebar {
  position: fixed;
  top: 0;
  left: -300px;
  width: 300px;
  height: 100%;
  background: #fff;
  padding: 20px;
  box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
  transition: left 0.3s ease;
  z-index: 10;
}

.sidebar.open {
  left: 0;
}

.menu-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.menu-tabs {
  display: flex;
  margin-top: 20px;
  border-bottom: 1px solid #ccc;
}

.menu-tab {
  flex: 1;
  text-align: center;
  padding: 10px 0;
  cursor: pointer;
  font-weight: bold;
}

.menu-tab.active {
  color: rgb(0, 174, 255);
  border-bottom: 3px solid rgb(0, 174, 255);
}

.menu-list {
  margin-top: 20px;
}

.menu-item {
  padding: 12px 0;
  border-bottom: 1px solid #eee;
  display: flex;
  justify-content: space-between;
  cursor: pointer;
}

.menu-item.highlight {
  color: rgb(0, 174, 255);
  font-weight: bold;
}

.submenu {
  padding-left: 15px;
  display: none;
  font-size: 14px;
  color: #666;
}

/* Burger menu button */
.burger {
  font-size: 24px;
  padding: 10px;
  cursor: pointer;
  position: fixed;
  top: 10px;
  left: 10px;
  z-index: 11;
  background: white;
  border-radius: 5px;
}

.list {
  background-color: transparent;
}
.logo {
  font-size: 20px;
  font-weight: bold;
  color: black;
}

nav ul {
  list-style-type: none;
  display: flex;
  padding-top: 15px;
}

nav ul li {
  margin: 0 15px;
  font-size: 17px;
}

nav ul li a:hover {
  color: rgb(0, 174, 255);
  background-color: transparent;
  border-radius: 5px;
  transition: color 0.3s ease-in-out, background-color 0.3s ease-in-out;
}

nav a {
  text-decoration: none;
  color: black;
  margin-left: 20px;
  font-weight: 500;
}

.search-container {
  position: relative;
  width: 450px;
}

.search-container i {
  position: absolute;
  left: 10px;
  top: 50%;
  transform: translateY(-50%);
  color: #aaa;
  font-size: 16px;
}

.search-container input {
  width: 100%;
  padding: 10px 10px 10px 35px;
  font-size: 14px;
}

.search {
  height: 50px;
  width: 500px;
  border-radius: 1px;
  border: 0px solid #ccc;
  background-color: #f5f5f5;
  font-size: 14px;
  color: rgba(0, 0, 0, 0.5);
}

.container {
  width: 90%;
  max-width: 1200px;
  margin: 20px auto;
  padding-top: 5rem;
}

.breadcrumb {
  font-size: 14px;
  color: #f9f9f9;
}

.product-detail {
  display: flex;
  gap: 40px;
  margin-top: 30px;
}

.images {
  flex: 1;
}

.images .main-img {
  width: 100%;
  max-width: 400px;
  border-radius: 8px;
}

.thumbnails {
  display: flex;
  gap: 10px;
  margin-top: 10px;
}

.thumbnails img {
  width: 60px;
  height: 60px;
  object-fit: cover;
  border: 1px solid #ccc;
  border-radius: 6px;
}

.product-info {
  flex: 2;
  font-weight: bold;
}

.product-info h1 {
  font-size: 24px;
  margin-bottom: 10px;
}

.price {
  font-size: 20px;
  font-weight: bold;
  color: #e53935;
}

.old-price {
  text-decoration: line-through;
  color: #999;
  font-size: 14px;
  margin-left: 10px;
}

.status {
  margin-top: 10px;
  color: #27ae60;
}

.stock-info label {
  display: block;
  margin: 10px 0;
}

.cart-buttons {
  margin-top: 20px;
  transition: transform 0.2s ease-in-out;
}

.cart-buttons button {
  padding: 10px 20px;
  margin-right: 10px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
.cart-buttons:hover {
  transform: translateY(-5px);
}

.add-cart {
  background-color: rgb(0, 162, 255);
  color: white;
}

.buy-now {
  background-color: #795548;
  color: white;
}

.meta {
  margin-top: 20px;
  font-size: 17px;
  color: #555;
}

.tabs {
  margin-top: 40px;
  display: flex;
  gap: 10px;
}

.tabs button {
  padding: 10px 15px;
  border: 1px solid #ccc;
  background: #f8f8f8;
  cursor: pointer;
}

.product-description {
  margin-top: 20px;
}

.product-description ul {
  padding-left: 20px;
}

.related-products {
  margin-top: 40px;
}

.related-products h2 {
  font-size: 20px;
  margin-bottom: 20px;
}

.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
  gap: 20px;
  padding: 21px;
}

.product-card {
  background: white;
  padding: 15px;
  border-radius: 8px;
  position: relative;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.2s ease;
}
.product-card:hover {
  transform: translateY(-5px);
}

.product-card img {
  width: 100%;
  height: 180px;
  object-fit: cover;
  border-radius: 4px;
}

.product-card p {
  margin: 10px 0 5px;
  font-size: 14px;
}

.product-card span {
  color: #e53935;
  font-weight: bold;
}

.tab-content-container {
  margin-top: 20px;
}

.tab-content {
  display: none;
}

.tab-content.active {
  display: block;
}

.image-slide-wrapper {
  position: relative;
  width: 280px;
  height: 200px;
  overflow: hidden;
}

.product-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  position: absolute;
  top: 0;
  left: 0;
  transition: transform 0.5s ease-in-out;
}

.image-slide-wrapper {
  position: relative;
  width: 280px;
  height: 200px;
  overflow: hidden;
}
g .product-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  position: absolute;
  top: 0;
  left: 0;
  transition: transform 0.5s ease-in-out;
}

.second-img {
  transform: translateX(100%);
  z-index: 1;
}

.first-img {
  transform: translateX(0%);
  z-index: 2;
}

.product-card:hover .first-img {
  transform: translateX(-100%);
}

.product-card:hover .second-img {
  transform: translateX(0%);
}

.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 20px;
  padding: 20px;
}

.product-card {
  background: white;
  padding: 15px;
  border-radius: 8px;
  position: relative;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.2s ease;
}

.product-card:hover {
  transform: translateY(-5px);
}

.product-card img {
  width: 100%;
  height: 180px;
  object-fit: cover;
  border-radius: 4px;
}

.product-card h3 {
  font-size: 16px;
  margin: 10px 0 5px;
}

.product-card p {
  font-size: 14px;
  color: #555;
}

.logo-img {
  height: 30px;
  width: auto;
  object-fit: contain;
}

.logo-text {
  font-weight: bold;
  font-size: 18px;
  color: #000;
}
</style>
