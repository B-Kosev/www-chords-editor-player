window.onload = function () {
	document.getElementById("register-form").addEventListener("submit", registerValidation.submitForm);
};

const registerValidation = {
	submitForm: (event) => {
		event.preventDefault();

		const form = event.target;

		const body = {
			email: form.email.value,
			username: form.username.value,
			password: form.password.value,
			confirm_password: form.confirm_password.value,
			register: form.register.value,
		};

		registerValidation.clearErrorMessages();

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
				if (response.email) {
					registerValidation.displayEmailErrorMessage(response.email);
				}

				if (response.username) {
					registerValidation.displayUsernameErrorMessage(response.username);
				}

				if (response.password) {
					registerValidation.displayPasswordErrorMessage(response.password);
				}

				if (response.conPassword) {
					registerValidation.displayConfirmPasswordErrorMessage(response.conPassword);
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
		const email = document.getElementById("email");
		const username = document.getElementById("username");
		const password = document.getElementById("password");
		const confirmPassword = document.getElementById("confirm-password");

		const emailErr = document.getElementById("email-err");
		const usernameErr = document.getElementById("username-err");
		const passwordErr = document.getElementById("password-err");
		const confirmPasswordErr = document.getElementById("confirm-password-err");

		emailErr.innerHTML = "";
		usernameErr.innerHTML = "";
		passwordErr.innerHTML = "";
		confirmPasswordErr.innerHTML = "";

		emailErr.setAttribute("style", "display: none");
		usernameErr.setAttribute("style", "display: none");
		passwordErr.setAttribute("style", "display: none");
		confirmPasswordErr.setAttribute("style", "display: none");

		email.setAttribute("style", "border: groove #e4e9f7");
		username.setAttribute("style", "border: groove #e4e9f7");
		password.setAttribute("style", "border: groove #e4e9f7");
		confirmPassword.setAttribute("style", "border: groove #e4e9f7");
	},

	displayEmailErrorMessage: (errorMessage) => {
		const email = document.getElementById("email");
		const emailErr = document.getElementById("email-err");

		emailErr.innerHTML = errorMessage;
		emailErr.setAttribute("style", "display: block");

		email.setAttribute("style", "border: solid red");
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

	displayConfirmPasswordErrorMessage: (errorMessage) => {
		const confirmPassword = document.getElementById("confirm-password");
		const confirmPasswordErr = document.getElementById("confirm-password-err");

		confirmPasswordErr.innerHTML = errorMessage;
		confirmPasswordErr.setAttribute("style", "display: block");

		confirmPassword.setAttribute("style", "border: solid red");
	},

	checkLoginStatus: () => {
		return fetch("../php/web/UserController.php").then((response) => {
			if (response.ok) {
				return response.json();
			} else {
				throw new Error();
			}
		});
	},
};

registerValidation.checkLoginStatus().then((loginStatus) => {
	if (loginStatus.logged) {
		window.location.replace("./index.html");
	} else {
		console.log("not logged");
	}
});
