import { formReqAjax, ajaxReq } from './function';

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
                $(`#status-${id}`).html(res.status);
                if (parseInt(res.progress) === 100) {
                    $(`#popover-${id}`).remove();
                }
            });
        });
    });

    $('.view-detail').click(function () {
        const id = $(this).data('id');
        ajaxReq({ url: `goals/${id}`, dataType: "html"}, res => {
            $(res).modal('show');
        });
    });

    $('body').on('click', '.close-modal', e => {
        $('#modal-detail-goal').remove();
        $('.modal-backdrop').remove();
    });

    $('body').on('hidden.bs.modal', '#modal-detail-goal', function () {
        $('#modal-detail-goal').remove();
        $('.modal-backdrop').remove();
    });

    $('.comment-goal').on('keyup', function (e) {
        if (e.keyCode === 13) {
            e.preventDefault();
            const $this = $(this),
                  goal_id = $this.data('goal-id');

            formReqAjax($(`#comment-goal-${goal_id}`), {
                url: 'comments',
                dataType: "html",
            }, res => $('#append-comment-'+goal_id).html(res));
        }
    });
});