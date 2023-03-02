// page div's toggle
$(document).ready(function() {
    // hide all divs except the first one on page load
    // $('.content').not(':first').hide();
    // console.log('test');
     $('.content').hide();

    // add click event to navigation links
    $('.nav-item a').click(function(e) {
        e.preventDefault();
        // hide all divs
        $('.content').hide();
        // shows the div with the matching data-target attr
        var target = $(this).data('target');
        $('#' + target).show();
    });
});
