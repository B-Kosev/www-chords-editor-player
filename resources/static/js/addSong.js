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
			duration: form.duration.value,
			tempo: form.tempo.value,
			signature: form.signature.value,
			ytlink: form.ytlink.value,
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

				if (response.duration) {
					addNewSong.displayDurationErrorMessage(response.duration);
				}

				if (response.tempo) {
					addNewSong.displayTempoErrorMessage(response.tempo);
				}

				if (response.signature) {
					addNewSong.displaySignatureErrorMessage(response.signature);
				}

				if (response.ytlink) {
					addNewSong.displayYTlinkErrorMessage(response.ytlink);
				}

				if (response.text) {
					addNewSong.displayTextErrorMessage(response.text);
				}

				if (response.success == true) {
					window.location.replace("./index.php");
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
		const duration = document.getElementById("duration");
		const tempo = document.getElementById("tempo");
		const signature = document.getElementById("signature");
		const ytlink = document.getElementById("ytlink");
		const text = document.getElementById("text");

		const titleErr = document.getElementById("title-err");
		const authorErr = document.getElementById("author-err");
		const keyErr = document.getElementById("key-err");
		const yearErr = document.getElementById("year-err");
		const durationErr = document.getElementById("duration-err");
		const tempoErr = document.getElementById("tempo-err");
		const signatureErr = document.getElementById("signature-err");
		const ytlinkErr = document.getElementById("ytlink-err");
		const textErr = document.getElementById("text-err");

		titleErr.innerHTML = "";
		authorErr.innerHTML = "";
		keyErr.innerHTML = "";
		yearErr.innerHTML = "";
		durationErr.innerHTML = "";
		tempoErr.innerHTML = "";
		signatureErr.innerHTML = "";
		ytlinkErr.innerHTML = "";
		textErr.innerHTML = "";

		titleErr.setAttribute("style", "display: none");
		authorErr.setAttribute("style", "display: none");
		keyErr.setAttribute("style", "display: none");
		yearErr.setAttribute("style", "display: none");
		durationErr.setAttribute("style", "display: none");
		tempoErr.setAttribute("style", "display: none");
		signatureErr.setAttribute("style", "display: none");
		ytlinkErr.setAttribute("style", "display: none");
		textErr.setAttribute("style", "display: none");

		title.setAttribute("style", "border: groove #e4e9f7");
		author.setAttribute("style", "border: groove #e4e9f7");
		key.setAttribute("style", "border: groove #e4e9f7");
		year.setAttribute("style", "border: groove #e4e9f7");
		duration.setAttribute("style", "border: groove #e4e9f7");
		tempo.setAttribute("style", "border: groove #e4e9f7");
		signature.setAttribute("style", "border: groove #e4e9f7");
		ytlink.setAttribute("style", "border: groove #e4e9f7");
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

	displayDurationErrorMessage: (errorMessage) => {
		const duration = document.getElementById("duration");
		const durationErr = document.getElementById("duration-err");

		durationErr.innerHTML = errorMessage;
		durationErr.setAttribute("style", "display: block");

		duration.setAttribute("style", "border: solid red");
	},

	displayTempoErrorMessage: (errorMessage) => {
		const tempo = document.getElementById("tempo");
		const tempoErr = document.getElementById("tempo-err");

		tempoErr.innerHTML = errorMessage;
		tempoErr.setAttribute("style", "display: block");

		tempo.setAttribute("style", "border: solid red");
	},

	displaySignatureErrorMessage: (errorMessage) => {
		const signature = document.getElementById("signature");
		const signatureErr = document.getElementById("signature-err");

		signatureErr.innerHTML = errorMessage;
		signatureErr.setAttribute("style", "display: block");

		signature.setAttribute("style", "border: solid red");
	},

	displayYTlinkErrorMessage: (errorMessage) => {
		const ytlink = document.getElementById("ytlink");
		const ytlinkErr = document.getElementById("ytlink-err");

		ytlinkErr.innerHTML = errorMessage;
		ytlinkErr.setAttribute("style", "display: block");

		ytlink.setAttribute("style", "border: solid red");
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
