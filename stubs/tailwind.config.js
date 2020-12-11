module.exports = {
    purge: [
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode: 'media', // or 'media' or 'class'
    theme: {
        extend: {
            fontFamily: {
                'poppins': ['Poppins', 'sans-serif'],
            },
        },
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
