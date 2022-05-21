window.onload = function () {
	fetchChord();
};

const fetchChord = () => {
	const chordId = $(".btn.key.selected").attr("id");
	const chordType = $(".btn.type.selected").attr("id");
	const chord = chordId + chordType;

	fetch("../php/web/ChordController.php?id=" + chord)
		.then((response) => response.json())
		.then(displayChord);
};

// Click handlers for making the buttons active
document.querySelectorAll(".btn.key").forEach((element) => {
	element.addEventListener("click", function (e) {
		document.querySelectorAll(".btn.key").forEach((item) => {
			item.classList.remove("selected");
		});
		e.target.classList.add("selected");
	});
});

document.querySelectorAll(".btn.type").forEach((element) => {
	element.addEventListener("click", function (e) {
		document.querySelectorAll(".btn.type").forEach((item) => {
			item.classList.remove("selected");
		});
		e.target.classList.add("selected");
	});
});

// Click Handlers for selecting chord and type
document.querySelectorAll(".btn.key, .btn.type").forEach((element) => {
	element.addEventListener("click", function (e) {
		fetchChord();
	});
});

const displayChord = (inversions) => {
	var first = inversions[0];
	var second = inversions[1];
	var third = inversions[2];

	// First inversion
	document.querySelectorAll(".piano.inv1 .white, .piano.inv1 .black").forEach((element) => {
		element.classList.remove("active");
	});
	document.querySelector(".piano.inv1 ." + first.first).classList.add("active");
	document.querySelector(".piano.inv1 ." + first.third).classList.add("active");
	document.querySelector(".piano.inv1 ." + first.fifth).classList.add("active");

	// Second inversion
	document.querySelectorAll(".piano.inv2 .white, .piano.inv2 .black").forEach((element) => {
		element.classList.remove("active");
	});
	document.querySelector(".piano.inv2 ." + second.first).classList.add("active");
	document.querySelector(".piano.inv2 ." + second.third).classList.add("active");
	document.querySelector(".piano.inv2 ." + second.fifth).classList.add("active");

	// Third inversion
	document.querySelectorAll(".piano.inv3 .white, .piano.inv3 .black").forEach((element) => {
		element.classList.remove("active");
	});
	document.querySelector(".piano.inv3 ." + third.first).classList.add("active");
	document.querySelector(".piano.inv3 ." + third.third).classList.add("active");
	document.querySelector(".piano.inv3 ." + third.fifth).classList.add("active");
};
