<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>喵特曼 - 首页</title>
    <style>
        #app {
            width: 1000px;
            height: 100%;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div id="app">
        <index-header-component></index-header-component>
        <index-carousel-component></index-carousel-component>
        <index-main-component></index-main-component>
        <index-footer-component></index-footer-component>
    </div>

    <script src="{{ mix('js/util.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>