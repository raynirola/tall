module.exports = {
    purge: [
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {},
    },
    variants: {
        extend: {
            ringColor: ['hover'],
        },
    },
    plugins: [
        require('@tailwindcss/forms')
    ],
}
