/*!
    * Start Bootstrap - SB Admin v6.0.3 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2021 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
(function($) {
    "use strict";

    // Add active state to sidebar nav links
    // because the 'href' property of the DOM element is the absolute path
    var path = window.location.href;
    $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {

        if (this.href === path) {
            $(this).addClass("active");
        }
    });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });

    // Text animation
    // Wrap every letter in a span
    let textWrapper = document.querySelector('.ml10 .letters');
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");
    anime.timeline({loop: true})
        .add({
            targets: '.ml10 .letter',
            rotateY: [-90, 0],
            duration: 1300,
            delay: (el, i) => 45 * i
        }).add({
        targets: '.ml10',
        opacity: 0,
        duration: 1000,
        easing: "easeOutExpo",
        delay: 1000
    });

    // Animation On Submit
    jQuery(document).on('beforeSubmit', 'form', function (event) {
        let buttonSubmit = jQuery(this).find('button[type=submit]');
        buttonSubmit.html('<i class="fas fa-spinner fa-spin"></i> Memproses...');
        buttonSubmit.attr('disabled', true).addClass('disabled');
    });

})(jQuery);


