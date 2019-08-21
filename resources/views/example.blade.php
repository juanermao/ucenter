<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="X-CSRF-TOKEN" content="{{csrf_token()}}">
    <title>用户登录</title>
</head>
<body>

<div id="app">
    <login-component></login-component>
</div>
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ mix('js/util.js') }}"></script>

</body>
</html>