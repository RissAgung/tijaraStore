/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./resources/views/**/*.{html,js,blade.php}"],
  theme: {
    extend: {
      colors: {
        'primary': '#FFB015',
        'primary-hover': '#e7a013',
      }
    },
  },
  plugins: [require('tailwind-scrollbar-hide')],
}
