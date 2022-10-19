/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('@fancyapps/fancybox');
import Swiper from 'swiper/bundle';
import Swal from 'sweetalert2';
window.Swiper = Swiper;
window.Swal = Swal;
window.Cookies = require('js-cookie');
window.bootbox = require('bootbox');

require('../plugins/gmaps.js');
require('../plugins/jquery.maCookieEu.js');
require('../plugins/jquery.maCookieEu.js');
window.FilePond = require('filepond');
// Import the plugin code
window.FilePondPluginFileValidateType = require('filepond-plugin-file-validate-type');
window.FilePondPluginImageExifOrientation = require('filepond-plugin-image-exif-orientation');
window.FilePondPluginImagePreview = require('filepond-plugin-image-preview');
window.FilePondPluginImageCrop = require('filepond-plugin-image-crop');
window.FilePondPluginImageResize = require('filepond-plugin-image-resize');
window.FilePondPluginImageTransform = require('filepond-plugin-image-transform');
window.FilePondPluginImageEdit = require('filepond-plugin-image-edit');



