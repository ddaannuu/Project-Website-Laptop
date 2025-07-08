<template>
  <footer class="footer">
    <div class="footer-container"id="contact">
      <div class="footer-left">
        <div class="brand">
          <img src="../assets/Images/Logo.jpeg" alt="Logo Technologia" class="brand-logo" />
          <span class="brand-name">Technologia</span>
        </div>
        <p class="brand-description">
          Selamat datang di Technologia, sumber terpercaya Anda untuk segala hal tentang laptop!
          Kami hadir untuk membantu Anda memahami dunia teknologi yang terus berkembang,
          khususnya dalam hal perangkat laptop. Di sini, Anda akan menemukan review mendalam,
          perbandingan produk, panduan pembelian, hingga tips dan trik yang berguna untuk menunjang
          produktivitas dan pengalaman komputasi Anda.
        </p>
      </div>

    
      <div class="footer-right">
        <h3 class="github-title">
          <img src="/Images/github.png" alt="GitHub Logo" class="github-icon" />
          Our GitHub
        </h3>
        <div class="github-main-link">
          <a href="https://github.com/ddaannuu/Project-Website-Laptop" target="_blank">GitHub Team</a>
        </div>

       
        <ul class="github-list">
          <li>
            <strong>Rifky Danu Asmoro</strong><br />
            <a href="https://github.com/ddaannuu" target="_blank">ddaannuu</a>
          </li>
          <li>
            <strong>I Made Baskara Saccid Ananda</strong><br />
            <a href="https://github.com/baskara19" target="_blank">baskara19</a>
          </li>
          <li>
            <strong>Vianda Retnaningtiyas Purbandari Karetji</strong><br />
            <a href="https://github.com/viandakaretji" target="_blank">viandakaretji</a>
          </li>
          <li>
            <strong>Farhan Ardiansyah</strong><br />
            <a href="https://github.com/faanns1" target="_blank">faanns1</a>
          </li>
          <li>
            <strong>Stefanus Arya Bayu Samudra Bataona</strong><br />
            <a href="https://github.com/aryaa245" target="_blank">aryaa245</a>
          </li>
        </ul>
      </div>

    </div>
  </footer>
</template>

<style scoped>
.footer {
  background-color: #000;
  color: #fff;
  padding: 40px 20px;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.footer-container {
  max-width: 1200px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  gap: 40px;
}

.footer-left,
.footer-right {
  flex: 1;
}

.brand {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
}

.brand-logo {
  width: 50px;
  height: 50px;
  object-fit: cover;
  margin-right: 15px;
  border-radius: 50%; /* Membuat logo jadi bulat */
}

.brand-name {
  font-size: 24px;
  font-weight: 600;
}

.brand-description {
  color: #ccc;
  line-height: 1.6;
  text-align: justify;
}

.github-title {
  font-size: 24px;
  font-weight: 700;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  gap: 10px;
  justify-content: flex-start;
}

.github-icon {
  width: 24px;
  height: 24px;
}

.github-main-link {
  margin-bottom: 16px;
}

.github-main-link a {
  color: #4da3ff;
  font-weight: 500;
  text-decoration: none;
}

.github-main-link a:hover {
  text-decoration: underline;
}

.github-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.github-list li {
  margin-bottom: 14px;
  line-height: 1.4;
}

.github-list a {
  color: #4da3ff;
  text-decoration: none;
}

.github-list a:hover {
  text-decoration: underline;
}

@media (min-width: 768px) {
  .footer-container {
    flex-direction: row;
    justify-content: space-between;
    align-items: flex-start;
  }

  .footer-right {
    max-width: 35%;
    text-align: right;
    padding-right: 10px;
  }

  .github-list li {
    text-align: right;
  }

  .github-title {
    justify-content: flex-end;
  }

  .github-main-link {
    text-align: right;
  }
}
</style>
