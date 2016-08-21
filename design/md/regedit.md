# 注册 #

### APP 注册 ###
手机号/用户名/邮箱 + 密码 -> 初步验证 -> id_generator 生成用户id
-> 把用户id，账号密码 保存到app_passport ->继续注册把用户id 信息保存到user_profile

### 第三方登录注册 ##
登录成功回调-> id_generator 生成用户id
-> 把用户id，账号密码 保存到XXX_passport ->继续注册把用户id 信息保存到user_profile

# 登录 #
登录验证 -> 取得ticket 


## 接口: ##
    全局参数:ticket 识别登录状态
    标* 为必须参数

#### 注册 ####
    url/ajax/user/passport/regedit
#### 参数: ####
       name 用户名、手机、邮箱 *
       pass 密码 *
       code 验证码
#### 返回 ####
    {
        "errno": 0,//非0报错
        "data": "UjJ4cFJ6WlRObUpyU1ZBdlptSkNjVk01V0dWQmExQTBSVkZKUm0xdWJqSXdhVGt3YVhnME0yVm5WazFDYkhJd2FERkpUVVJSYTNJcmFFbE1ZbEpSUXpaRlprZFFlV0poWldabmJFRnFla1JwTUZWMFpHYzlQUT09",//ticket
        "errmsg": "ok"//错误提示
    }   


#### 注册 ####
    url/ajax/user/passport/login
#### 参数: ####
       name 用户名、手机、邮箱 *
       pass 密码 *
       code 验证码
#### 返回 ####
    {
        "errno": 0,//非0报错
        "data": "UjJ4cFJ6WlRObUpyU1ZBdlptSkNjVk01V0dWQmExQTBSVkZKUm0xdWJqSXdhVGt3YVhnME0yVm5WazFDYkhJd2FERkpUVVJSYTNJcmFFbE1ZbEpSUXpaRlprZFFlV0poWldabmJFRnFla1JwTUZWMFpHYzlQUT09",//ticket
        "errmsg": "ok"//错误提示
    }