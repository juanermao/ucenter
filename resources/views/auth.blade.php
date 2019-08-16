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

    .tel {
        margin: 10px 0 0 10px;
    }

    .tel input {
        width: 200px;
        height: 25px;
    }

    .sendSms {
        margin: 20px 5px 0 10px;
        height: 35px;
        width: 80px;
    }

    .code {
        font-size: 14px;
        font-weight: bold;
        color: red;
    }
</style>

<div id="main">
    <div id="login">
        <p class="title">[模拟]手机号登录</p>
        <p class="tel"><span>手机号：</span><input type="text" /></p>
        <p><button class="sendSms">发送验证码</button><span>&nbsp;&nbsp;验证码：</span><span class="code"> </span></p>
    </div>
</div>

<script>
    $('#login .sendSms').click(function () {
        var tel = $(".tel input").val();
        if (! tel) {
            alert('手机号不能为空');
            return;
        }

        var params = {"tel": tel};
        $.get('http://test.ucenter.com/api/sms/send', params, function (data) {
            if (data.errno !== 0) {
                alert(data.errmsg);
                return;
            }

            $(".code").html(data.data.code);
        });
    });
</script>

@include('layout.footer')