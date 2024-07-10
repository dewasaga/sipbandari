function showModal(src) {
  var modal = document.getElementById("modall");
  var modalImg = document.getElementById("modalImg");

  modall.style.display = "block";
  modalImg.src = src;

  var span = document.getElementsByClassName("closee")[0];
  span.onclick = function () {
    modal.style.display = "none";
  };
}