$(document).ready(function () {
	var title = localStorage.getItem("song-title");
	console.log(title);

	fetch("../php/web/SongController.php?title=" + title)
		.then((response) => response.json())
		.then(fillData);
});

const fillData = (song) => {
	$(".song-title").text(song.title);
	$(".song-author").text(song.author);
	$(".song-key").text(song.key);
	$(".song-year").text(song.year);
	$(".song-data").text(song.text);
};
