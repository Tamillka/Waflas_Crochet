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
