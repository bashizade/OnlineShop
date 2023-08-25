<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/slick/slick-theme.css') }}">
</head>
<body>
@include('layouts.header')
<div class="pt-20 flex justify-center">
    <div class="max-w-screen-lg w-full">
        @yield('content')
    </div>
</div>
@include('layouts.footer')
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('assets/jquery.js') }}"></script>
<script src="{{ asset('assets/slick/slick.min.js') }}"></script>
<script>
    $('.carousel').slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        arrows: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
</script>
</body>
</html>
