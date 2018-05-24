
jQuery(document).ready( function($) {

    toastr.options.timeOut = 2500; // How long the toast will display without user interaction
    toastr.options.extendedTimeOut = 60; // How long the toast will display after a user hovers over it
    toastr.options.closeButton = true;

    // Activate scrollspy to add active class to navbar items on scroll
    $('body').scrollspy({
        target: '#mainNav',
        offset: 56
    });

    // Collapse Navbar
    var navbarCollapse = function() {
        if ($("#mainNav").offset().top > 100) {
            $("#mainNav").addClass("navbar-shrink");
        } else {
            $("#mainNav").removeClass("navbar-shrink");
        }
    };
    // Collapse now if page is not at top
    navbarCollapse();
    // Collapse the navbar when page is scrolled
    $(window).scroll(navbarCollapse);

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("topButton").style.display = "block";
        } else {
            document.getElementById("topButton").style.display = "none";
        }
    }







// Hide navbar when modals trigger
// $('.portfolio-modal').on('show.bs.modal', function(e) {
//   $(".navbar").addClass("d-none");
// })
// $('.portfolio-modal').on('hidden.bs.modal', function(e) {
//   $(".navbar").removeClass("d-none");
// })

});