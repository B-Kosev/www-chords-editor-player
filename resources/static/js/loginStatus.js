window.onload = function () {
	document.getElementById("logout-button").addEventListener("click", logout);
};

const statusValidation = {
	removeButtons: () => {
		const loginButton = document.getElementById("login-button");
		const registerButton = document.getElementById("register-button");
		const greeting = document.getElementById("greeting-parent");
		const logoutButton = document.getElementById("logout-button-parent");

		loginButton.setAttribute("style", "display: none");
		registerButton.setAttribute("style", "display: none");

		greeting.setAttribute("style", "display: flex");
		logoutButton.setAttribute("style", "display: flex");
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
const logout = () => {
	fetch("../php/web/UserController.php", {
		method: "DELETE",
	}).then(() => {
		document.location.reload();
	});
};

statusValidation.checkLoginStatus().then((loginStatus) => {
	if (loginStatus.logged) {
		statusValidation.removeButtons();
		document.getElementById("greeting").innerHTML = "Hi, " + loginStatus.session.username;
	} else {
		console.log("not logged");
	}
});
