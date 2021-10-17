require('bootstrap');
require('./scripts');
document.Dropzone = require('dropzone');
Dropzone.autoDiscover = false;
require('./listingImages');
window.$ = window.jQuery = require('jquery');
