$(function(){

  $(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() == $(document).height()) {
        const $target = $('a[infinity-scroll]');
        const url = $target.attr('href')
        if (url && !$target.hasClass('hide')) {
          $.get(url, function (data, status) {
            if ($target.prev().hasClass('row')) {
              $target.before(data.html)
            } else {
              $('#append-new-article').append(data.html)
            }
            if (data.next) {
              $target.removeClass('hide');
              $target.attr('href', data.next)
            } else {
              $target.addClass('hide');
            }
          });
        }
    }
 });

  // $(document).on('inview', 'a[infinity-scroll]', function (e, isInView) {
  //   if (isInView) {
  //     e.preventDefault()
  //     const $target = $(e.currentTarget)
  //     const url = $target.attr('href')
  //     if (url) {
  //       $.get(url, function (data, status) {
  //         $target.before(data.html)
  //         if (data.next) {
  //           $target.attr('href', data.next)
  //         } else {
  //           $target.remove();
  //         }
  //       });
  //     }
  //   }
  // });
});
