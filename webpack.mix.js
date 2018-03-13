const mix = require('laravel-mix');

const themePath = 'client';
const srcPath = `${themePath}/src/`;
const destPath = `${themePath}/dist/`;

const SRC = {
  js: srcPath + 'main.js',
};

const DEST = {
  js: destPath
};

mix.setPublicPath(__dirname);

mix.options({
  processCssUrls: false,
});

mix.js(SRC.js, DEST.js);