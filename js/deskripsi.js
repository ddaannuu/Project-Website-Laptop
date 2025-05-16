  const tabLinks = document.querySelectorAll(".nav-link[data-tab]");
  const tabContents = document.querySelectorAll(".tab-content");

  tabLinks.forEach(link => {
    link.addEventListener("click", function (e) {
      e.preventDefault();

      tabLinks.forEach(link => link.classList.remove("active"));
      tabContents.forEach(content => content.classList.remove("active"));

      this.classList.add("active");
      const tabId = this.getAttribute("data-tab");
      document.getElementById(tabId).classList.add("active");
    });
  });

  // Burger Menu
  function toggleMenu() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    sidebar.classList.toggle('open');
    overlay.style.display = sidebar.classList.contains('open') ? 'block' : 'none';
  }

  function toggleSubmenu(id) {
    const submenu = document.getElementById(`submenu-${id}`);
    submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
  }

  function setTab(tab) {
    const menuTab = document.getElementById('menuTab');
    const categoriesTab = document.getElementById('categoriesTab');
    const tabs = document.querySelectorAll('.menu-tab');

    tabs.forEach(t => t.classList.remove('active'));

    if (tab === 'menu') {
      menuTab.style.display = 'block';
      categoriesTab.style.display = 'none';
      tabs[0].classList.add('active');
    } else {
      menuTab.style.display = 'none';
      categoriesTab.style.display = 'block';
      tabs[1].classList.add('active');
    }
  }

  //nav product  
  const tabklik = document.querySelectorAll(".nav-link[data-tab]");
  const KlikContents = document.querySelectorAll(".tab-content");

  tabLinks.forEach(link => {
    link.addEventListener("click", function (e) {
      e.preventDefault();

      tabLinks.forEach(link => link.classList.remove("active"));
      tabContents.forEach(content => content.classList.remove("active"));

      this.classList.add("active");
      const tabId = this.getAttribute("data-tab");
      document.getElementById(tabId).classList.add("active");
    });
  });

  window.addEventListener('scroll', function () {
    const header = document.querySelector('header');
    if (window.scrollY > 50) {  // jika scroll lebih dari 50px
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  });
  
  
  const revealElements = document.querySelectorAll('.reveal');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        // Dapatkan index untuk delay
        const index = Array.from(revealElements).indexOf(entry.target);
        entry.target.style.transitionDelay = `${index * 150}ms`; // 0.15s per elemen
        entry.target.classList.add('active');
        observer.unobserve(entry.target); // Optional: hanya animasi sekali
      }
    });
  }, { threshold: 0.1 });

  revealElements.forEach((el) => {
    observer.observe(el);
  });
