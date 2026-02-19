/** @type {import('tailwindcss').Config} */
export default {
  darkMode: ["class"],
  content: [
      "./resources/**/*.blade.php",
    "./resources/**/*.{vue,js,ts,jsx,tsx}",
    "./resources/js/components/**/*.{vue,js,ts,jsx,tsx}",
  ],
    theme:{
      extend: {},
    },
  plugins: [],
}
