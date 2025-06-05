$(document).ready(function () {
  let edit = false;

  fetchAtsauksmes();

  function fetchAtsauksmes() {
    $.ajax({
      url: "database/atsauksmes_list.php",
      type: "GET",
      success: function (response) {
        const atsauksmes = JSON.parse(response);
        let template = "";
        atsauksmes.forEach((atsauksme) => {
          template += `
            <tr ats_ID="${atsauksme.id}">
              <td>${atsauksme.id}</td>
              <td>${atsauksme.lietotajvards}</td>
              <td><img src="${atsauksme.bilde}" class="cropped"></td>
              <td>${atsauksme.epasts}</td>
              <td>${atsauksme.vertejums}/5</td>
             <td class="longer">${
               atsauksme.teksts.length > 100
                 ? atsauksme.teksts.substring(0, 100) + "..."
                 : atsauksme.teksts
             }</td>
              <td>${atsauksme.datums}</td>
              <td>
                <a class="atsauksme-item btn">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </a>
              </td>
            </tr>
          `;
        });
        $("#atsauksmes").html(template);
      },
      error: function () {
        // alert("Neizdevās ielādēt datus!");
      },
    });
  }

  $(document).on("click", ".atsauksme-item", (e) => {
    $("#modal-atsauksmes").css("display", "flex");

    const element = $(e.currentTarget).closest("tr");
    const id = $(element).attr("ats_ID");

    $.post("database/atsauksme_single.php", { id }, (response) => {
      const atsauksme = JSON.parse(response);
      $("#vards").val(atsauksme.vards);
      $("#uzvards").val(atsauksme.uzvards);
      $("#epasts").val(atsauksme.epasts);
      $("#teksts").val(atsauksme.teksts);
      $("#vertejums").val(atsauksme.vertejums);
      $("#ats_ID").val(atsauksme.id);

      edit = true;
    });
  });

  $(document).on("click", ".close-modal", () => {
    $(".modal").hide();
    $("#atsauksmesForma").trigger("reset");
    edit = false;
  });
});
