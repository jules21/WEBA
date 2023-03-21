/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                'primary': '#1a202c',
                'secondary': '#2d3748',
                'accent': '#ed8936',
            }
        },
    },
    plugins: [],
    corePlugins: {
        preflight: false,
    },
    important: true,
    prefix: 'tw-',
}
