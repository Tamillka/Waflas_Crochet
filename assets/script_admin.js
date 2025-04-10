function toggleForm() {
  var form = document.getElementById("passwordForm");
  if (form.classList.contains("hidden")) {
    form.classList.remove("hidden");
  } else {
    form.classList.add("hidden");
  }
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
});
