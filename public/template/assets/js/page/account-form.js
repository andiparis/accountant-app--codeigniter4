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
