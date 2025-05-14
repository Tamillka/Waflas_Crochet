$(document).ready(function () {
  function getWordForm(n, singular, plural) {
    return n === 1 ? singular : plural;
  }

  if (typeof isLoggedIn !== "undefined" && isLoggedIn) {
    fetchPrecesGroza();
  }
  function fetchPrecesGroza() {
    $.ajax({
      url: "../admin/database/cartList.php",
      type: "GET",
      success: function (response) {
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
      "../admin/database/UpdateCartQ.php",
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
        "../admin/database/DeleteCart.php",
        { id },
        (response) => {
          if (response.success) {
            fetchPrecesGroza();
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
