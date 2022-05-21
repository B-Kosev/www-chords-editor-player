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
			})
			.catch(() => {
				console.log("Error in form validating.");
			});
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
		username.setAttribute("style", "border: solid red");
		usernameErr.innerHTML = errorMessage;
		usernameErr.setAttribute("style", "display: block");
	},
	displayPasswordErrorMessage: (errorMessage) => {
		const password = document.getElementById("password");
		const passwordErr = document.getElementById("password-err");
		passwordErr.innerHTML = errorMessage;
		passwordErr.setAttribute("style", "display: block");
		password.setAttribute("style", "border: solid red");
	},
	removeFormButtons: () => {
		const loginButton = document.getElementById("login-button");
		const registerButton = document.getElementById("register-button");
		if (loginButton) {
			loginButton.parentElement.removeChild(loginButton);
		}
		if (registerButton) {
			registerButton.parentElement.removeChild(registerButton);
		}
	},
};
