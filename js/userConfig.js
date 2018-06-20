//

//genere les variables depuis le tableau pour pouvoir les utiliser dans le code facilement
function userUpdate() {
	console.log("Sauvegarde des paramètres :");
	for (var i = 0; i < user._init.length; i++) {
		console.log(user._init[i][0], "=", user._init[i][2]);
		eval("user." + user._init[i][0] + '=user._init[i][2]');
	}
}

// sauvegarde les cookies de config user depuis le tableau user._init
function userSaveCookies() {
	for (var i = 0; i < user._init.length; i++) {
		setCookie(user._init[i][0], user._init[i][2]);
	}
}