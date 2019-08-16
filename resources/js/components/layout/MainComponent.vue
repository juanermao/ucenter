<template>
    <div>
        <el-tabs type="border-card">
            <el-breadcrumb separator-class="el-icon-arrow-right">
                <el-breadcrumb-item :to="{ path: '/' }">首页</el-breadcrumb-item>
                <el-breadcrumb-item>活动管理</el-breadcrumb-item>
                <el-breadcrumb-item>活动列表</el-breadcrumb-item>
                <el-breadcrumb-item>活动详情</el-breadcrumb-item>
            </el-breadcrumb>
            2222
        </el-tabs>
    </div>
</template>

<script>
    export default {
        methods: {
            goBack() {
                console.log('go back');
            }
        }
    }
</script>
