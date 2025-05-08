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
