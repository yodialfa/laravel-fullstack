/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        
      },
      fontFamily : {
        'kanit' : 'Kanit',
      }
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}



