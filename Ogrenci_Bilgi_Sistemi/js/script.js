// Search bar
const searchBox = document.getElementById("searchBox");
const dataTable = document.getElementById("dataTable");

searchBox.addEventListener("input", function () {
  const inputSearch = searchBox.value.toLowerCase();
  const tdAll = dataTable.querySelectorAll("tbody tr"); // Sadece tablo satırlarını seçtiriyor.
  const tableHeaders = dataTable.querySelectorAll("thead tr"); // Sadece tablo başlıklarını seçtiriyor.

  tdAll.forEach((td) => {
    const tds = td.querySelectorAll("td");
    let status = false;

    tds.forEach((td) => {
      const tdText = td.textContent.toLowerCase();
      if (tdText.includes(inputSearch)) {
        status = true;
      }
    });

    if (status) {
      td.style.display = "";
    } else {
      td.style.display = "none";
    }
  });
});
