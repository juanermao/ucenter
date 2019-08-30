<style>
    .card-login {
        margin: 50px 0 0 0;
    }
</style>

<template>
    <Row
            type="flex"
            justify="center"
            align="middle"
            class="code-row-bg"
    >
        <i-col span="12">
            <Card class="card-login">
                <p slot="title">
                    <Icon type="ios-film-outline"></Icon>
                    用户登录
                </p>

                <i-form
                        :model="formValidate"
                        :rules="ruleValidate"
                        :label-width="80"
                >
                    <Form-item
                            label="手机号"
                            prop="tel"
                    >
                        <i-input
                                v-model="formValidate.tel"
                                placeholder="请输入手机号"
                        ></i-input>
                    </Form-item>

                    <Form-item
                            label="验证码"
                            prop="code"
                    >
                        <i-input
                                v-model="formValidate.code"
                                placeholder="请输入验证码"
                        ></i-input>
                    </Form-item>

                    <Form-item>
                        <i-button
                                type="primary"
                                @click="sendCode"
                        >
                            <span>发送验证码</span>
                        </i-button>

                        <i-button
                                type="success"
                                @click="getCode"
                        >
                            <span>获取验证码</span>
                        </i-button>
                    </Form-item>

                    <Form-item>
                        <i-button
                                type="error"
                                @click="smsLogin"
                                long
                        >登录</i-button>
                    </Form-item>
                </i-form>
            </Card>
        </i-col>
    </Row>
</template>

<script>
    export default {
        data () {
            return {
                formValidate: {
                    tel: '',
                    code: '',
                },
                ruleValidate: {
                    tel: [
                        { required: true, message: '手机号不能为空', trigger: 'blur' }
                    ],
                    code: [
                        { required: true, message: '验证码不能为空', trigger: 'blur' }
                    ],
                }
            }
        },
        methods: {
            sendCode () {
                let ts = Date.parse(new Date())/1000;
                let params = {"tel": this.formValidate.tel, "ts": ts};
                axios.get('/api/sms/send', { params: params })
                .then((response) => {
                    if (response.status !== 200) {
                        this.$Message.error('服务器错误，请稍后重试！');
                        return;
                    }

                    if (response.data.errno !== 0) {
                        this.$Message.error( response.data.errmsg );
                        return;
                    }

                    this.$Message.info( "短信已成功发送！" );
                });
            },
            getCode() {
                let ts = Date.parse(new Date())/1000;
                let params = {"tel": this.formValidate.tel, "ts": ts};
                axios.get('/api/get/sms/code', { params: params })
                    .then((response) => {
                        if (response.status !== 200) {
                            this.$Message.error('服务器错误，请稍后重试！');
                            return;
                        }

                        if (response.data.errno !== 0) {
                            this.$Message.error( response.data.errmsg );
                            return;
                        }

                        this.$Message.info( "验证码为：" + response.data.data.code );
                    });
            },
            smsLogin() {
                let ts = Date.parse(new Date())/1000;
                let params = {"tel": this.formValidate.tel, "code": this.formValidate.code, "ts": ts};
                axios.get('/api/sms/login', { params: params })
                    .then((response) => {
                        if (response.status !== 200) {
                            this.$Message.error('服务器错误，请稍后重试！');
                            return;
                        }

                        if (response.data.errno !== 0) {
                            this.$Message.error( response.data.errmsg );
                            return;
                        }

                        let code = response.data.data.code;

                        this.$Message.info( "登录成功，正在跳转..." );
                        let state = getQueryString('state');
                        let appid = getQueryString('appid');
                        let redirect_url = getQueryString('redirect_url');
                        let ts = Date.parse(new Date())/1000;

                        if (redirect_url) {
                            redirect_url = redirect_url + "?code=" + code + '&appid=' + appid + '&state=' + state + '&ts=' + ts;
                            console.log("===redirect_url===" + redirect_url);
                            location.href = redirect_url;
                        }else{
                            location.href = "/";
                        }
                    });
            },
        }
    }
</script>
