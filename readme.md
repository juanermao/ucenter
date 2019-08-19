# 用户中心

## 描述
此文档用于应用使用用户中心的登录功能。在平台申请对应的appid、appSecret参数后即可开始接入流程。

## 基本流程
1. 第三方发起"用户中心授权登录"请求，用户中心会重定向到第三方网站，并且带上授权临时票据code参数；
2. 通过code参数加上appid和appSecret等，通过API换取access_token;
3. 通过access_token进行接口调用，获取用户基本数据资源；

## 第一步：请求code
- 第三方使用网站应用授权，可以通过在PC端打开以下链接：
```
http://ucenter.miaoteman.com/auth/login?redirect_url=http://test.ucenter.com/api/third/callback
```

- redirect_url即为登录成功后需要跳转的三方应用地址，若用户登录成功后，将会重写向到redirect_url的见地上，并且带上code参数

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

### 返回说明
```json
    111
```

## 第三步：根据access_token获取用户信息