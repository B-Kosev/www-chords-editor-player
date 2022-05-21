window.onload = function () {
	var title = localStorage.getItem("song-title");

	initKeysMap();

	// Fetch the song info and fill the page
	fetch("../php/web/SongController.php?title=" + title)
		.then((response) => response.json())
		.then(fillData);

	document.querySelectorAll(".btn.key").forEach((element) => {
		element.addEventListener("click", function (e) {
			document.querySelectorAll(".btn.key").forEach((item) => {
				item.classList.remove("selected");
			});
			e.target.classList.add("selected");

			var originalKey = document.querySelector(".song-key").innerHTML.replace("Key: ", "");
			var destinationKey = e.target.innerHTML;

			transposeChord(originalKey, destinationKey);
		});
	});
};

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
	document.querySelector(".song-title").innerHTML = song.title;
	document.querySelector(".song-author").innerHTML = "Author: " + song.author;
	document.querySelector(".song-key").innerHTML = "Key: " + song.key;
	document.querySelector(".song-year").innerHTML = "Year: " + song.year;
	document.querySelector(".song-data").innerHTML = song.text;

	parseText();

	var originalKey = song.key;
	originalKey.replace("#", "s");
	originalKey = originalKey.toLowerCase();

	document.querySelectorAll(".btn.key").forEach((element) => {
		element.classList.remove("selected");
	});
	document.querySelector("#" + originalKey).classList.add("selected");
};

const parseText = () => {
	var songData = document.querySelector(".song-data");
	songData.innerHTML = songData.innerHTML.replace(/\[(.*?)\]/g, '<span class="chord">$1</span>');
};

const transposeChord = (originalKey, destinationKey) => {
	var interval = keysMap.get(destinationKey) - keysMap.get(originalKey);

	document.querySelector(".song-key").innerHTML = "Key: " + destinationKey;

	document.querySelectorAll(".chord").forEach((element) => {
		var currentKey = element.innerHTML;
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
		element.innerHTML = minor ? newKey + "m" : newKey;
	});
};