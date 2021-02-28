const { validateFileUpload, readURL } = require("./function");
$(function() {
    // setup ajax
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: _ => $('.loading').removeClass('hide'),
        complete: _ => $('.loading').addClass('hide'),
        error: err => {
            const error = err.responseJSON;
            const status = err.status;
            if (status === 403) {
                toastr.warning(error.message);
            } else if (status === 500) {
                toastr.warning(error?.message || 'Có lỗi vui lòng thử lại');
            }
        }
    });

    // refresh input validate
    $('body').on('keyup', '.is-invalid', function(e) {
        const form = $($(this).closest('form'));
        $(this).removeClass('is-invalid');
        $(this).next('.invalid-feedback').remove();
        if (!form.find('.is-invalid').length) {
            if (form.find('button[type="submit"]').prop('disabled')) {
                form.find('button[type="submit"]').prop('disabled', false);
            }
        }
    });

    // clear errors message    
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
