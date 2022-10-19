module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.{js,scss,css}'
    ],
    theme: {
        container: {
            padding: {
                DEFAULT: '0',
                sm: '0',
                md: '0',
                lg: '0',
                xl: '0',
                '2xl': '0',
            },
        },
        extend: {
            fontFamily: {
                'roboto': ['Roboto', 'sans-serif'],
            },
            colors: {
                'xam': '#3D4043',
                'red': '#D72E22',
            },
            fontSize: {
                'xs': '12px',
                'sm': '14px',
                'md': '16px',
                'lg': '20px',
                'xl': '32px',
            },
            fontWeight: {
                normal: 400,
                bold: 700,
            },
        }
    },
    variants: {},
    plugins: [
        require('@tailwindcss/line-clamp'),
    ],
};