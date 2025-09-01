jQuery(document).ready(function($) {
    // Desktop hover
    $('.menu-item-has-children').hover(function() {
        $(this).find('.mega-menu-container').stop(true, true).fadeIn(200);
    }, function() {
        $(this).find('.mega-menu-container').stop(true, true).fadeOut(200);
    });
    
    // Mobile click
    $('.menu-item-has-children > a').on('click', function(e) {
        if ($(window).width() < 768) {
            e.preventDefault();
            $(this).parent().toggleClass('menu-open');
            $(this).next('.mega-menu-container').slideToggle();
        }
    });
});