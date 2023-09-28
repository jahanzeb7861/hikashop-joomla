function dateDifference(date) {
	const date1 = new Date();
	const date2 = new Date(date);
	const differenceInMilliseconds = date2 - date1;
	const differenceInDays = Math.round(differenceInMilliseconds / (24 * 60 * 60 * 1000));
	return differenceInDays;
}
async function getCityFromPostalCode(postalCode, countryCode) {
	const base_url = "http://api.geonames.org/postalCodeLookupJSON";
	const username = "test_user33168"; // Replace with your Geonames username

	const params = new URLSearchParams({
		postalcode: postalCode,
		country: countryCode,
		username: username
	});

	try {
		const response = await fetch(`${base_url}?${params.toString()}`);
		const data = await response.json();

		if (data && data.postalcodes && data.postalcodes.length > 0) {
			return data.postalcodes[0].placeName;
		} else {
			return null;
		}
	} catch (error) {
		console.error("Error fetching data:", error);
		return null;
	}
}

