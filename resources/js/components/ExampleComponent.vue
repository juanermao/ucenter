<template>
    <i-input :value.sync="value" placeholder="请输入..." style="width: 300px"></i-input>
</template>
<script>
    export default {
        data () {
            return {
                value: ''
            }
        }
    }
</script>
