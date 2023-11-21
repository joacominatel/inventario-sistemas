const sideLinks = document.querySelectorAll(
  ".sidebar .side-menu li a:not(.logout)"
);

sideLinks.forEach((item) => {
  const li = item.parentElement;
  item.addEventListener("click", () => {
    sideLinks.forEach((i) => {
      i.parentElement.classList.remove("active");
    });
    li.classList.add("active");
  });
});

const menuBar = document.querySelector(".content nav .fas.fa-bars-staggered");
const sideBar = document.querySelector(".sidebar");

menuBar.addEventListener("click", () => {
  sideBar.classList.toggle("close");
});

window.addEventListener("resize", () => {
  if (window.innerWidth < 768) {
    sideBar.classList.add("close");
  } else {
    sideBar.classList.remove("close");
  }
});

const toggler = document.getElementById("theme-toggle");

toggler.addEventListener("change", function () {
  if (this.checked) {
    document.body.classList.add("dark");
  } else {
    document.body.classList.remove("dark");
  }
});

document.addEventListener("DOMContentLoaded", function() {
  var modal = document.getElementById("loginModal");
  var btn = document.getElementById("btn-login");
  var span = document.getElementsByClassName("close")[0];
  var cancelButton = document.getElementById("cancelButton");

  btn.onclick = function() {
    modal.style.display = "block";
  }

  span.onclick = function() {
    modal.style.display = "none";
  }

  cancelButton.onclick = function() {
    modal.style.display = "none";
  }

  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
});

document.addEventListener('DOMContentLoaded', function () {
  document.getElementById('loginForm').addEventListener('submit', function (e) {
      e.preventDefault();

      var usuario = document.getElementById('user').value;
      var contraseña = document.getElementById('password').value;

      var xhr = new XMLHttpRequest();
      xhr.open('POST', './php/login.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      xhr.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
              if (this.responseText == 'success') {
                  window.location.reload();
              } else {
                  alert('Usuario o contraseña incorrectos');
              }
          }
      };

      xhr.send('user=' + encodeURIComponent(usuario) + '&password=' + encodeURIComponent(contraseña));
  });
});