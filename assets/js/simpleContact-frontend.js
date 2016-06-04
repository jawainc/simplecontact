
    $(window).on('ajaxBeforeSend', function() {
        $('#simpleContactSubmitButton').prop('disabled',true);
    });
    $(window).on('ajaxUpdateComplete', function() {
        $('#simpleContactSubmitButton').prop('disabled',false);
    });
    $('#simpleContactForm').on('ajaxSuccess', function() {
        document.getElementById('simpleContactForm').reset();
        grecaptcha.reset();
    });
    