/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

// Chart
const statistics_chart = document.getElementById("myChart").getContext("2d");

fetch("http://localhost:8080/home/getChartCashFlowData")
  .then((response) => response.json())
  .then((cashFlowData) => {
    const myChart = new Chart(statistics_chart, {
      type: "line",
      data: {
        labels: [
          "Januari",
          "Februari",
          "Maret",
          "April",
          "Mei",
          "Juni",
          "Juli",
          "Agustus",
          "September",
          "Oktober",
          "November",
          "Desember",
        ],
        datasets: [
          {
            label: "Arus Kas",
            data: cashFlowData,
            borderWidth: 5,
            borderColor: "#6777ef",
            backgroundColor: "transparent",
            pointBackgroundColor: "#fff",
            pointBorderColor: "#6777ef",
            pointRadius: 4,
          },
        ],
      },
      options: {
        legend: {
          display: false,
        },
        scales: {
          yAxes: [
            {
              gridLines: {
                display: false,
                drawBorder: false,
              },
              ticks: {
                stepSize: 150,
              },
            },
          ],
          xAxes: [
            {
              gridLines: {
                color: "#fbfbfb",
                lineWidth: 2,
              },
            },
          ],
        },
      },
    });
  })
  .catch((error) => console.error("Error fetching cashFlow data:", error));

// Delete data
function deleteData(id) {
  $("#delete-" + id).submit();
}

// Dynamic menu
let path = location.pathname.split("/");
let url = location.origin + "/" + path[1];
$("ul.sidebar-menu li a").each(function () {
  if ($(this).attr("href").indexOf(url) !== -1) {
    $(this)
      .parent()
      .addClass("active")
      .parent()
      .parent("li")
      .addClass("active");
  }
});

// Pagination
$(document).ready(function () {
  $("#myTable").DataTable();
});

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

// Show or hide parent account selector
const statusAkun = document.getElementById("status_akun");

function toggleCodeBlock() {
  const accountType = document.getElementById("accountType");
  const parentAccountName = document.getElementById("parentAccountName");

  if (statusAkun === null || statusAkun.value === "1") {
    accountType.style.display = "block";
    parentAccountName.style.display = "none";
  } else {
    accountType.style.display = "none";
    parentAccountName.style.display = "block";
  }
}

if (statusAkun !== null) {
  document
    .getElementById("status_akun")
    .addEventListener("change", toggleCodeBlock);
}

toggleCodeBlock();
