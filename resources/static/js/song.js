$(document).ready(function () {
	var title = localStorage.getItem("song-title");

	initKeysMap();

    // Fetch the song info and fill the page
	fetch("../php/web/SongController.php?title=" + title)
		.then((response) => response.json())
		.then(fillData);

	// Click handlers for making the button active and transposing the chords
	$(".btn.key").on("click", function () {
		$(".btn.key").removeClass("selected");
		$(this).addClass("selected");

		var originalKey = $(".song-key").text().replace("Key: ", "");
		var destinationKey = $(this).text();

		transposeChord(originalKey, destinationKey);
	});
});

const keysMap = new Map();

const initKeysMap = () => {
	keysMap.set("C", 1);
	keysMap.set("C#", 2);
	keysMap.set("D", 3);
	keysMap.set("D#", 4);
	keysMap.set("E", 5);
	keysMap.set("F", 6);
	keysMap.set("F#", 7);
	keysMap.set("G", 8);
	keysMap.set("G#", 9);
	keysMap.set("A", 10);
	keysMap.set("A#", 11);
	keysMap.set("B", 12);
};

function getByValue(val) {
	return [...keysMap].find(([key, value]) => val === value)[0];
}

const fillData = (song) => {
	$(".song-title").text(song.title);
	$(".song-author").text("Author: " + song.author);
	$(".song-key").text("Key: " + song.key);
	$(".song-year").text("Year: " + song.year);
	$(".song-data").text(song.text);

	parseText();

	var originalKey = song.key;
	originalKey.replace("#", "s");
	originalKey = originalKey.toLowerCase();

	$(".btn.key").removeClass("selected");
	$("#" + originalKey).addClass("selected");
};

const parseText = () => {
	$(".song-data").html(function (i, old) {
		return old.replace(/\[(.*?)\]/g, '<span class="chord">$1</span>');
	});
};

const transposeChord = (originalKey, destinationKey) => {
	var interval = keysMap.get(destinationKey) - keysMap.get(originalKey);
	$(".song-key").text("Key: " + destinationKey);

	$(".chord").each(function () {
		var currentKey = $(this).text();
		var minor = false;

		// Check if key is minor
		if (currentKey.slice(-1) === "m") {
			minor = true;
			currentKey = currentKey.slice(0, -1);
		}

		// Check if new key is outside the map
		var newKeyValue = keysMap.get(currentKey) + interval;
		newKeyValue = newKeyValue < 1 ? newKeyValue + 12 : newKeyValue;
		newKeyValue = newKeyValue > 12 ? newKeyValue - 12 : newKeyValue;

		var newKey = getByValue(newKeyValue);

		// Check if append of 'm' for minor keys is needed
		minor ? $(this).text(newKey + "m") : $(this).text(newKey);
	});
};
