$(document).ready(function () {
  let edit = false;

  $("#searchInput").on("keyup", function () {
    let searchText = $(this).val().toLowerCase();
    $(".lietotajs-row").each(function () {
      const lietvards = $(this).find("td:nth-child(2)").text().toLowerCase();
      const vards = $(this).find("td:nth-child(3)").text().toLowerCase();

      if (vards.includes(searchText)) {
        $(this).show();
      } else if (lietvards.includes(searchText)) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });

  //Lietotaji
  fetchLietotaji();

  function fetchLietotaji() {
    $.ajax({
      url: "database/lietotaji_list.php",
      type: "GET",
      success: function (response) {
        const lietotaji = JSON.parse(response);
        let template = "";
        lietotaji.forEach((lietotajs) => {
          template += `
                        <tr liet_ID="${lietotajs.id}" class="lietotajs-row">
                          <td>${lietotajs.id}</td>
                          <td>${lietotajs.lietotajvards}</td>
                          <td>${lietotajs.vards}</td>
                          <td>${lietotajs.uzvards}</td>
                          <td>${lietotajs.epasts}</td>
                          <td>${lietotajs.talrunis}</td>
                          <td>${lietotajs.loma}</td>
                          
                          <td>
                          <a class="lietotajs-item"> <i class="fa fa-edit"></i></a>
                          <a class="lietotajs-delete"> <i class="fa fa-trash"></i></a>
                          </td>
                          </tr>
                       `;
        });
        $("#lietotaji").html(template);
      },
      error: function () {
        // alert("Neizdevās ielādēt datus!");
      },
    });
  }

  function togglePasswordFields() {
    if (edit) {
      $("#parole").hide();
      $(".paroleBox").show();
      $("#paroleNew").hide();
    } else {
      $("#parole").show();
      $(".paroleBox").hide();
    }
  }

  $(document).on("click", ".lietotajs-item", function () {
    const id = $(this).closest("tr").attr("liet_ID");
    $(".modal").css("display", "flex");

    $.post("database/lietotajs_single.php", { id }, (response) => {
      const lietotajs = JSON.parse(response);
      $("#lietotajvards").val(lietotajs.lietotajvards);
      $("#vards").val(lietotajs.vards);
      $("#uzvards").val(lietotajs.uzvards);
      $("#epasts").val(lietotajs.epasts);
      $("#talrunis").val(lietotajs.talrunis);
      $("#loma").val(lietotajs.loma);
      $("#liet_ID").val(lietotajs.id);
      edit = true;
      togglePasswordFields();
    });
  });

  $(document).on("click", "#new-btn", () => {
    $(".modal").css("display", "flex");
    edit = false;
    togglePasswordFields();
  });

  $(document).on("click", "#changePassword", function (e) {
    e.preventDefault();
    $("#paroleNew").show().focus();
  });

  $(document).on("click", ".close-modal", function () {
    $(".modal").hide();
    $("#lietotajaForma").trigger("reset");
    $("#paroleNew").hide();
    edit = false;
    togglePasswordFields();
  });

  $("#lietotajaForma").submit((e) => {
    e.preventDefault();
    const postData = {
      lietotajvards: $("#lietotajvards").val(),
      vards: $("#vards").val(),
      uzvards: $("#uzvards").val(),
      epasts: $("#epasts").val(),
      talrunis: $("#talrunis").val(),
      loma: $("#loma").val(),
      parole: $("#parole").val(),
      paroleNew: $("#paroleNew").val(),
      id: $("#liet_ID").val(),
    };

    url = !edit ? "database/lietotajs_add.php" : "database/lietotajs_edit.php";
    $.ajax({
      url: url,
      type: "POST",
      data: postData,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          $(".modal").hide();
          $("#lietotajaForma").trigger("reset");
          fetchLietotaji();
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

  $(document).on("click", ".lietotajs-delete", function () {
    if (confirm("Vai tiešām vēlies dzēst?")) {
      const id = $(this).closest("tr").attr("liet_ID");

      $.post(
        "database/lietotajs_delete.php",
        { id },
        function (response) {
          if (response.success) {
            fetchLietotaji();
            showNotif(response.message, "success");
          } else {
            showNotif(response.message || "Kļūda dzēšot lietotāju.", "error");
          }
        },
        "json"
      );
    }
  });
});
