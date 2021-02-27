import { formReqAjax } from './function';

$(function () {
    $('.form-update-progress').each((idx, formEl) => {
        const form = $(formEl);
        const id = form.attr('id').split('-')[1];
        form.on('submit', function (e) {
            e.preventDefault();
            formReqAjax(form, {
                url: `update-progress/${id}`,
                method: 'POST',
            }, res => {
                $(`#progress-${id}`).text(parseInt(res.progress) + '%').css({
                    width: `${parseInt(res.progress)}%`,
                }).removeClass().addClass(`progress-bar ${res.color}`);
                
                $('.popover').removeClass('show');
                form.find('button[type="submit"]').prop('disabled', false);
            });
        });
    });
})