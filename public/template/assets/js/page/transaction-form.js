// Make new row dynamically
function newRow() {
  let nomor = $("#tableLoop tbody tr").length + 1;
  let baris = "<tr>";
  baris += '<td class="text-center">' + nomor + "</td>";
  baris += "<td>";
  baris +=
    '<select name="id_akun2[]" id="id_akun2' +
    nomor +
    '" class="form-control" required></select>';
  baris += "</td>";
  baris += "<td>";
  baris +=
    '<input type="number" id="debit' +
    nomor +
    '" name="debit[]" class="form-control debit" placeholder="Debit" required="">';
  baris += "</td>";
  baris += "<td>";
  baris +=
    '<input type="number" id="kredit' +
    nomor +
    '" name="kredit[]" class="form-control kredit" placeholder="Kredit" required="">';
  baris += "</td>";
  baris += "<td>";
  baris +=
    '<select name="id_status[]" id="id_status' +
    nomor +
    '" class="form-control" required></select>';
  baris += "</td>";
  baris += '<td class="text-center">';
  baris +=
    '<a id="HapusBaris" class="btn btn-warning btn-sm" title="Delete Row"><i class="fas fa-times"></i></a>';
  baris += "</td>";
  baris += "</tr>";

  $("#tableLoop tbody").append(baris);
  $("#tableLoop tbody tr").each(function () {
    $(this).find("td:nth-child(2) input").focus();
  });

  document.getElementById("debit" + nomor).value = 0;
  document.getElementById("kredit" + nomor).value = 0;

  formSelectAkun(nomor);
  formSelectStatus(nomor);
}

$(document).ready(function () {
  let a;
  for (a = 1; a <= 2; a++) {
    newRow();
  }
  $("#newRow").click(function (e) {
    e.preventDefault();
    newRow();
  });
  $("tableLoop tbody")
    .find("input[type=text]")
    .filter(":visible:first")
    .focus();
});

$(document).on("click", "#HapusBaris", function (e) {
  e.preventDefault();
  let nomor = 1;
  $(this).parent().parent().remove();
  $("tableLoop tbody tr").each(function () {
    $(this).find("td:nth-child(1)").html(nomor);
    nomor++;
  });
});

function formSelectAkun(nomor) {
  let output = [];
  output.push('<option value="">- Pilih data -</option>');
  $.getJSON("/transaksi/akun2", function (data) {
    $.each(data, function (key, value) {
      output.push(
        '<option value="' +
          value.id_akun2 +
          '">' +
          value.kode_akun2 +
          " | " +
          value.nama_akun2 +
          "</option>"
      );
    });
    $("#id_akun2" + nomor).html(output.join(""));
  });
}

function formSelectStatus(nomor) {
  let output = [];
  output.push('<option value="">- Pilih data -</option>');
  $.getJSON("/transaksi/status", function (data) {
    $.each(data, function (key, value) {
      output.push(
        '<option value="' + value.id_status + '">' + value.status + "</option>"
      );
    });
    $("#id_status" + nomor).html(output.join(""));
  });
}
