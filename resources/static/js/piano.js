$(document).ready(function () {
	// On load of page preselect chord
	fetchChord();

	// Click handlers for making the button active
	$(".btn.key").on("click", function () {
		$(".btn.key").removeClass("selected");
		$(this).addClass("selected");
	});

	$(".btn.type").on("click", function () {
		$(".btn.type").removeClass("selected");
		$(this).addClass("selected");
	});

	// Click Handlers for selecting chord and type
	$(".btn.key, .btn.type").on("click", function (e) {
		fetchChord();
	});
});

function fetchChord() {
	const chordId = $(".btn.key.selected").attr("id");
	const chordType = $(".btn.type.selected").attr("id");
	const chord = chordId + chordType;

	fetch("../php/web/ChordController.php?id=" + chord)
		.then((response) => response.json())
		.then(displayChord);
}

const displayChord = (inversions) => {
	var first = inversions[0];
	var second = inversions[1];
	var third = inversions[2];

	// First inversion
	$(".piano.inv1 .white, .piano.inv1 .black").removeClass("active");
	$(".piano.inv1 ." + first.first).addClass("active");
	$(".piano.inv1 ." + first.third).addClass("active");
	$(".piano.inv1 ." + first.fifth).addClass("active");

	// Second inversion
	$(".piano.inv2 .white, .piano.inv2 .black").removeClass("active");
	$(".piano.inv2 ." + second.first).addClass("active");
	$(".piano.inv2 ." + second.third).addClass("active");
	$(".piano.inv2 ." + second.fifth).addClass("active");

	// Third inversion
	$(".piano.inv3 .white, .piano.inv3 .black").removeClass("active");
	$(".piano.inv3 ." + third.first).addClass("active");
	$(".piano.inv3 ." + third.third).addClass("active");
	$(".piano.inv3 ." + third.fifth).addClass("active");

	// console.log(first.first);
};
