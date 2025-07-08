<template>
  <div class="profile-baskara-container">
    <div class="profile-banner">
      <img src="../assets/Images/Baskara.jpg" alt="I Made Baskara Saccid Ananda" class="profile-photo" />
      <div class="profile-name-section">
        <h1>I Made Baskara Saccid Ananda</h1>
        <p class="nim">NIM: 23.11.5466</p>
        <p class="role">UI/UX Designer & Front End Developer</p>
      </div>
    </div>

    <div class="profile-grid">
     
      <div class="card">
        <h2>✨ Tentang Saya</h2>
        <p>
          Halo! Saya Baskara, mahasiswa yang antusias dalam dunia desain antarmuka dan pengembangan front-end.
          Saya percaya bahwa desain yang baik mampu mengubah cara orang berinteraksi dengan teknologi.
        </p>
      </div>

      <div class="card">
        <h2>🛠️ Jobdesk</h2>
        <ul class="skills">
          <li>UI/UX Design</li>
          <li>HTML, CSS, JavaScript</li>
          <li>Vue.js, Tailwind CSS</li>
          <li>Wireframing & Prototyping</li>
          <li>Design Thinking</li>
        </ul>
      </div>

  
      <div class="card">
        <h2>📱 Social Media</h2>
        <div class="social-links">
          <a href="https://www.instagram.com/madebaskaraa" target="_blank" class="social-item">
            <div class="icon-circle">
              <img src="https://cdn-icons-png.flaticon.com/512/174/174855.png" alt="Instagram" />
            </div>
            <span>@madebaskaraa</span>
          </a>
          <a href="https://www.tiktok.com/laww19" target="_blank" class="social-item">
            <div class="icon-circle">
              <img src="https://cdn-icons-png.flaticon.com/512/3046/3046122.png" alt="TikTok" />
            </div>
            <span>@laww</span>
          </a>
          <a href="https://github.com/baskara19" target="_blank" class="social-item">
            <div class="icon-circle">
              <img src="https://cdn-icons-png.flaticon.com/512/733/733553.png" alt="GitHub" />
            </div>
            <span>baskara19</span>
          </a>
        </div>
      </div>

      
    </div>

    <router-link to="/" class="back-button">← Kembali ke Beranda</router-link>
  </div>
</template>

<style>
.profile-baskara-container {
  font-family: 'Segoe UI', sans-serif;
  color: #333;
  padding: 4rem 2rem;
  max-width: 1200px;
  margin: auto;
  animation: fadeIn 0.8s ease-in-out;
}


.profile-banner {
  display: flex;
  align-items: center;
  gap: 2rem;
  background: linear-gradient(to right, #69cdff94, #e0f7fa);
  padding: 2rem;
  border-radius: 1rem;
  margin-bottom: 2.5rem;
}

.profile-photo {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  object-fit: cover;
  border: 5px solid white;
  box-shadow: 0 0 15px rgba(44, 255, 237, 0.15);
}

.profile-name-section h1 {
  font-size: 1.8rem;
  margin-bottom: 0.2rem;
}

.profile-name-section p {
  margin: 0.2rem 0;
  font-size: 1rem;
}


.profile-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 2rem;
}

.card {
  background-color: #fafafa;
  border-radius: 1rem;
  padding: 1.5rem;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
  transition: transform 0.3s;
}

.card:hover {
  transform: translateY(-5px);
}


.skills {
  list-style: none;
  padding: 0;
  display: flex;
  flex-wrap: wrap;
  gap: 0.6rem;
}

.skills li {
  background-color: #f3e5f5;
  padding: 0.4rem 0.8rem;
  border-radius: 1rem;
  font-size: 0.9rem;
  font-weight: 500;
}

.social-links {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.social-item {
  display: flex;
  align-items: center;
  gap: 0.8rem;
  text-decoration: none;
  color: #333;
  font-size: 0.95rem;
}

.icon-circle {
  width: 35px;
  height: 35px;
  background-color: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 0 5px rgba(0,0,0,0.1);
}

.icon-circle img {
  width: 18px;
  height: 18px;
}


.gallery {
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
}

.gallery img {
  width: 100%;
  max-width: 200px;
  border-radius: 0.5rem;
  box-shadow: 0 0 5px rgba(0,0,0,0.1);
}


.back-button {
  display: inline-block;
  margin-top: 3rem;
  background-color: #69cdff94;
  color: white;
  padding: 0.6rem 1.5rem;
  border-radius: 8px;
  text-decoration: none;
  transition: background-color 0.3s;
}

.back-button:hover {
  background-color: #3ad8ffbb;
}


@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>