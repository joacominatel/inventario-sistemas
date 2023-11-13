function toggleSection(sectionId) {
  const sections = [
    "seccion-ingresar-id",
    "seccion-modificar-id",
    "seccion-accesorios",
    "seccion-borrar"
  ];
  for (const id of sections) {
    const section = document.getElementById(id);
    if (id === sectionId) {
      section.classList.add("active");
    } else {
      section.classList.remove("active");
    }
  }
}

document.getElementById("btn-ingresar").addEventListener("click", function () {
  toggleSection("seccion-ingresar-id");
});

document.getElementById("btn-modificar").addEventListener("click", function () {
  toggleSection("seccion-modificar-id");
});


document
  .getElementById("btn-accesorios")
  .addEventListener("click", function () {
    toggleSection("seccion-accesorios");
  });

document.getElementById("btn-borrar").addEventListener("click", function () {
  toggleSection("seccion-borrar");
});