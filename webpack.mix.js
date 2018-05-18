let mix = require('laravel-mix');

const moduleDir = __dirname;
const resPath = moduleDir + '/Resources/assets';
const compileTo = moduleDir + '/Assets';

mix.js(resPath + '/admin/cities/js/index.js', compileTo + '/admin/cities/js/index.js');
mix.js(resPath + '/admin/countries/js/index.js', compileTo + '/admin/countries/js/index.js');

mix.disableNotifications();