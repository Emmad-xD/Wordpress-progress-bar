jQuery(document).ready(function($) {
    // Get the page height
    var pageHeight = $(document).height() - $(window).height();

    // Update the progress bar on scroll
    $(window).scroll(function() {
        var scrollTop = $(window).scrollTop();
        var progress = (scrollTop / pageHeight) * 100;
        $('#page-progress-bar').css('width', progress + '%');
    });
});
