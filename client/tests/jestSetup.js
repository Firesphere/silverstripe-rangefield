import MutationObserver from 'mutation-observer'; // eslint-disable-line import/no-extraneous-dependencies

// polyfill MutationObserver for jest
Object.defineProperty(window, 'MutationObserver', { value: MutationObserver });
