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
  