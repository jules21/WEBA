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
                'primary': '#014E84',
                'primary-light': '#115789',
                'accent': '#A6CE39',
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
