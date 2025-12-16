(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    // Initiate the wowjs (jika WOW.js diload)
    if (typeof WOW !== 'undefined') {
        new WOW().init();
    }

    // Sticky Navbar (sesuai layout baru kita)
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.navbar.fixed-top').addClass('shadow-sm');
        } else {
            $('.navbar.fixed-top').removeClass('shadow-sm');
        }
    });
    
    // Back to top button (jika ada di layout)
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });

})(jQuery);

// Auto-hide alerts
setTimeout(function() {
    document.querySelectorAll('.alert').forEach(alert => {
        alert.style.transition = 'opacity 0.5s';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 500);
    });
}, 5000);