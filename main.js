const menu = document.querySelector(".submenu-main");
document.querySelector(".user").addEventListener("click", function () {
  menu.classList.toggle("active");
});

document.querySelector('#Close-btn').addEventListener("click", function () {
  document.querySelector('.form-m').style.display = 'none';
  window.location.href = "Aproduct.php";

})
