import './bootstrap';
import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;

// FontAwesome
import '@fortawesome/fontawesome-free/css/all.min.css';
import select2 from 'select2';
select2($);
import 'metismenu/dist/metisMenu.min.js';
import SimpleBar from 'simplebar';
import Swal from 'sweetalert2';
import Alpine from 'alpinejs';

window.Swal = Swal;
window.SimpleBar = SimpleBar;
window.Alpine = Alpine;


Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    console.log('Bootstrap:', window.bootstrap);
    console.log('App.js loaded');
    console.log('jQuery version:', $.fn.jquery);
    console.log('Select2 available:', typeof $.fn.select2);
    console.log('Select2 function:', $.fn.select2);

    // Inisialisasi metisMenu
    if ($.fn.metisMenu) {
        $('#menu').metisMenu();
    }

    // Set sidebar default ke toggled (hide)
    if (!$('.wrapper').hasClass('toggled')) {
        $('.wrapper').addClass('toggled');
    }

    // Toggle sidebar
    document.querySelectorAll('#sidebar-toggle-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.wrapper').forEach(function(wrapper) {
                wrapper.classList.toggle('toggled');
            });
            this.querySelectorAll('i').forEach(function(icon) {
                icon.classList.toggle('bi-chevron-left');
                icon.classList.toggle('bi-chevron-right');
            });
        });
    });

    $('.mobile-toggle-menu').on('click', function () {
        $('.wrapper').toggleClass('toggled');
    });

    // Jika sidebar dalam keadaan tersembunyi (toggled) dan li diklik, langsung buka
    $('#menu').on('click', 'li.mb-1 > a', function(e) {
        // Cari wrapper
        var $wrapper = $('.wrapper');
        if ($wrapper.hasClass('toggled')) {
            // Keluarkan toggled (buka sidebar)
            $wrapper.removeClass('toggled');
        }
    });

    // Inisialisasi select2 untuk elemen yang memiliki class select2
    if ($.fn.select2) {
        $('.select2:not([data-manual-init])').each(function() {
            $(this).select2({
                theme: "bootstrap-5",
                width: '100%'
            });
        });
        console.log('Select2 initialized for .select2 elements');
    } else {
        console.error('Select2 is NOT available!');
    }

    // Dispatch custom event bahwa libraries sudah ready
    window.dispatchEvent(new CustomEvent('app-libraries-loaded'));
    console.log('Libraries loaded event dispatched');
});
