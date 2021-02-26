const { validateFileUpload, readURL } = require("./function");
$(function() {
    setTimeout(() => {
        $('.alert-danger').fadeOut();
    }, 3000);

    $('#profile_image').change(function () {
        const file = $(this)[0].files[0];
        if ($(this).val()) {
            const inValid = validateFileUpload(file);
            if (inValid) {
                alert(inValid);
                $(this).val(null);
            } else {
                readURL(file);
            }
        }
    });
});
