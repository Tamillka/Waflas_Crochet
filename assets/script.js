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

  updateArrows(); // Sākotnējā bultiņu pārbaude
}

// Atrodam visas pogas, kuras atver popupus
const openBtns = document.querySelectorAll("[data-target]");
const closeBtns = document.querySelectorAll(".closeBtn");
// Pievienojam klikšķa notikumu katrai pogai
openBtns.forEach(function (btn) {
  btn.addEventListener("click", function () {
    const popup = document.querySelector(btn.dataset.target);
    if (popup) {
      popup.classList.add("popup-active");

      // Apstrādājam attēlu galeriju, ja tā eksistē popup
      const thumbnails = popup.querySelectorAll(".thumbnail");
      const mainImage = popup.querySelector(".large-image");

      if (thumbnails.length > 0 && mainImage) {
        thumbnails.forEach((thumbnail) => {
          thumbnail.addEventListener("click", function () {
            const largeImageSrc = thumbnail.getAttribute("data-large");
            mainImage.src = largeImageSrc;

            // Noņemam 'active' klasi visiem sīktēliem
            thumbnails.forEach((thumb) => thumb.classList.remove("active"));

            // Pievienojam 'active' klasi noklikšķinātajam sīktēlam
            thumbnail.classList.add("active");
          });
        });
      }
    }
  });

  // Aizveram popup, kad klikšķinām uz aizvēršanas pogas
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

$(document).ready(function () {
  console.log("jQuery darbojas!");

  $("#settingButton").on("click", function () {
    $(".profileBox").toggle(); // Parāda vai paslēpj profileBox
  });

  // Paslēpj profileBox, ja klikšķis ir ārpus lodziņa vai pogas
  $(document).on("click", function (event) {
    if (!$(event.target).closest("#settingButton, .profileBox").length) {
      $(".profileBox").hide();
    }
  });

  document.querySelectorAll(".togglePassword").forEach((toggle) => {
    toggle.addEventListener("click", function () {
      const passwordField = this.previousElementSibling; // Находим соответствующее поле пароля
      const type =
        passwordField.getAttribute("type") === "password" ? "text" : "password";
      passwordField.setAttribute("type", type);

      // Toggle icon classes properly
      this.classList.toggle("fa-eye");
      this.classList.toggle("fa-eye-slash");
    });
  });
  fetchPreces();

  $("#searchInput").on("keyup", function () {
    let searchText = $(this).val().toLowerCase();
    $(".box").each(function () {
      let productName = $(this).find("h3").text().toLowerCase();

      if (productName.includes(searchText)) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });

  function fetchPreces() {
    const kategorijaId = getParameterByName("kategorija_id"); // Nolasām kategorijas ID no URL

    let url = "produkti.php";
    if (kategorijaId) {
      url += `?kategorija_id=${kategorijaId}`;
    }

    $.ajax({
      url: url,
      type: "GET",
      success: function (response) {
        const preces = JSON.parse(response);
        let template = "";
        let modali = "";

        if (preces.length === 0) {
          $("#preces-container").html(
            "<p>Nav pieejamu preču šajā kategorijā.</p>"
          );
          return;
        }

        preces.forEach((prece) => {
          // Produkta kastīte
          template += `
                            <div class='box'>
                                <img src="${prece.bilde1}">
                                <button class='btn active open-modal' data-target='#modal-${prece.id}'>Atvērt</button>
                                <h3>${prece.nosaukums}</h3>
                                <p>${prece.materials}</p>
                                <h3>${prece.cena}€</h3>
                            </div>
                        `;

          // Modālais logs
          modali += `
                            <div id='modal-${prece.id}' class='popup'>
                                <div class='popup-content'>
                                    <span class='closeBtn' data-target='#modal-${prece.id}'>&times;</span>
                                    <div class='image-gallery'>
                                        <img id='mainImage-${prece.id}' src='${prece.bilde1}' class='large-image'>
                                        <div class='thumbnails'>
                                            <img src='${prece.bilde1}' class='thumbnail active' data-large='${prece.bilde1}' data-main='mainImage-${prece.id}'>
                                            <img src='${prece.bilde2}' class='thumbnail' data-large='${prece.bilde2}' data-main='mainImage-${prece.id}'>
                                            <img src='${prece.bilde3}' class='thumbnail' data-large='${prece.bilde3}' data-main='mainImage-${prece.id}'>
                                        </div>
                                    </div>
                                    <h3>${prece.nosaukums}</h3>
                                    <p>${prece.apraksts}</p>
                                    <h3>${prece.cena}€</h3>
                                    <button class='btn'>Pievienot grozam</button>
                                </div>
                            </div>
                        `;
        });

        $("#preces-container").html(template);
        $("body").append(modali); // Pievieno modālos logus

        $(document).on("click", ".open-modal", function () {
          const target = $(this).data("target");
          $(target).addClass("popup-active");
        });

        $(document).on("click", ".closeBtn", function () {
          const target = $(this).data("target");
          $(target).removeClass("popup-active");
        });
        $(".thumbnail").on("click", function () {
          const largeImgSrc = $(this).data("large");
          const mainImgId = $(this).data("main");
          $("#" + mainImgId).attr("src", largeImgSrc);
          $(this).addClass("active").siblings().removeClass("active");
        });
      },
      error: function () {
        alert("Neizdevās ielādēt datus!");
      },
    });
  }
});
