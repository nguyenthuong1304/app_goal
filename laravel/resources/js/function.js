const MAX_SIZE_IMAGE = 2000000;

export const validateFileUpload = file => {
    let error = false;
    if (!validateExtension(file)) {
        error = 'Không đúng định dàng image!';
    } else if (!validateSize(file)) {
        error = "Image không được quá 2mb";
    }

    return error
}

export const validateExtension = file => {
    const allowedExtensions = ["jpg","png","gif", "jpeg"];
    const fileExtension = file.type.split('/').pop().toLowerCase();

    return allowedExtensions.includes(fileExtension);
}

export const validateSize = file => {
    return file.size <= MAX_SIZE_IMAGE;
}

export const readURL = file => {
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            $('img#profileImage').attr('src', e.target.result);
        }

        reader.readAsDataURL(file);
    }
}

export const formReqAjax = (form, req, callbackSuccess, callbackError = null) => {
    $.ajax({
        url: req.url,
        data: form.serialize(),
        dataType: "JSON",
        method: req.method,
        success: res => callbackSuccess(res),
        error: err => {
            const error = err.responseJSON;
            const status = err.status;
            if (status === 422) {
                const errors = error.errors;
                Object.keys(errors).forEach(errorKey => {
                    const input = $(form.find(`[name*="${errorKey}"]`));
                    input.addClass('is-invalid');
                    input.after(`<div class="invalid-feedback">${errors[errorKey][0]}</div>`);
                });
            } else if (status === 403) {
                toastr.warning(error.message);
            } else if (status === 500) {
                callbackError
                    ? callbackError(err)
                    : toastr.warning(error.message);
            }
        }
    });
}
