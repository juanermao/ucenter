<style>
    .publicize {
        height: 80px;
        background-color: #c6c8ca;
    }

    .title span {

    }

    .title a {
        float: right;
    }

    .recommend {
        margin-bottom: 15px;
    }

    .card-list {
        /*margin-bottom: -10px;*/
    }

    .cover {
        text-align: center;
        margin-bottom: 10px;
    }

    .cover img {
        width: 80%;
    }



</style>

<template>
    <div>
        <Row class="recommend">
            <Col span="24">
                <Card class="card-list">
                    <p class="title" slot="title"><span>新作来袭</span> <a href="">查看更多</a></p>
                    <Row>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_1.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_1.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_1.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_1.jpeg"></Col>
                    </Row>

                    <Row>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_1.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_1.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_1.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_1.jpeg"></Col>
                    </Row>
                </Card>
            </Col>
        </Row>

        <Row class="recommend">
            <Col span="24">
                <Card class="card-list">
                    <p class="title" slot="title"><span>热门完结</span> <a href="">查看更多</a></p>
                    <Row>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_2.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_2.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_2.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_2.jpeg"></Col>
                    </Row>

                    <Row>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_2.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_2.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_2.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_2.jpeg"></Col>
                    </Row>
                </Card>
            </Col>
        </Row>

        <Row>
            <div class="publicize recommend"></div>
        </Row>

        <Row class="recommend">
            <Col span="24">
                <Card class="card-list">
                    <p class="title" slot="title"><span>本周推荐</span> <a href="">查看更多</a></p>
                    <Row>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_3.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_3.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_3.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_3.jpeg"></Col>
                    </Row>

                    <Row>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_3.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_3.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_3.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_3.jpeg"></Col>
                    </Row>
                </Card>
            </Col>
        </Row>

        <Row>
            <div class="publicize recommend"></div>
        </Row>

        <Row class="recommend">
            <Col span="24">
            <Card class="card-list">
                <p class="title" slot="title"><span>经典必看</span> <a href="">查看更多</a></p>
                <Row>
                    <Col class="cover" span="6"><img src="/images/xiaoxin_4.jpeg"></Col>
                    <Col class="cover" span="6"><img src="/images/xiaoxin_4.jpeg"></Col>
                    <Col class="cover" span="6"><img src="/images/xiaoxin_4.jpeg"></Col>
                    <Col class="cover" span="6"><img src="/images/xiaoxin_4.jpeg"></Col>
                </Row>

                <Row>
                    <Col class="cover" span="6"><img src="/images/xiaoxin_4.jpeg"></Col>
                    <Col class="cover" span="6"><img src="/images/xiaoxin_4.jpeg"></Col>
                    <Col class="cover" span="6"><img src="/images/xiaoxin_4.jpeg"></Col>
                    <Col class="cover" span="6"><img src="/images/xiaoxin_4.jpeg"></Col>
                </Row>
            </Card>
            </Col>
        </Row>

        <Row class="recommend">
            <Col span="24">
                <Card class="card-list">
                    <p class="title" slot="title"><span>高分作品</span> <a href="">查看更多</a></p>
                    <Row>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_2.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_2.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_2.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_2.jpeg"></Col>
                    </Row>

                    <Row>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_2.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_2.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_2.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_2.jpeg"></Col>
                    </Row>
                </Card>
            </Col>
        </Row>

        <Row class="recommend">
            <Col span="24">
                <Card class="card-list">
                    <p class="title" slot="title"><span>人气连载</span> <a href="">查看更多</a></p>
                    <Row>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_2.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_2.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_2.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_2.jpeg"></Col>
                    </Row>

                    <Row>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_2.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_2.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_2.jpeg"></Col>
                        <Col class="cover" span="6"><img src="/images/xiaoxin_2.jpeg"></Col>
                    </Row>
                </Card>
            </Col>
        </Row>
    </div>
</template>
<script>
    export default {

    }
</script>