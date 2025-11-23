/**
 * Tailwind CSS Configuration
 *
 * Senior-friendly design system for Dental Rubio Group
 * Optimized for accessibility and readability (55-80 year olds)
 *
 * @package DentalRubio
 */

module.exports = {
  content: [
    './**/*.php',
    './template-parts/**/*.php',
    './page-templates/**/*.php',
    './inc/**/*.php',
    './assets/js/**/*.js',
  ],
  theme: {
    extend: {
      // Brand Colors
      colors: {
        // Primary - Navy (Trust, Professionalism)
        'navy': {
          DEFAULT: '#1e3c72',
          dark: '#0f1f3d',
          light: '#3d5a99',
          50: '#f0f4fa',
          100: '#d9e2f3',
          200: '#b3c5e7',
          300: '#8da8db',
          400: '#678bcf',
          500: '#1e3c72',
          600: '#1a3566',
          700: '#162e5a',
          800: '#12274e',
          900: '#0f1f3d',
        },
        // Secondary - Gold (Premium, Excellence)
        'gold': {
          DEFAULT: '#c9a961',
          dark: '#8b7a4f',
          light: '#e0c98a',
          50: '#fdf9f0',
          100: '#f9f0d9',
          200: '#f3e1b3',
          300: '#edd28d',
          400: '#e7c367',
          500: '#c9a961',
          600: '#b59755',
          700: '#a18549',
          800: '#8d733d',
          900: '#8b7a4f',
        },
        // Semantic Colors
        'success': '#27ae60',
        'warning': '#f39c12',
        'danger': '#e74c3c',
        'info': '#3498db',
        // Text Colors
        'text': {
          DEFAULT: '#2c3e50',
          light: '#5a6c7d',
          muted: '#95a5a6',
        },
        // Background Colors
        'surface': {
          DEFAULT: '#ffffff',
          secondary: '#f8f9fa',
          tertiary: '#ecf0f1',
        },
      },

      // Typography - Senior-Friendly Sizes (larger base)
      fontSize: {
        'xs': ['16px', { lineHeight: '1.6', letterSpacing: '0.01em' }],
        'sm': ['18px', { lineHeight: '1.6', letterSpacing: '0.01em' }],
        'base': ['20px', { lineHeight: '1.6', letterSpacing: '0.01em' }],
        'lg': ['24px', { lineHeight: '1.5', letterSpacing: '0.01em' }],
        'xl': ['28px', { lineHeight: '1.4', letterSpacing: '0' }],
        '2xl': ['32px', { lineHeight: '1.3', letterSpacing: '0' }],
        '3xl': ['40px', { lineHeight: '1.2', letterSpacing: '-0.01em' }],
        '4xl': ['48px', { lineHeight: '1.2', letterSpacing: '-0.02em' }],
        '5xl': ['56px', { lineHeight: '1.1', letterSpacing: '-0.02em' }],
        '6xl': ['64px', { lineHeight: '1.1', letterSpacing: '-0.02em' }],
      },

      // Font Family
      fontFamily: {
        'sans': [
          'Inter',
          '-apple-system',
          'BlinkMacSystemFont',
          'Segoe UI',
          'Roboto',
          'Helvetica Neue',
          'Arial',
          'sans-serif',
        ],
        'display': [
          'Inter',
          '-apple-system',
          'BlinkMacSystemFont',
          'sans-serif',
        ],
      },

      // Spacing - Generous for touch targets
      spacing: {
        'gutter': 'clamp(20px, 5vw, 40px)',
        'section': 'clamp(60px, 10vw, 120px)',
        '18': '4.5rem',
        '22': '5.5rem',
        '26': '6.5rem',
        '30': '7.5rem',
      },

      // Container
      container: {
        center: true,
        padding: {
          DEFAULT: '1rem',
          sm: '1.5rem',
          lg: '2rem',
          xl: '2.5rem',
        },
        screens: {
          sm: '640px',
          md: '768px',
          lg: '1024px',
          xl: '1280px',
        },
      },

      // Border Radius
      borderRadius: {
        'DEFAULT': '4px',
        'lg': '8px',
        'xl': '12px',
        '2xl': '16px',
        '3xl': '24px',
      },

      // Box Shadow
      boxShadow: {
        'sm': '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
        'DEFAULT': '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1)',
        'md': '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1)',
        'lg': '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1)',
        'xl': '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1)',
        'card': '0 4px 12px rgba(0, 0, 0, 0.08)',
        'card-hover': '0 8px 24px rgba(0, 0, 0, 0.12)',
        'button': '0 2px 4px rgba(0, 0, 0, 0.1)',
        'button-hover': '0 4px 8px rgba(0, 0, 0, 0.15)',
      },

      // Transitions
      transitionDuration: {
        'DEFAULT': '300ms',
        '400': '400ms',
      },
      transitionTimingFunction: {
        'smooth': 'cubic-bezier(0.4, 0, 0.2, 1)',
      },

      // Z-Index
      zIndex: {
        '60': '60',
        '70': '70',
        '80': '80',
        '90': '90',
        '100': '100',
      },

      // Min Height for touch targets (48px minimum for seniors)
      minHeight: {
        'touch': '48px',
        'button': '60px',
        'input': '56px',
      },

      // Min Width
      minWidth: {
        'touch': '48px',
        'button': '120px',
      },

      // Animation
      animation: {
        'fade-in': 'fadeIn 0.3s ease-out',
        'slide-up': 'slideUp 0.3s ease-out',
        'slide-down': 'slideDown 0.3s ease-out',
        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        slideUp: {
          '0%': { transform: 'translateY(10px)', opacity: '0' },
          '100%': { transform: 'translateY(0)', opacity: '1' },
        },
        slideDown: {
          '0%': { transform: 'translateY(-10px)', opacity: '0' },
          '100%': { transform: 'translateY(0)', opacity: '1' },
        },
      },
    },

    // Custom breakpoints for senior-friendly design
    screens: {
      'xs': '480px',
      'sm': '640px',
      'md': '768px',
      'lg': '1024px',
      'xl': '1280px',
      '2xl': '1536px',
    },
  },

  // Plugins
  plugins: [],

  // Safelist important utility classes
  safelist: [
    'bg-navy',
    'bg-navy-dark',
    'bg-gold',
    'text-navy',
    'text-gold',
    'btn',
    'btn-primary',
    'btn-gold',
    'container',
  ],
};
