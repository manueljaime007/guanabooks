/* @import "tailwindcss";
/* @import "@nuxt/ui"; */

@theme static {
  --font-sans: 'Public Sans', sans-serif;

  --color-green-50: #EFFDF5;
  --color-green-100: #D9FBE8;
  --color-green-200: #B3F5D1;
  --color-green-300: #75EDAE;
  --color-green-400: #00DC82;
  --color-green-500: #00C16A;
  --color-green-600: #00A155;
  --color-green-700: #007F45;
  --color-green-800: #016538;
  --color-green-900: #0A5331;
  --color-green-950: #052E16;
}



/* Teu design system customizado */

/* Base styles */
@layer base {

  /* Typography */
  h1 {
    @apply text-4xl font-bold tracking-tight;
  }

  h2 {
    @apply text-3xl font-bold tracking-tight;
  }

  h3 {
    @apply text-2xl font-semibold;
  }

  h4 {
    @apply text-xl font-semibold;
  }

  h5 {
    @apply text-lg font-semibold;
  }

  h6 {
    @apply text-base font-semibold;
  }

  p {
    @apply text-base leading-relaxed;
  }

  a {
    @apply text-primary-600 hover:text-primary-700 transition-colors;
  }

  /* Form elements */
  input,
  textarea,
  select {
    @apply px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all;
  }

  button {
    @apply font-medium transition-all duration-200;
  }
}

/* Components */
@layer components {
  .btn {
    @apply px-4 py-2 rounded-lg font-medium transition-all duration-200;
  }

  .btn-primary {
    @apply bg-primary-600 text-white hover:bg-primary-700 active:bg-primary-800;
  }

  .btn-secondary {
    @apply bg-gray-200 text-gray-900 hover:bg-gray-300 active:bg-gray-400;
  }

  .btn-outline {
    @apply border-2 border-primary-600 text-primary-600 hover:bg-primary-50;
  }

  .btn-sm {
    @apply px-3 py-1 text-sm;
  }

  .btn-lg {
    @apply px-6 py-3 text-lg;
  }

  .card {
    @apply bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow;
  }

  .input-group {
    @apply mb-4;
  }

  .input-label {
    @apply block text-sm font-medium text-gray-700 mb-2;
  }

  .input-field {
    @apply w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent;
  }

  .input-error {
    @apply text-red-500 text-sm mt-1;
  }

  .badge {
    @apply inline-block px-3 py-1 rounded-full text-sm font-medium;
  }

  .badge-primary {
    @apply bg-primary-100 text-primary-800;
  }

  .badge-secondary {
    @apply bg-secondary-100 text-secondary-800;
  }

  .badge-success {
    @apply bg-green-100 text-green-800;
  }

  .badge-warning {
    @apply bg-yellow-100 text-yellow-800;
  }

  .badge-error {
    @apply bg-red-100 text-red-800;
  }

  .container-xl {
    @apply w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8;
  }

  .grid-auto {
    @apply grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6;
  }

  .text-truncate {
    @apply overflow-hidden text-overflow-ellipsis whitespace-nowrap;
  }

  .line-clamp-2 {
    @apply line-clamp-2;
  }

  .line-clamp-3 {
    @apply line-clamp-3;
  }

  /* Animations */
  .fade-enter-active,
  .fade-leave-active {
    @apply transition-opacity duration-300;
  }

  .fade-enter-from,
  .fade-leave-to {
    @apply opacity-0;
  }

  .slide-enter-active,
  .slide-leave-active {
    @apply transition-all duration-300;
  }

  .slide-enter-from {
    @apply translate-x-full opacity-0;
  }

  .slide-leave-to {
    @apply -translate-x-full opacity-0;
  }
}

/* Utilities */
@layer utilities {
  .no-scrollbar {
    @apply -ms-2 overflow-y-scroll ps-2;
  }

  .no-scrollbar::-webkit-scrollbar {
    @apply hidden;
  }

  .text-balance {
    text-wrap: balance;
  }

  .truncate-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
} */
