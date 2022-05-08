$(document).ready(function () {
	var title = localStorage.getItem("song-title");

	fetch("../php/web/SongController.php?title=" + title)
		.then((response) => response.json())
		.then(fillData);
});

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
