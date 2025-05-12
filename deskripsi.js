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

