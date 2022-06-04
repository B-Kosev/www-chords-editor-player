const hamburger = document.querySelector(".hamburger");
const nav = document.querySelector(".nav");

hamburger.addEventListener("click", function (e) {
	hamburger.classList.toggle("active");
	nav.classList.toggle("active");
});
