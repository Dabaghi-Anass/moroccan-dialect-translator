const fromSpeakerBtn = document.querySelector("#from_speaker");
const fromMicBtn = document.querySelector("#from_mic");
const toSpeakerBtn = document.querySelector("#to_speaker");
const fromTextArea = document.querySelector("#from_translate");
const toTextArea = document.querySelector("#to_translate");
const fromSelect = document.querySelector("#from-language");
const toSelect = document.querySelector("#to-language");
const copyBtn = document.querySelector("#copy");
const switchLanguageBtn = document.querySelector("#switch-language-btn");

const recognition = new (window.SpeechRecognition ||
	window.webkitSpeechRecognition ||
	window.mozSpeechRecognition ||
	window.msSpeechRecognition)();

const synth = window.speechSynthesis;

recognition.onstart = () => {
	fromMicBtn.classList.add("active");
};

recognition.onend = () => {
	fromMicBtn.classList.remove("active");
};

const ARABIC_LANG = "ar";
const ENGLISH_LANG = "en-US";

function toast(message) {
	const toast = document.createElement("div");
	toast.classList.add("toast");
	toast.textContent = message;
	document.body.appendChild(toast);
	setTimeout(() => {
		toast.remove();
	}, 3000);
}
function speak(text, lang = "en-US") {
	const utter = new SpeechSynthesisUtterance(text);
	utter.lang = "en-US";
	synth.speak(utter);
}

function switchTexts() {
	const temp = fromTextArea.value;
	fromTextArea.value = toTextArea.value;
	toTextArea.value = temp;
}
function handleChangeLanguage() {
	const fromLang = fromSelect.value;
	if (fromLang === ARABIC_LANG) {
		fromTextArea.style.direction = "rtl";
		toTextArea.style.direction = "ltr";
		fromTextArea.setAttribute("placeholder", "أدخل النص هنا");
		toTextArea.setAttribute("placeholder", "Translation here");
	} else {
		fromTextArea.style.direction = "ltr";
		toTextArea.style.direction = "rtl";
		fromTextArea.setAttribute("placeholder", "Enter text here");
		toTextArea.setAttribute("placeholder", "الترجمة هنا");
	}
	switchTexts();
}
fromSelect.addEventListener("change", (e) => {
	if (fromSelect.value === ENGLISH_LANG) {
		toSelect.value = ARABIC_LANG;
	} else {
		toSelect.value = ENGLISH_LANG;
	}
	handleChangeLanguage();
});
toSelect.addEventListener("change", (e) => {
	if (toSelect.value === ENGLISH_LANG) {
		fromSelect.value = ARABIC_LANG;
	} else {
		fromSelect.value = ENGLISH_LANG;
	}
	handleChangeLanguage();
});

copyBtn.addEventListener("click", (e) => {
	if (toTextArea.value) {
		navigator.clipboard.writeText(toTextArea.value);
		toast("Copied to clipboard");
	}
});
switchLanguageBtn.addEventListener("click", (e) => {
	const temp = fromSelect.value;
	fromSelect.value = toSelect.value;
	toSelect.value = temp;
	handleChangeLanguage();
});

//-------------------------------

//handle text to speech

fromSpeakerBtn.addEventListener("click", (e) => {
	const text = fromTextArea.value;
	if (!text) {
		return;
	}
	if (fromSelect.value === ARABIC_LANG) {
		const voice = synth
			.getVoices()
			.find((voice) => voice.lang.startsWith("ar"));
		if (voice) {
			speak(text, voice.lang);
		} else {
			toast("Arabic voice is not supported in your browser");
		}
	} else {
		speak(text, fromSelect.value);
	}
});

toSpeakerBtn.addEventListener("click", (e) => {
	const text = toTextArea.value;
	if (!text) {
		return;
	}
	if (toSelect.value === ARABIC_LANG) {
		const voice = synth
			.getVoices()
			.find((voice) => voice.lang.startsWith("ar"));
		if (voice) {
			speak(text, voice.lang);
		} else {
			toast("Arabic voice is not supported in your browser");
		}
	} else {
		speak(text, toSelect.value);
	}
});

//handle speech to text

fromMicBtn.addEventListener("click", (e) => {
	recognition.lang = fromSelect.value;
	recognition.onresult = (e) => {
		const text = e.results[0][0].transcript;
		fromTextArea.value = text;
		handleTranslate(text);
	};
	recognition.start();
});

addEventListener("DOMContentLoaded", () => {
	handleChangeLanguage();
});

async function handleTranslate(text) {
	if (text.trim().length === 0) {
		toTextArea.value = "";
		return;
	}

	try {
		const result = await translate(
			text.trim(),
			fromSelect.value,
			toSelect.value
		);
		toTextArea.value = result;
	} catch (e) {
		toast(e.message);
	}
}
fromTextArea.addEventListener("input", async (e) => {
	handleTranslate(e.target.value);
});
