module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      margin: {
        'min-100': '-100%',
        '120': '36rem',
      },
      height: {
        '350': '350px'
      }
    },
  },
  plugins: [],
}