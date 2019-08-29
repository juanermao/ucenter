<html>
<head>
    <title>喵物曼 - 首页</title>
    <script src="/js/jquery/jquery.js"></script>
    <script src="/js/util.js"></script>
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
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>