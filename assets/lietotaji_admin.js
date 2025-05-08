$(document).ready(function () {
  let edit = false;

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
                          <tr liet_ID="${lietotajs.id}">
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

  $(document).on("click", ".lietotajs-delete", (e) => {
    if (confirm("Vai tiešām vēlies dzēst?")) {
      const element = $(e.currentTarget).closest("tr");
      const id = $(element).attr("liet_ID");
      $.post("database/lietotajs_delete.php", { id }, (response) => {
        fetchLietotaji();
        showNotif("Lietotājs veiksmīgi dzēsts!", "success");
      });
    }
  });
});
