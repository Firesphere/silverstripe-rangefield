const mix = require('laravel-mix');

const themePath = 'client';
const jsPath = `${themePath}/src/js/`;
const cssPath = `${themePath}/src/css/`;
const destPath = `${themePath}/dist/`;

const SRC = {
  scss: cssPath + 'main.scss',
  js: jsPath + 'main.js',
};

const DEST = {
  css: destPath,
  js: destPath
};

mix.setPublicPath(__dirname);

mix.options({
  processCssUrls: false,
});

mix.js(SRC.js, DEST.js).sass(SRC.scss, DEST.css);