$(document).ready(function () {
  let edit = false;

  fetchPasutijumi();

  function fetchPasutijumi() {
    $.ajax({
      url: "database/pasutijumi_list.php",
      type: "GET",
      success: function (response) {
        const pasutijumi = JSON.parse(response);
        let template = "";
        pasutijumi.forEach((pasutijums) => {
          template += `
            <tr pasut_ID="${pasutijums.id}">
              <td>${pasutijums.id}</td>
              <td>${pasutijums.vards}</td>
              <td>${pasutijums.uzvards}</td>
              <td>${pasutijums.epasts}</td>
              <td>${pasutijums.preces_skaits}</td>
              <td>${pasutijums.summa} EUR</td>
              <td>${pasutijums.statuss}</td>
              <td>${pasutijums.datums}</td>
              <td>
                <a class="pasutijums-item btn">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </a>
              </td>
            </tr>
          `;
        });
        $("#pasutijumi").html(template);
      },
      error: function () {
        // alert("Neizdevās ielādēt datus!");
      },
    });
  }

  $(document).on("click", ".pasutijums-item", (e) => {
    $("#modal-pasutijumi").css("display", "flex");

    const element = $(e.currentTarget).closest("tr");
    const id = $(element).attr("pasut_ID");

    $.post("database/pasutijums_single.php", { id }, (response) => {
      const pasutijums = JSON.parse(response);
      $("#vards").val(pasutijums.vards);
      $("#uzvards").val(pasutijums.uzvards);
      $("#epasts").val(pasutijums.epasts);
      $("#summa").val(pasutijums.summa);
      $("#statuss").val(pasutijums.statuss);
      $("#pasut_ID").val(pasutijums.id);

      edit = true;

      let produktiTemplate = "<ul>";
      pasutijums.produkti.forEach((prece) => {
        produktiTemplate += `
    <li>
      <p><span>${prece.nosaukums}</span> — 
      ${prece.vienibas_sk} gab. × ${prece.kopeja_cena} EUR <p/>
    </li>
  `;
      });
      produktiTemplate += "</ul>";
      $("#pasutijuma-produkti").html(produktiTemplate);

      const footer = `
        <p>Pasūtījums izveidots: ${pasutijums.datums}</p>
        <p>Pēdējās izmaiņas: ${pasutijums.redigesanas_datums}</p>
      `;
      $("#pasutijuma-informacija").html(footer);
    });
  });

  $(document).on("click", ".close-modal", () => {
    $(".modal").hide();
    $("#pasutijumaForma").trigger("reset");
    $("#pasutijuma-informacija").empty();
    edit = false;
  });

  $("#pasutijumaForma").submit((e) => {
    e.preventDefault();

    const postData = {
      statuss: $("#statuss").val(),
      id: $("#pasut_ID").val(),
    };

    $.ajax({
      url: "database/pasutijums_edit.php",
      type: "POST",
      data: postData,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          $(".modal").hide();
          $("#pasutijumaForma").trigger("reset");
          fetchPasutijumi();
          showNotif(response.message, "success");
          edit = false;
        } else {
          showNotif(response.message, "error");
        }
      },
      error: function () {
        showNotif("Kļūda saglabājot datus!", "error");
      },
    });
  });
});
