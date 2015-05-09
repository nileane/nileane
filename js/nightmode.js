// Toggle night theme
var d = document.body,
    t = document.querySelectorAll(".lights")[0],
    m = localStorage.getItem("nightmode");

if(m == "true") {
  d.classList.add("dark");
}

t.addEventListener("click", function(){
  if(d.classList.contains("dark")) {
    d.classList.remove("dark");
    localStorage.setItem("nightmode", "false");
  } else {
    d.classList.add("dark");
    localStorage.setItem("nightmode", "true");
  }
});
