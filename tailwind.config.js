/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./inc/**/*.php",
    "./template-parts/**/*.php",
    "./assets/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        'elinar-blue': '#0055A5', // замените на точный синий с вашего фото
      },
    },
  },
  plugins: [],
}
