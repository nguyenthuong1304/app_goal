$(function () {
    $('.form-update-progress').each((idx, formEl) => {
        const form = $(formEl);
        form.on('submit', function (e) {
            e.preventDefault();
            console.log(1)
        });
    });
})