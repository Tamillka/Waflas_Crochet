$(document).ready(function () {
  let edit = false;
  //PRODUKTI
  fetchProdukti();

  function fetchProdukti() {
    $.ajax({
      url: "database/produkti_list.php",
      type: "GET",
      success: function (response) {
        const produkti = JSON.parse(response);
        let template = "";
        produkti.forEach((produkts) => {
          template += `
                     <tr prod_ID="${produkts.id}">
                         <td>${produkts.id}</td>
                         <td>${produkts.nosaukums}</td>
                         <td> <img src="${produkts.bilde}"> </td>
                         <td>${produkts.cena} EUR</td>
                        <td>${produkts.materials}</td>
                         <td>${produkts.datums}</td>
                         
                        <td>
                             <a class="produkts-item btn"> <i class="fa fa-edit"></i></a>
                             <a class="produkts-delete btn"> <i class="fa fa-trash"></i></a>
                         </td>
                     </tr>
                  `;
        });
        $("#produkti").html(template);
      },
      error: function () {
        // alert("Neizdevās ielādēt datus!");
      },
    });
  }

  function loadKategories(selectedId = null) {
    $.ajax({
      url: "database/kategorijas_list.php",
      type: "GET",
      success: function (response) {
        const kategorijas = JSON.parse(response);
        let options =
          '<option value="" disabled selected>Izvēlēties kategoriju</option>'; // Pamatopcijas
        kategorijas.forEach((kategorija) => {
          options += `<option value="${kategorija.id}">${kategorija.nosaukums}</option>`;
        });
        $("#kategorijas-select").html(options);

        // Ja ir nodots izvēlētais ID, uzstāda to
        if (selectedId) {
          $("#kategorijas-select").val(selectedId);
        }
      },
      error: function () {
        alert("Neizdevās ielādēt kategoriju sarakstu!");
      },
    });
  }

  $(document).on("click", ".produkts-item", (e) => {
    $("#modal-produkti").css("display", "flex");

    const element = $(e.currentTarget).closest("tr");
    const id = $(element).attr("prod_ID");
    console.log(id);

    $.post("database/produkts_single.php", { id }, (response) => {
      const produkts = JSON.parse(response);
      $("#nosaukums").val(produkts.nosaukums);
      $("#materials").val(produkts.materials);
      $("#apraksts").val(produkts.apraksts);
      $("#cena").val(produkts.cena);
      $("#prod_ID").val(produkts.id);
      if (produkts.bilde1) {
        $("#preview-bilde1")
          .attr("src", `data:image/jpeg;base64,${produkts.bilde1}`)
          .show();
      }
      if (produkts.bilde2) {
        $("#preview-bilde2")
          .attr("src", `data:image/jpeg;base64,${produkts.bilde2}`)
          .show();
      }
      if (produkts.bilde3) {
        $("#preview-bilde3")
          .attr("src", `data:image/jpeg;base64,${produkts.bilde3}`)
          .show();
      }
      loadKategories(produkts.id_kategorija);

      edit = true;

      if (edit) {
        const footer = `
                <p>Produkts izveidots: ${produkts.datums}</p>
                <p>Pēdējās izmaiņas: ${produkts.redigesanas_datums}</p>
            `;
        $("#produkta-informacija").html(footer);
      }
    });
  });

  $("#bildes").on("change", function () {
    const files = this.files;

    if (files.length > 3) {
      alert("Maksimālais attēlu skaits ir 3!");
      this.value = "";
      return;
    }

    $("#preview-bilde1, #preview-bilde2, #preview-bilde3").hide();

    Array.from(files).forEach((file, index) => {
      const reader = new FileReader();
      reader.onload = function (e) {
        $(`#preview-bilde${index + 1}`)
          .attr("src", e.target.result)
          .show();
      };
      reader.readAsDataURL(file);
    });
  });

  $(document).on("click", ".close-modal", (e) => {
    $(".modal").hide();
    $("#produktaForma").trigger("reset");
    $("#produkta-informacija").empty();
    $("#preview-bilde1, #preview-bilde2, #preview-bilde3")
      .attr("src", "")
      .hide()
      .css("outline", "none");
    edit = false;
  });

  $(document).on("click", "#new-btn-prod", (e) => {
    $("#modal-produkti").css("display", "flex");
    loadKategories();
  });

  $("#produktaForma").submit(function (e) {
    e.preventDefault();

    const form = document.getElementById("produktaForma");
    const formData = new FormData(form);

    const url = !edit
      ? "database/produkts_add.php"
      : "database/produkts_edit.php";

    $.ajax({
      url: url,
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function () {
        $(".modal").hide();
        $("#produktaForma").trigger("reset");
        $("#preview-container").empty();
        fetchProdukti();
        showNotif(
          edit
            ? "Produkts veiksmīgi rediģēts!"
            : "Produkts veiksmīgi pievienots!",
          "success"
        );
        edit = false;
      },
      error: function () {
        showNotif("Kļūda saglabājot datus!", "error");
      },
    });
  });

  $(document).on("click", ".produkts-delete", (e) => {
    if (confirm("Vai tiešām vēlies dzēst?")) {
      const element = $(e.currentTarget).closest("tr");
      const id = $(element).attr("prod_ID");
      $.post("database/produkts_delete.php", { id }, (response) => {
        fetchProdukti();
        showNotif("Produkts veiksmīgi dzēsts!", "success");
      });
    }
  });
});
