@include('layout.header')

<style>
    #main {
        width: 100%;
        height: 600px;
        background: #fffacc;
    }

    #login {
        width: 410px;
        height: 400px;
        border: 1px solid #000000;
        position: fixed;
        top: 130px;
        right: 180px;
    }

    #login .title {
        text-align: center;
        font-size: 24px;
        margin: 20px 0 0 0;
    }

    .tel, .smsCode, .smslogin {
        margin: 10px 0 0 10px;
    }

    .tel input, .smsCode input {
        width: 200px;
        height: 25px;
    }

    .sendSms,.getSms, .smslogin{
        margin: 20px 5px 0 10px;
        height: 35px;
        width: 80px;
    }
</style>

<div id="main">
    <div id="login">
        <p class="title">[模拟]手机号登录</p>
        <p class="tel"><span>手机号：</span><input type="text" /></p>
        <p class="smsCode"><span>验证码：</span><input type="text" /></p>
        <p><button class="sendSms">发送验证码</button><button class="getSms">显示验证码</button></p>
        <p><button class="smslogin">登录</button></p>
    </div>
</div>

<script>
    $("#login .sendSms").click(function () {
        var tel = $(".tel input").val();
        var ts = Date.parse(new Date())/1000;
        var params = {"tel": tel, "ts": ts};
        $.get('/api/sms/send', params, function (data) {
            console.log('===send sms===' + data);

            if (data.errno !== 0) {
                alert(data.errmsg);
                return;
            }

            alert('短信发送成功');
        });
    });

    $("#login .getSms").click(function () {
        var tel = $(".tel input").val();
        var ts = Date.parse(new Date())/1000;
        var params = {"tel": tel, "ts": ts};
        $.get('/api/get/sms/code', params, function (data) {
            console.log('===get sms===' + data);

            if (data.errno !== 0) {
                alert(data.errmsg);
                return;
            }

            alert(data.data.code);
        });
    });

    $("#login .smslogin").click(function () {
        var tel = $(".tel input").val();
        var ts = Date.parse(new Date())/1000;
        var code = $(".smsCode input").val();

        var params = {"tel": tel, "code": code, "ts": ts};
        $.get('/api/sms/login', params, function (data) {
            console.log('===sms login===' + data);

            if (data.errno !== 0) {
                alert(data.errmsg);
                return;
            }

            alert('登录成功');
            var code = data.data.code;
            var appid = getQueryString('appid');
            var redirect_url = getQueryString('redirect_url');
            var state = getQueryString('state');
            if (redirect_url) {
                redirect_url = redirect_url + "?code=" + code + '&appid=' + appid + '&state=' + state;
                console.log("===redirect_url===" + redirect_url);
                location.href = redirect_url;
            }else{
                location.href = "/";
            }

        });
    });

</script>

@include('layout.footer')