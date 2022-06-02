window.onload = function () {
	// Fetch data to populate the song list
	fetch("../php/web/SongController.php")
		.then((response) => response.json())
		.then(fillList);
};

const fillList = (songs) => {
	const params = new URL(document.location).searchParams;
	const showChords = params.get("chords");

	songs.forEach((song) => {
		var card = document.createElement("section");
		card.setAttribute("class", "card");

		var a = document.createElement("a");
		a.setAttribute("class", "song-link");

		// TODO: Handle 'showChords' parameter
		a.setAttribute("href", "song.php?title=" + song.title + "&chords=" + showChords);

		var title = document.createElement("h3");
		title.setAttribute("class", "song-title");
		title.innerHTML = song.title;

		var author = document.createElement("p");
		author.setAttribute("class", "song-author");
		author.innerHTML = "Author: " + song.author;

		var key = document.createElement("p");
		key.setAttribute("class", "song-key");
		key.innerHTML = "Key: " + song.key;

		var year = document.createElement("p");
		year.setAttribute("class", "song-year");
		year.innerHTML = "Year: " + song.year;

		a.appendChild(title);
		a.appendChild(author);
		a.appendChild(key);
		a.appendChild(year);

		card.appendChild(a);

		document.querySelector(".cards").appendChild(card);
	});

	// addCardListeners();
};

// const addCardListeners = () => {
// 	document.querySelectorAll(".card").forEach((element) => {
// 		element.addEventListener("click", function (e) {
// 			var title = element.querySelector(".song-title").innerHTML;
// 			localStorage.setItem("song-title", title);
// 		});
// 	});
// };

// <section class="card">
// 	<a href="song.html">
// 		<!-- REMOVE HARD CODED VALUES -->
// 		<h3 class="song-title">Amazing Grace</h3>
// 		<p class="song-author">Author: John Newton</p>
// 		<p class="song-key">Key: E</p>
// 		<p class="song-year">Year: 1772</p>
// 	</a>
// </section>
