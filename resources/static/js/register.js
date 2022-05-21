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
			})
			.catch(() => {
				console.log("error");
				// loginValidation.displayErrorMessage("Error in form validating.");
			});
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
};
