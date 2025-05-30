$(document).ready(function () {
  let edit = false;
  //KATEGORIJAS
  fetchKategorijas();

  function fetchKategorijas() {
    $.ajax({
      url: "database/kategorijas_list.php",
      type: "GET",
      success: function (response) {
        const kategorijas = JSON.parse(response);
        let template = "";
        kategorijas.forEach((kategorija) => {
          template += `
                     <tr kat_ID="${kategorija.id}">
                         <td>${kategorija.id}</td>
                         <td>${kategorija.nosaukums}</td>
                         <td> <img src="${kategorija.bilde}"> </td>
                         <td>${kategorija.datums}</td>
                         
                        <td>
                             <a class="kategorija-item btn"> <i class="fa fa-edit"></i></a>
                             <a class="kategorija-delete btn"> <i class="fa fa-trash"></i></a>
                         </td>
                     </tr>
                  `;
        });
        $("#kategorijas").html(template);
      },
      error: function () {
        // alert("Neizdevās ielādēt datus!");
      },
    });
  }

  $(document).on("click", ".kategorija-item", (e) => {
    $("#modal-kategorijas").css("display", "flex");

    const element = $(e.currentTarget).closest("tr");
    const id = $(element).attr("kat_ID");

    $.post("database/kategorija_single.php", { id }, (response) => {
      const kategorija = JSON.parse(response);
      $("#modal-kategorijas #nosaukums").val(kategorija.nosaukums);
      $("#kat_ID").val(kategorija.id);
      edit = true;
      if (kategorija.bilde) {
        $("#preview-image")
          .attr("src", `data:image/jpeg;base64,${kategorija.bilde}`)
          .css("display", "block");
      }

      if (edit) {
        const footer = `
                <p>Kategorija izveidota: ${kategorija.datums}</p>
                <p>Pēdējās izmaiņas: ${kategorija.redigesanas_datums}</p>
            `;
        $("#kategorijas-informacija").html(footer);
      }
    });
  });

  $(document).on("click", "#new-btn", (e) => {
    $("#modal-kategorijas").css("display", "flex");
  });
  $(document).on("click", ".close-modal", (e) => {
    $(".modal").hide();
    $("#kategorijasForma").trigger("reset");
    $("#preview-image").attr("src", "").css("display", "none");
    $("#kategorijas-informacija").html("");
    edit = false;
  });

  $("#kategorijasForma").submit(function (e) {
    e.preventDefault();
    const form = document.getElementById("kategorijasForma");
    const formData = new FormData(form);
    const url = !edit
      ? "database/kategorija_add.php"
      : "database/kategorija_edit.php";

    $.ajax({
      url: url,
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          $(".modal").hide();
          $("#kategorijasForma").trigger("reset");
          fetchKategorijas();
          showNotif(response.message, "success");
          edit = false;
        } else {
          showNotif(response.message, "error");
        }
      },
      error: function () {
        showNotif("Kļūda savienojumā ar serveri!", "error");
      },
    });
  });

  $(document).on("change", "#bilde", function (event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        $("#preview-image")
          .attr("src", e.target.result)
          .css("display", "block");
      };
      reader.readAsDataURL(file);
    } else {
      $("#preview-image").attr("src", "").css("display", "none");
    }
  });

  $(document).on("click", ".kategorija-delete", function () {
    if (confirm("Vai tiešām vēlies dzēst?")) {
      const id = $(this).closest("tr").attr("kat_ID");

      $.post(
        "database/kategorija_delete.php",
        { id },
        function (response) {
          if (response.success) {
            fetchKategorijas();
            showNotif(response.message, "success");
          } else {
            showNotif(response.message, "error");
          }
        },
        "json"
      );
    }
  });
});
