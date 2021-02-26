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
