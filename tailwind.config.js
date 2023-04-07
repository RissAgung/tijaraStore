/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./resources/views/**/*.{html,js,blade.php}"],
  theme: {
    extend: {},
  },
  plugins: [require('tailwind-scrollbar-hide')],
}
