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

document.addEventListener("DOMContentLoaded", function () {
  const uploadBtn = document.getElementById("uploadTrigger");
  const fileInput = document.getElementById("bildeInput");

  if (uploadBtn && fileInput) {
    uploadBtn.addEventListener("click", function () {
      fileInput.click();
    });

    fileInput.addEventListener("change", function () {
      if (fileInput.files.length > 0) {
        document.getElementById("photoForm").submit();
      }
    });
  }
});

$(document).ready(function () {
  console.log("jQuery darbojas!");

  $("#settingButton").on("click", function () {
    $(".profileBox").toggle();
  });

  $(document).on("click", function (event) {
    if (!$(event.target).closest("#settingButton, .profileBox").length) {
      $(".profileBox").hide();
    }
  });

  $("#filterBtn").on("click", function () {
    $(".filterBox").toggle();
  });

  $(document).on("click", function (event) {
    if (!$(event.target).closest("#filterBtn, .filterBox").length) {
      $(".filterBox").hide();
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
  if ($("#preces-container").length > 0) {
    fetchPreces();
  }

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

  //filtru pievienošana
  $(".apply-filters").on("click", function (e) {
    e.preventDefault();

    let kartosana = $("#kartosana").val();
    let kategorija = $("select[name='kategorija']").val();
    let materiali = [];
    $("input[name='materiali[]']:checked").each(function () {
      materiali.push($(this).val());
    });

    fetchPreces(kartosana, kategorija, materiali);
  });

  // filtru atiestatīšana
  $("a:contains('Atiestatīt filtrus')").on("click", function (e) {
    e.preventDefault();

    $("select[name='kategorija']").val("");
    $("#kartosana").val("");

    $("input[name='materiali[]']").prop("checked", false);

    // $(".min-price").val(0);
    // $(".max-price").val(100);
    // $("#min-value").text("0$");
    // $("#max-value").text("100$");

    fetchPreces("", "", []);
  });

  // $(".min-price, .max-price").on("input", function () {
  //   $("#min-value").text($(".min-price").val() + "$");
  //   $("#max-value").text($(".max-price").val() + "$");
  // });

  function fetchPreces(
    kartosana = "",
    kategorija = "",
    materiali = []
    // minPrice = 0,
    // maxPrice = 100
  ) {
    const urlParams = new URLSearchParams(window.location.search);
    let kategorijaFromURL = urlParams.get("kategorija_id");

    if (!kategorija && kategorijaFromURL) {
      kategorija = kategorijaFromURL;
    }

    let url = "../produkti.php";
    let params = [];

    if (kategorija) {
      params.push(`kategorija_id=${encodeURIComponent(kategorija)}`);
    }
    if (kartosana) {
      params.push(`kartosana=${kartosana}`);
    }
    if (materiali.length > 0) {
      params.push(`materiali=${encodeURIComponent(materiali.join(","))}`);
    }
    // if (minPrice) {
    //   params.push(`minPrice=${minPrice}`);
    // }
    // if (maxPrice) {
    //   params.push(`maxPrice=${maxPrice}`);
    // }

    if (params.length > 0) {
      url += "?" + params.join("&");
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
          template += `
                            <div class='box'>
                                <img src="${prece.bilde1}">
                                <button class='btn active open-modal' data-target='#modal-${prece.id}'>Atvērt</button>
                                <h3>${prece.nosaukums}</h3>
                                <p>${prece.materials}</p>
                                <h3>${prece.cena}€</h3>
                            </div>
                        `;

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
                                    <button class='btn pievienotGrozam'>Pievienot grozam</button>
                                </div>
                            </div>
                        `;
        });

        $("#preces-container").html(template);
        $("body").append(modali);

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

  // function showNotif(teksts, tips = "success") {
  //   const notif = $("#notifikacija");
  //   const tekstsElem = $("#notifikacijas-teksts");

  //   tekstsElem.text(teksts);

  //   notif.removeClass("hidden").addClass("show");

  //   notif
  //     .find(".closeNotif")
  //     .off("click")
  //     .on("click", function () {
  //       notif.removeClass("show").addClass("hidden");
  //     });

  //   setTimeout(function () {
  //     notif.removeClass("show").addClass("hidden");
  //   }, 3000);
  // }

  $(document).on("click", ".pievienotGrozam", function () {
    let id = $(this).data("id");
    if (!id) {
      const modalId = $(this)
        .closest(".popup-content")
        .find(".closeBtn")
        .data("target");

      if (modalId) {
        id = modalId.replace("#modal-", "");
      }
    }

    const popup = $(this).closest(".popup");

    $.ajax({
      url: "../addToCart.php",
      type: "POST",
      dataType: "json", // ← обязательно!
      data: { id_prece: id },
      success: function (response) {
        if (!response.success) {
          showNotif(response.message, "error");
        } else {
          popup.removeClass("popup-active").hide();
          showNotif(response.message, "success");
        }
      },
      error: function () {
        showNotif("Neizdevās pievienot preci grozam.", "error");
      },
    });
  });

  function getWordForm(n, singular, plural) {
    return n === 1 ? singular : plural;
  }

  if (typeof isLoggedIn !== "undefined" && isLoggedIn) {
    fetchPrecesGroza();
  }
  function fetchPrecesGroza() {
    $.ajax({
      url: "../cartList.php",
      type: "GET",
      success: function (response) {
        // console.log(response);
        const preces = response;
        let template = "";
        let totalCount = 0;
        let totalSum = 0;

        if (preces.length === 0) {
          $("#precesGroza-container").html(
            "<p>Jūsu grozs ir tukšs.</p> <a href='../produkcija.php' class='btn'>Iepirkties</a>"
          );
          $(".cart em").text("(0 preces)");
          $(".total").text("0.00€");
          return;
        }
        preces.forEach((prece) => {
          totalCount += parseInt(prece.daudzums);
          totalSum += prece.kopCena;
          template += `
          <div class='cart-box' data-id="${prece.grozs_id}" data-price="${
            prece.cena
          }">
              <img src="${prece.bilde1}">
              <div class='info'>
                  <h3>${prece.nosaukums}</h3>
                  <p>Materiāls: <b>${prece.materials}</b></p>
              </div>  
              <div class="quantity-control">
                  <button class="minus">−</button>
                  <input type="text" readonly min="1" value="${
                    prece.daudzums
                  }" class="quantity-input">
                  <button class="plus">+</button>
              </div>
              <h3 class="item-total">${prece.kopCena.toFixed(2)}€</h3>
              <i class="fa-solid fa-trash grozs-delete"></i>
          </div>
        `;
        });
        $(".cart em").text(
          `(${totalCount} ${getWordForm(totalCount, "prece", "preces")})`
        );
        $("#precesGroza-container").html(template);
        $(".total").text(`${totalSum.toFixed(2)}€`);
      },
      error: function () {
        alert("Neizdevās ielādēt datus!");
      },
    });
  }

  function saveQuantity($box) {
    const id = $box.data("id");
    const quantity = parseInt($box.find(".quantity-input").val());

    $.post(
      "../UpdateCartQ.php",
      { id: id, daudzums: quantity },
      (response) => {
        if (!response.success) {
          alert("Kļūda saglabājot daudzumu: " + response.message);
        }
      },
      "json"
    );
  }

  function updateCartTotal() {
    let total = 0;
    $(".cart-box").each(function () {
      const quantity = parseInt($(this).find(".quantity-input").val());
      const price = parseFloat($(this).data("price"));
      total += quantity * price;
    });
    $(".total").text(`${total.toFixed(2)}€`);
  }

  function updateTotal($box) {
    const quantity = parseInt($box.find(".quantity-input").val());
    const unitPrice = parseFloat($box.data("price"));
    const total = (unitPrice * quantity).toFixed(2);
    $box.find(".item-total").text(`${total}€`);
  }

  $(document).on("click", ".plus", function () {
    const $box = $(this).closest(".cart-box");
    const $input = $box.find(".quantity-input");
    $input.val(parseInt($input.val()) + 1);
    updateTotal($box);
    updateCartTotal();
    saveQuantity($box);
  });

  $(document).on("click", ".minus", function () {
    const $box = $(this).closest(".cart-box");
    const $input = $box.find(".quantity-input");
    const current = parseInt($input.val());
    if (current > 1) {
      $input.val(current - 1);
      updateTotal($box);
      updateCartTotal();
      saveQuantity($box);
    }
  });

  $(document).on("click", ".grozs-delete", function () {
    if (confirm("Vai tiešām vēlies dzēst?")) {
      const $box = $(this).closest(".cart-box");
      const id = $box.data("id");

      $.post(
        "../DeleteCart.php",
        { id },
        (response) => {
          if (response.success) {
            fetchPrecesGroza(); // перезагружаем список
            showNotif(response.message);
          } else {
            alert("Kļūda dzēšot preci: " + response.message);
          }
        },
        "json"
      );
    }
  });
});
