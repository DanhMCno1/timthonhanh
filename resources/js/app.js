import './bootstrap';
import 'flowbite';
import QRCode from 'qrcode';
import toastr from 'toastr';
import Alpine from 'alpinejs';
import $ from 'jquery';
import 'preline';
import Cropper from 'cropperjs';

window.$ = window.jQuery = $;
window.Alpine = Alpine;
window.toastr = toastr;
window.QRCode = QRCode;
window.Cropper = Cropper;

Alpine.start();
toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": false,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "10",
    "hideDuration": "10",
    "timeOut": "3000",
    "extendedTimeOut": "100",
    "showEasing": "swing",
    "hideEasing": "swing",
    "showMethod": "slideDown",
    "hideMethod": "slideUp",
    "closeMethod": "slideUp"
}
