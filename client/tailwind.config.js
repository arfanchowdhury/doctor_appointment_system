const defaultTheme = require("tailwindcss/defaultTheme");
module.exports = {
	mode: "jit",
	purge: ["./index.html", "./src/**/*.{vue,js,ts,jsx,tsx}"],
	darkMode: "class", // or 'media' or 'class'
	theme: {
		extend: {
			maxHeight: {
				0: "0",
				xl: "36rem",
			},
			fontFamily: {
				sans: ["Inter", ...defaultTheme.fontFamily.sans],
			},
		},
	},
	variants: {
		extend: {
			backgroundColor: ["active", "odd"],
			display: ["responsive"],
			textColor: ["active"],
		},
	},
	plugins: [
		require("@tailwindcss/forms")({
			strategy: "class",
		}),
	],
};
