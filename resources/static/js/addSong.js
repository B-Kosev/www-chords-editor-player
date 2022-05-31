const addNewSong = {
	submitForm: (event) => {
		event.preventDefault();

		const form = event.target;

		addNewSong.clearErrorMessages();

		const body = {
			title: form.title.value,
			author: form.author.value,
			key: form.key.value,
			year: form.year.value,
			text: form.text.value,
		};

		fetch("../php/web/SongController.php", {
			headers: {
				"Content-Type": "application/json",
			},
			method: "POST",
			body: JSON.stringify(body),
		})
			.then((response) => {
				if (response.ok) {
					return response.json();
				} else {
					throw new Error();
				}
			})
			.then((response) => {
				if (response.title) {
					addNewSong.displayTitleErrorMessage(response.title);
				}

				if (response.author) {
					addNewSong.displayAuthorErrorMessage(response.author);
				}

				if (response.key) {
					addNewSong.displayKeyErrorMessage(response.key);
				}

				if (response.year) {
					addNewSong.displayYearErrorMessage(response.year);
				}

				if (response.text) {
					addNewSong.displayTextErrorMessage(response.text);
				}

				if (response.success == true) {
					window.location.replace("./index.html");
				}
			})
			.catch(() => {
				console.log("error");
			});
	},

	clearErrorMessages: () => {
		const title = document.getElementById("title");
		const author = document.getElementById("author");
		const key = document.getElementById("key");
		const year = document.getElementById("year");
		const text = document.getElementById("text");
		const titleErr = document.getElementById("title-err");
		const authorErr = document.getElementById("author-err");
		const keyErr = document.getElementById("key-err");
		const yearErr = document.getElementById("year-err");
		const textErr = document.getElementById("text-err");

		titleErr.innerHTML = "";
		authorErr.innerHTML = "";
		keyErr.innerHTML = "";
		yearErr.innerHTML = "";
		textErr.innerHTML = "";

		titleErr.setAttribute("style", "display: none");
		authorErr.setAttribute("style", "display: none");
		keyErr.setAttribute("style", "display: none");
		yearErr.setAttribute("style", "display: none");
		textErr.setAttribute("style", "display: none");

		title.setAttribute("style", "border: groove #e4e9f7");
		author.setAttribute("style", "border: groove #e4e9f7");
		key.setAttribute("style", "border: groove #e4e9f7");
		year.setAttribute("style", "border: groove #e4e9f7");
		text.setAttribute("style", "border: groove #e4e9f7");
	},

	displayTitleErrorMessage: (errorMessage) => {
		const title = document.getElementById("title");
		const titleErr = document.getElementById("title-err");

		titleErr.innerHTML = errorMessage;
		titleErr.setAttribute("style", "display: block");

		title.setAttribute("style", "border: solid red");
	},

	displayAuthorErrorMessage: (errorMessage) => {
		const author = document.getElementById("author");
		const authorErr = document.getElementById("author-err");

		authorErr.innerHTML = errorMessage;
		authorErr.setAttribute("style", "display: block");

		author.setAttribute("style", "border: solid red");
	},

	displayKeyErrorMessage: (errorMessage) => {
		const key = document.getElementById("key");
		const keyErr = document.getElementById("key-err");

		keyErr.innerHTML = errorMessage;
		keyErr.setAttribute("style", "display: block");

		key.setAttribute("style", "border: solid red");
	},

	displayYearErrorMessage: (errorMessage) => {
		const year = document.getElementById("year");
		const yearErr = document.getElementById("year-err");

		yearErr.innerHTML = errorMessage;
		yearErr.setAttribute("style", "display: block");

		year.setAttribute("style", "border: solid red");
	},

	displayTextErrorMessage: (errorMessage) => {
		const text = document.getElementById("text");
		const textErr = document.getElementById("text-err");

		textErr.innerHTML = errorMessage;
		textErr.setAttribute("style", "display: block");

		text.setAttribute("style", "border: solid red");
	},
};

document.getElementById("song-form").addEventListener("submit", addNewSong.submitForm);
