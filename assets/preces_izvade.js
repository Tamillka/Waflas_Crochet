$(document).ready(function () {
  console.log("jQuery darbojas!");

  $("#filterBtn").on("click", function () {
    $(".filterBox").toggle();
  });

  $(document).on("click", function (event) {
    if (!$(event.target).closest("#filterBtn, .filterBox").length) {
      $(".filterBox").hide();
    }
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

    fetchPreces("", "", []);
  });

  function fetchPreces(kartosana = "", kategorija = "", materiali = []) {
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
      url: "../admin/database/addToCart.php",
      type: "POST",
      dataType: "json",
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
});
