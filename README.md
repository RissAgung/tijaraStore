## Sebelum mulai ngoding

1. Project laravel masukkan folder src
2. Di folder yang sama dengan folder src install tailwind pake cara dibawah
  - npm install -D tailwindcss
  - npx tailwindcss init
  - npm install tailwind-scrollbar-hide
  - konfigurasi file tailwind.config.js
      ### content: ["./src/resources/views/**/*.{html,js,blade.php}"],
      ### plugins: [require('tailwind-scrollbar-hide')],
3. ex : npx tailwindcss -i src/public/css/input/main.css -o src/public/css/output/main.css --watch
