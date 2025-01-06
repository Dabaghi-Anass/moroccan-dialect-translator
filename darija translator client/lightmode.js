const lightSwitch = document.querySelector(".light-switch");
if (localStorage.getItem("dark-mode") === "true") {
	lightSwitch.checked = true;
}
lightSwitch.addEventListener("change", () => {
	if (lightSwitch.checked) {
		document.documentElement.classList.add("dark");
		localStorage.setItem("dark-mode", true);
	} else {
		document.documentElement.classList.remove("dark");
		localStorage.setItem("dark-mode", false);
	}
});

if (
	localStorage.getItem("dark-mode") === "true" ||
	(!("dark-mode" in localStorage) &&
		window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
	document.querySelector("html").classList.add("dark");
} else {
	document.querySelector("html").classList.remove("dark");
}
