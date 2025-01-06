let debounceTimeout;
const DEBOUNCE_TIME = 500;

/**
 * Debounces the given function
 * @param {Function} fn
 * @param {number} time
 */
async function debounce(fn, time = DEBOUNCE_TIME) {
	clearTimeout(debounceTimeout);
	const result = new Promise((resolve) => {
		debounceTimeout = setTimeout(() => {
			resolve(fn());
		}, time);
	});
	return result;
}

/**
 *
 * @param {string} text
 * @param {string} from
 * @param {string} to
 * @returns {Promise<string>}
 */
async function translate(text, from, to) {
	const result = await debounce(async () => {
		try {
			const formData = new FormData();
			formData.append("text", text);
			formData.append("from", from);
			formData.append("to", to);

			const response = await fetch("/translate.php", {
				method: "POST",
				body: formData,
			});

			if (response?.status !== 200) {
				throw new Error("Failed to translate text");
			}

			const data = await response.json();
			return data.translatedText;
		} catch (error) {
			throw new Error("Failed to initialize connection");
		}
	});
	return result;
}
