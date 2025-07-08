<template>
  <header :class="{ 'scrolled': isScrolled }">
    <button class="btn list" type="button" @click="openOffcanvas">
      <i class="bi bi-list fs-4"></i>
    </button>

    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
      <div class="offcanvas-header d-flex justify-content-between align-items-center w-100">
        <h5 class="offcanvas-title d-flex align-items-center" id="offcanvasWithBothOptionsLabel">
          <div class="logo-container d-flex align-items-center">
            <img src="../assets/Images/logo 2.png" alt="Logo" class="logo-img me-2">
            <span class="logo-text">Technologia</span>
          </div>
        </h5>

        <div class="d-flex align-items-center">
          <router-link to="/login" class="text-dark me-3" title="Login Admin">
            <i class="bi bi-person-gear fs-5"></i>
          </router-link>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
      </div>

      <div class="menu-tabs">
        <div class="menu-tab active" @click="setTab('menu')">Menu</div>
        <div class="menu-tab" @click="setTab('categories')">Categories</div>
      </div>

      <div class="menu-list" id="menuTab">
        <router-link to="/HomePage" class="menu-item" @click="closeOffcanvas">Home</router-link>
        <div class="menu-item" @click="toggleSubmenu('about')">Member Profil</div>
        <div class="submenu" v-show="activeSubmenu === 'about'">
          <div class="submenu-item" @click="goToProfile('danu')">Rifky Danu Asmoro</div>
          <div class="submenu-item" @click="goToProfile('baskara')">I Made Baskara Saccid Ananda</div>
          <div class="submenu-item" @click="goToProfile('vianda')">Vianda Retnaningtiyas Purbandari Karetji</div>
          <div class="submenu-item" @click="goToProfile('farhan')">Farhan Ardiansyah</div>
          <div class="submenu-item" @click="goToProfile('arya')">Stefanus Arya Bayu Samudra Bataona</div>
        </div>
        <a href="#" class="menu-item" @click.prevent="goToSection('#contact'); closeOffcanvas()">Contact</a>
      </div>

      <div class="menu-list" id="categoriesTab" style="display: none;">
        <router-link to="/Workstastion" class="menu-item" @click="closeOffcanvas">Workstation</router-link>
        <router-link to="/Business" class="menu-item" @click="closeOffcanvas">Business</router-link>
        <router-link to="/Categories" class="menu-item" @click="closeOffcanvas">Gaming</router-link>
        <router-link to="/VideoEditing" class="menu-item" @click="closeOffcanvas">Video Editing</router-link>
        <router-link to="/Students" class="menu-item" @click="closeOffcanvas">Students</router-link>
      </div>
    </div>

    <div class="logo-container">
      <img src="../assets/Images/logo 2.png" alt="Logo" class="logo-img">
      <span class="logo-text">Technologia</span>
    </div>

    <div class="search-container">
      <i class="bi bi-search"></i>
      <input type="text" class="search" placeholder="Search" id="searchInput" @keyup="handleSearch"/>
    </div>

    <div class="navbare">
      <nav>
        <ul>
          <li><router-link to="/HomePage#carouselExample">Home</router-link></li>
          <li><router-link to="/HomePage#about-us">About</router-link></li>
          <li><a href="#" @click.prevent="goToSection('#categories')">Category</a></li>
          <li><a href="#" @click.prevent="goToSection('#all-products')">Products</a></li>
          <li><a href="#" @click.prevent="goToSection('#contact')">Contact</a></li>
        </ul>
      </nav>
    </div>
  </header>
</template>

<script>
export default {
  name: 'AppHeader',
  data() {
    return {
      activeSubmenu: null,
      offcanvasInstance: null,
      isScrolled: false,
      products: [
        { name: 'MSI VECTOR 16HX', id: 1 },
        { name: 'Lenovo Yoga Slim 7 Aura Edition', id: 3 },
        { name: 'Asus ExpertBook P1 P1403CVA', id: 44 },
        { name: 'HP OmniBook X 14 FE0333QU', id: 67 },
        { name: 'Acer Nitro Lite NL16 71G', id: 22 },
        { name: 'MSI Prestige 16 B1VEG', id: 54 },
        { name: 'MSI Stealth 16 AI+ A3HVGG', id: 43 },
        { name: 'HP Victus 15 FA2717TX', id: 41 },
        { name: 'ASUS TUF F16 FX607VU', id: 11 }
      ]
    };
  },
  mounted() {
    this.offcanvasInstance = new bootstrap.Offcanvas(document.getElementById('offcanvasWithBothOptions'));
    document.addEventListener('click', this.handleClickOutside);
    window.addEventListener('scroll', this.checkScrollPosition);
  },
  beforeUnmount() {
    document.removeEventListener('click', this.handleClickOutside);
    window.removeEventListener('scroll', this.checkScrollPosition);
  },
  methods: {
    setTab(tab) {
      const menuTab = document.getElementById('menuTab');
      const categoriesTab = document.getElementById('categoriesTab');
      document.querySelectorAll('.menu-tab').forEach(el => el.classList.remove('active'));
      if (tab === 'menu') {
        menuTab.style.display = '';
        categoriesTab.style.display = 'none';
        document.querySelector('.menu-tab:nth-child(1)').classList.add('active');
      } else {
        menuTab.style.display = 'none';
        categoriesTab.style.display = '';
        document.querySelector('.menu-tab:nth-child(2)').classList.add('active');
      }
    },
    toggleSubmenu(menu) {
      this.activeSubmenu = this.activeSubmenu === menu ? null : menu;
    },
    goToProfile(name) {
      this.$router.push(`/Profil_${name}`);
      this.$nextTick(() => this.closeOffcanvas());
    },
    openOffcanvas() {
      if (this.offcanvasInstance) this.offcanvasInstance.show();
    },
    closeOffcanvas() {
      if (this.offcanvasInstance) this.offcanvasInstance.hide();
    },
    handleSearch(event) {
      const query = event.target.value.trim().toLowerCase();
      const productTitles = document.querySelectorAll('.product-title');
      let found = false;
      productTitles.forEach(title => {
        title.classList.remove('highlight');
        if (query && title.textContent.toLowerCase().includes(query)) {
          if (!found) {
            title.scrollIntoView({ behavior: 'smooth', block: 'center' });
            found = true;
          }
          title.classList.add('highlight');
        }
      });
      if (event.key === 'Enter') {
        const foundProduct = this.products.find(p => p.name.toLowerCase().includes(query));
        if (foundProduct) {
          this.$router.push(`/product/${foundProduct.id}`);
        } else {
          alert('Produk tidak ditemukan.');
        }
      }
    },
    handleClickOutside(e) {
      const sidebar = document.getElementById('offcanvasWithBothOptions');
      if (this.offcanvasInstance && sidebar.classList.contains('show') && !sidebar.contains(e.target) && !e.target.closest('.btn.list')) {
        this.closeOffcanvas();
      }
    },
    checkScrollPosition() {
      this.isScrolled = window.scrollY > 0;
    },
    goToSection(targetId) {
      if (this.$route.path !== '/HomePage') {
        this.$router.push('/HomePage').then(() => {
          this.$nextTick(() => {
            setTimeout(() => {
              const target = document.querySelector(targetId);
              if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 300);
          });
        });
      } else {
        const target = document.querySelector(targetId);
        if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    }
  }
};
</script>

<style scoped>
header {
  transition: background-color 0.3s ease;
  background-color: white;
}
header.scrolled {
  background-color: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(8px);
}
.product-title.highlight {
  background-color: rgb(0, 225, 255);
  padding: 5px;
  border-radius: 4px;
}
.submenu {
  padding-left: 20px;
  display: flex;
  flex-direction: column;
}
.submenu-item {
  cursor: pointer;
  padding: 6px 15px;
}
</style>
