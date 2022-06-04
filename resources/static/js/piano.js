window.onload = function () {
	fetchChord();
};

let params;

const fetchChord = () => {
	params = new URL(document.location).searchParams;
	const chordId = params.get("chordId");
	const chordType = params.get("chordType");
	// const chordId = document.getElementById(urlChordId);
	// const chordType = document.getElementById(urlChordType);
	// const chordId = document.querySelector(".btn.key.selected").getAttribute("id");
	// const chordType = document.querySelector(".btn.type.selected").getAttribute("id");
	let chord;
	if (chordType === "maj") {
		chord = chordId;
	} else if (chordType === "min") {
		chord = chordId + "m";
	}
	window.history.pushState("", "", "piano.php?chordId=" + chordId + "&chordType=" + chordType);

	fetch("../php/web/ChordController.php?id=" + chord)
		.then((response) => response.json())
		.then(displayChord);

	// Load proper audio files
	document.querySelector(".audio.inv1").src = "./static/audio/" + chord + "1.mp3";
	document.querySelector(".audio.inv2").src = "./static/audio/" + chord + "2.mp3";
	document.querySelector(".audio.inv3").src = "./static/audio/" + chord + "3.mp3";

	// select correct chord
	document.querySelectorAll(".btn.key").forEach((item) => {
		item.classList.remove("selected");
	});
	document.getElementById(chordId).classList.add("selected");

	// select correct type
	document.querySelectorAll(".btn.type").forEach((item) => {
		item.classList.remove("selected");
	});
	document.getElementById(chordType).classList.add("selected");
};

// Click handlers for making the buttons active
document.querySelectorAll(".btn.key").forEach((element) => {
	element.addEventListener("click", function (e) {
		params = new URL(document.location).searchParams;
		window.history.pushState("", "", "piano.php?chordId=" + e.target.id + "&chordType=" + params.get("chordType"));
	});
});

document.querySelectorAll(".btn.type").forEach((element) => {
	element.addEventListener("click", function (e) {
		params = new URL(document.location).searchParams;
		window.history.pushState("", "", "piano.php?chordId=" + params.get("chordId") + "&chordType=" + e.target.id);
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
