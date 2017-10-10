<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="google-site-verification" content="NnHxDdylNrp6Gsq8LzzMpw16PplxKGFOg21qQKfmYpA" />
    <meta name='wmail-verification' content='3f13e32074bf473ff71038e25d30c912' />
    <meta name="description" content="{{ $meta_description or 'About me ' }}">
    <meta name="author" content="{{ config('blog.author') }}">
    <title>{{ $title or config('blog.title') }}</title>
    {{-- Styles --}}
    <link href="{{ url('/css/app.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{url('/css/style.css')}}" rel="stylesheet" >
    @yield('styles')

    {{-- HTML5 Shim and Respond.js for IE8 support --}}
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <![endif]-->
</head>
<body>

@yield('page-header')
<header>
    <div class="row">
        <div class="container">
        <div  style="display: block; float: right;">
 <h2> Тел: 53567227</h2>
        </div>
        </div>

    </div>
</header>


@yield('content')


{{-- Scripts --}}
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@yield('scripts')

</body>
</html>