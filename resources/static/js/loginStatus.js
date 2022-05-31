const fileName = window.location.pathname.split("/").pop();

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

	// TO DO:
	// checkPageVisibility: () => {
	// 	const body = {
	// 		page: fileName,
	// 	};
	// 	fetch("../php/web/UserController.php", {
	// 		headers: {
	// 			"Content-Type": "application/json",
	// 		},
	// 		method: "POST",
	// 		body: JSON.stringify(body),
	// 	})
	// 		.then((response) => {
	// 			if (response.ok) {
	// 				return response.json();
	// 			} else {
	// 				throw new Error();
	// 			}
	// 		})
	// 		.catch(() => {
	// 			console.log("Error checking visibility.");
	// 		});
	// },
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
		if (fileName == "login.html" || fileName == "register.html") {
			window.location.replace("./index.html");
		}
	} else {
		if (fileName == "addsong.html") {
			window.location.replace("./index.html");
		} else if (fileName == "songlist.html") {
			document.getElementById("new-song-btn").setAttribute("style", "display: none");
		}
		console.log("not logged");
	}
});

// statusValidation.checkPageVisibility();

document.getElementById("logout-button").addEventListener("click", logout);
