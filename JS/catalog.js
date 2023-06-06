var keyword = document.getElementById("keyword");
var container = document.getElementById("container");
const searchBox = document.querySelector(".search-box");
const searchBtn = document.querySelector(".search-icon");
const cancelBtn = document.querySelector(".cancel-icon");
const searchInput = document.querySelector("input");
const searchData = document.querySelector(".search-data");

// tambahkan even ketika keyword ditulis
keyword.addEventListener("keyup", function () {
  // buat object AJAX
  var xhr = new XMLHttpRequest();

  // CEK kesiapan ajax
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      container.innerHTML = xhr.responseText;
    }
  };

  // eksekusi ajax
  xhr.open("GET", "./ajax/pakaian.php?keyword=" + keyword.value, true);
  xhr.send();
});

    searchBox.classList.add("active");
      searchBtn.classList.add("active");
      searchInput.classList.add("active");
      cancelBtn.classList.add("active");
      searchInput.focus();
      if (searchInput.value != "") {
        var values = searchInput.value;
        searchData.classList.remove("active");
        searchData.innerHTML = "You just typed " + "<span style='font-weight: 500;'>" + values + "</span>";
      } else {
        searchData.textContent = "";
      }
