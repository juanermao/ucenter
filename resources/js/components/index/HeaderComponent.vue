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