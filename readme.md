# 用户中心

## 描述
此文档用于应用使用用户中心的登录功能。在平台申请对应的appid、appSecret参数后即可开始接入流程。

## 基本流程
1. 接入方发起"用户中心授权登录"请求，用户中心会重定向到接入方提供的redirect_url地址上，并且带上授权临时票据code参数；
2. 通过code参数加上appid和appSecret等，通过API换取access_token;
3. 通过access_token进行接口调用，获取用户基本数据资源；

## 第一步：请求code
### 请求地址
- http://ucenter.miaoteman.com/auth/login

### 请求方式
- GET

### 参数说明
|参数名|必选|类型|说明|
|:---- |:---|:----- |-----       |
|appid |是  |string | 分配的appid |
|redirect_url  |是  |string | 请使用urlEncode对链接进行处理 |
|state | 否 | string| 用于保持请求和回调的状态，授权请求后原样带回给第三方|

## 第二步：根据code获取access_token
### 请求地址
- http://ucenter.miaoteman.com/api/auth/getAccessToken

### 请求方式
- POST

### 参数说明
|参数名|必选|类型|说明|
|:---- |:---|:----- |-----       |
|appid |是  |string | 分配的appid |
|code  |是  |string | 授权临时票据 |
|ts    |是  |string | 时间戳 |
|sign  |是  |string | 签名 |

### 返回说明
```json
{
    "errno":0,
    "errmsg":"ok",
    "time":1566270590,
    "data":{
      "access_token":"xxxxxxxxxx"
    }
}
```

## 第三步：根据access_token获取用户信息
### 请求地址
- http://ucenter.miaoteman.com/api/auth/userInfo

### 请求方式
- POST

### 参数说明
|参数名|必选|类型|说明|
|:---- |:---|:----- |-----       |
|appid |是  |string | 分配的appid |
|access_token |是  | 授权的access token |  |
|ts    |是  |string | 时间戳 |
|sign  |是  |string | 签名 |

### 返回说明
```json
{
    "errno":0,
    "errmsg":"ok",
    "time":1566293278,
    "data":{
        "id":21,
        "name":"喵星人_1000008",
        "tel":"18510398653",
        "visitor":""
    }
}
```