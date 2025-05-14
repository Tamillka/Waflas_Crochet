let lastScrollTop = 7;
const header = document.querySelector("header");

window.addEventListener("scroll", function () {
  let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  if (scrollTop > lastScrollTop) {
    // Scroll down
    header.style.top = "-7rem";
  } else {
    // Scroll up
    header.style.top = "0";
  }
  lastScrollTop = scrollTop;
});

document.addEventListener("DOMContentLoaded", function () {
  const animateElements = document.querySelectorAll(".animate");

  function onScroll() {
    animateElements.forEach((element) => {
      const rect = element.getBoundingClientRect();
      if (rect.top < window.innerHeight && rect.bottom > 0) {
        element.classList.add("visible");
      } else {
        element.classList.remove("visible");
      }
    });
  }

  window.addEventListener("scroll", onScroll);
  onScroll(); // Initial check on load
});

document.addEventListener("DOMContentLoaded", function () {
  const heroSection = document.querySelector("#hero");
  if (heroSection) {
    // Pārbaudām, vai #hero eksistē
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          heroSection.classList.add("in-view");
        }
      });
    });
    observer.observe(heroSection);
  }
});

document.querySelectorAll(".jautajums-bez-atb").forEach((item) => {
  item.addEventListener("click", function () {
    // Atrodam atbilstošo atbildi un ikonu
    const atbilde = this.nextElementSibling;
    const ikona = this.querySelector("i");

    // Aizveram visus pārējos atvērtos jautājumus
    document.querySelectorAll(".jautajums-bez-atb").forEach((citsItems) => {
      const citsAtbilde = citsItems.nextElementSibling;
      const citsIkona = citsItems.querySelector("i");

      if (citsItems !== this) {
        citsAtbilde.classList.remove("visible");
        citsIkona.classList.remove("rotate", "fa-minus");
        citsIkona.classList.add("fa-plus");
      }
    });

    // Pārslēdzam pašreizējā jautājuma redzamību
    atbilde.classList.toggle("visible");

    // Pārslēdzam ikonu rotāciju un zīmi
    if (ikona.classList.contains("fa-plus")) {
      ikona.classList.remove("fa-plus");
      ikona.classList.add("fa-minus");
      ikona.classList.add("rotate");
    } else {
      ikona.classList.remove("fa-minus");
      ikona.classList.add("fa-plus");
      ikona.classList.remove("rotate");
    }
  });
});

const slider = document.querySelector(".atsauksmes");
if (slider) {
  // Pārbaudām, vai slider eksistē
  const leftArrow = document.querySelector(".arrow.left");
  const rightArrow = document.querySelector(".arrow.right");
  let scrollAmount = 0;
  const scrollStep = slider.offsetWidth / 3;

  function updateArrows() {
    if (scrollAmount <= 0) {
      leftArrow.classList.add("disabled");
    } else {
      leftArrow.classList.remove("disabled");
    }

    if (scrollAmount >= slider.scrollWidth - slider.offsetWidth) {
      rightArrow.classList.add("disabled");
    } else {
      rightArrow.classList.remove("disabled");
    }
  }

  rightArrow.addEventListener("click", () => {
    if (scrollAmount < slider.scrollWidth - slider.offsetWidth) {
      scrollAmount += scrollStep;
      slider.scrollTo({
        top: 0,
        left: scrollAmount,
        behavior: "smooth",
      });
      updateArrows();
    }
  });

  leftArrow.addEventListener("click", () => {
    if (scrollAmount > 0) {
      scrollAmount -= scrollStep;
      slider.scrollTo({
        top: 0,
        left: scrollAmount,
        behavior: "smooth",
      });
      updateArrows();
    }
  });

  updateArrows();
}

const openBtns = document.querySelectorAll("[data-target]");
const closeBtns = document.querySelectorAll(".closeBtn");

openBtns.forEach(function (btn) {
  btn.addEventListener("click", function () {
    const popup = document.querySelector(btn.dataset.target);
    if (popup) {
      popup.classList.add("popup-active");

      const thumbnails = popup.querySelectorAll(".thumbnail");
      const mainImage = popup.querySelector(".large-image");

      if (thumbnails.length > 0 && mainImage) {
        thumbnails.forEach((thumbnail) => {
          thumbnail.addEventListener("click", function () {
            const largeImageSrc = thumbnail.getAttribute("data-large");
            mainImage.src = largeImageSrc;

            thumbnails.forEach((thumb) => thumb.classList.remove("active"));

            thumbnail.classList.add("active");
          });
        });
      }
    }
  });

  closeBtns.forEach(function (btn) {
    btn.addEventListener("click", function () {
      const popup = document.querySelector(btn.dataset.target);
      if (popup) {
        popup.classList.remove("popup-active");
      }
    });
  });
});

function getParameterByName(name) {
  const url = window.location.href;
  name = name.replace(/[\[\]]/g, "\\$&");
  const regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
    results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return "";
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function showNotif(teksts, tips = "success") {
  const notif = $("#notifikacija");
  const tekstsElem = $("#notifikacijas-teksts");

  tekstsElem.text(teksts);

  notif
    .removeClass("hidden show success error warning")
    .addClass("show")
    .addClass(tips);

  notif
    .find(".closeNotif")
    .off("click")
    .on("click", function () {
      notif.removeClass("show").addClass("hidden");
    });

  setTimeout(function () {
    notif.removeClass("show").addClass("hidden");
  }, 3000);
}

$(document).ready(function () {
  $("#settingButton").on("click", function () {
    $(".profileBox").toggle();
  });

  $(document).on("click", function (event) {
    if (!$(event.target).closest("#settingButton, .profileBox").length) {
      $(".profileBox").hide();
    }
  });

  document.querySelectorAll(".togglePassword").forEach((toggle) => {
    toggle.addEventListener("click", function () {
      const passwordField = this.previousElementSibling;
      const type =
        passwordField.getAttribute("type") === "password" ? "text" : "password";
      passwordField.setAttribute("type", type);

      this.classList.toggle("fa-eye");
      this.classList.toggle("fa-eye-slash");
    });
  });
});
