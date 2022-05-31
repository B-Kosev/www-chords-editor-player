window.onload = function () {
	document.getElementById("login-form").addEventListener("submit", loginValidation.submitForm);
};

const loginValidation = {
	submitForm: (event) => {
		event.preventDefault();

		const form = event.target;

		const body = {
			username: form.username.value,
			password: form.password.value,
			login: form.login.value,
		};

		loginValidation.clearErrorMessages();

		fetch("../php/web/UserController.php", {
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
				if (response.credentials) {
					loginValidation.displayCredentialsErrorMessage(response.credentials);
				}

				if (response.username) {
					loginValidation.displayUsernameErrorMessage(response.username);
				}

				if (response.password) {
					loginValidation.displayPasswordErrorMessage(response.password);
				}

				if (response.success == true) {
					window.location.replace("./index.html");
				}
			})
			.catch(() => {
				console.log("Error in form validating.");
			});
	},

	clearErrorMessages: () => {
		const username = document.getElementById("username");
		const password = document.getElementById("password");
		const usernameErr = document.getElementById("username-err");
		const passwordErr = document.getElementById("password-err");
		const credentialsErr = document.getElementById("credentials-err");

		credentialsErr.innerHTML = "";
		usernameErr.innerHTML = "";
		passwordErr.innerHTML = "";

		credentialsErr.setAttribute("style", "display: none");
		usernameErr.setAttribute("style", "display: none");
		passwordErr.setAttribute("style", "display: none");

		username.setAttribute("style", "border: groove #e4e9f7");
		password.setAttribute("style", "border: groove #e4e9f7");
	},

	displayCredentialsErrorMessage: (errorMessage) => {
		const username = document.getElementById("username");
		const password = document.getElementById("password");
		const credentialsErr = document.getElementById("credentials-err");

		credentialsErr.innerHTML = errorMessage;
		credentialsErr.setAttribute("style", "display: block");

		username.setAttribute("style", "border: solid red");
		password.setAttribute("style", "border: solid red");
	},

	displayUsernameErrorMessage: (errorMessage) => {
		const username = document.getElementById("username");
		const usernameErr = document.getElementById("username-err");

		usernameErr.innerHTML = errorMessage;
		usernameErr.setAttribute("style", "display: block");

		username.setAttribute("style", "border: solid red");
	},

	displayPasswordErrorMessage: (errorMessage) => {
		const password = document.getElementById("password");
		const passwordErr = document.getElementById("password-err");

		passwordErr.innerHTML = errorMessage;
		passwordErr.setAttribute("style", "display: block");

		password.setAttribute("style", "border: solid red");
	},

	// checkLoginStatus: () => {
	// 	return fetch("../php/web/UserController.php").then((response) => {
	// 		if (response.ok) {
	// 			return response.json();
	// 		} else {
	// 			throw new Error();
	// 		}
	// 	});
	// },
};

// loginValidation.checkLoginStatus().then((loginStatus) => {
// 	if (loginStatus.logged) {
// 		window.location.replace("./index.html");
// 	} else {
// 		console.log("not logged");
// 	}
// });
