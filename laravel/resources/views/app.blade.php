<!DOCTYPE html>
<html lang="ja">
<head>
    @if(env('APP_ENV') == 'production')
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-183933310-2"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'UA-183933310-2');
        </script>
    @endif
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Goal & Dairy | @yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="https://asakotsu.s3-ap-northeast-1.amazonaws.com/images/favicon.ico">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <div class="loading hide">
        <div class="hm-spinner"></div>
    </div>
    @yield('content')
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{ mix('js/app.js') }}"></script>
@yield('script')
<script>
    @if (session('msg_success'))
    $(function () {
        toastr.success('{{ session('msg_success') }}');
    });

    @elseif (session('msg_error'))
    $(function () {
        toastr.error('{{ session('msg_error') }}');
    });
    @elseif (session('msg_warning'))
    $(function () {
        toastr.warning('{{ session('msg_warning') }}');
    });
    @endif

    $(function () {
        $('[data-toggle="popover"]').each((index, item) => {
            const form = $(item).find('form');
            $(item).popover({
                html : true,
                content: function() {
                    form.removeClass('d-none');
                    return form;
                }
            });
        });
    })
</script>

</body>
</html>
