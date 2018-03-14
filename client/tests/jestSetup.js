import MutationObserver from 'mutation-observer';

// polyfill MutationObserver for jest
Object.defineProperty(window, 'MutationObserver', { value: MutationObserver });
