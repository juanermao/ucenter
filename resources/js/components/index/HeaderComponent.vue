<style>
    #header {
        height: 50px;
    }

    #logo {
        width: 20%;
        height: 100%;
        float: left;
        font-size: 35px;
        color: #2d8cf0;
    }

    #search {
        width: 20%;
        height: 100%;
        float: right;
    }

    .searchItem {
        margin: 8px 0;
    }
</style>

<template>
    <div id="header">
        <div id="logo">LOGO GO</div>
        <div id="search">
            <Input class="searchItem" search placeholder="搜索作品名/作者名" />
        </div>
    </div>
</template>

<script>
    import utilJs from '../../util'
    export default {
        data () {
            return {
            }
        },
        created () {
            this.renderPage();
        },
        methods: {
             renderPage() {
                 let ts = Date.parse(new Date())/1000;
                 let api_token = utilJs.methods.getCookie('api_token');
                let params = {"api_token": api_token, "ts": ts};
                 axios.get('/api/user/info', { params: params })
                    .then((response) => {
                        if (response.data.errno === 401) {
                            location.href = '/auth/login';
                            return;
                        }

                        if (response.data.errno !== 0) {
                            this.$Message.error( response.data.errmsg );
                            return;
                        }

                        this.$message.success('登录成功');
                    })
                    .catch((error) => {
                        if (error.response.status === 401) {
                            location.href = '/auth/login';
                            return;
                        }

                        if (error.response.status !== 200) {
                            this.$Message.error('服务器错误，请稍后重试！');
                            return;
                        }
                    });
            },
        },
    }
</script>