function preparePage() {
document.getElementById("other").onclick = function() {
if (document.getElementById("other").checked) {
  // use CSS style to show it
  document.getElementById("textbox").style.display = "block";
} else {
  // hide the div
  document.getElementById("textbox").style.display = "none";
}
};
// now hide it on the initial page load.
document.getElementById("textbox").style.display = "none";
}

window.onload =  function() {
preparePage();
};
