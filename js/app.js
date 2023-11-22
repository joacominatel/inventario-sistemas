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
  localStorage.setItem("sidebar", sideBar.classList.contains("close") ? "closed" : "open");
});

window.addEventListener("resize", () => {
  if (window.innerWidth < 768) {
    sideBar.classList.add("close");
  } else {
    sideBar.classList.remove("close");
  }
});

const toggler = document.getElementById("theme-toggle");

function toggleTheme(isDark) {
  if (isDark) {
    document.body.classList.add("dark");
  } else {
    document.body.classList.remove("dark");
  }
  localStorage.setItem("theme", isDark ? "dark" : "light");
}

toggler.addEventListener("change", function () {
  toggleTheme(this.checked);
});

// cuando se carga la pag, verifica si ya existe una preferencia guardada
document.addEventListener("DOMContentLoaded", function() {
  const savedTheme = localStorage.getItem("theme");
  const isDark = savedTheme === "dark";
  const sidebarState = localStorage.getItem("sidebar");

  // tema
  toggleTheme(isDark);
  toggler.checked = isDark;

  // sidebar
  if (sidebarState === "closed") {
    sideBar.classList.add("close");
  } else {
    sideBar.classList.remove("close");
  }
});

// boton filtro
document.querySelector('.bx-filter').addEventListener('click', function() {
  var menu = document.getElementById('filtro-menu');
  menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
});

function filtrar(accion) {
  var filas = document.querySelectorAll('.orders tbody tr');
  filas.forEach(function(row) {
      if (accion === 'Todo' || row.querySelector('.status').textContent.includes(accion)) {
          row.style.display = '';
      } else {
          row.style.display = 'none';
      }
  });
}