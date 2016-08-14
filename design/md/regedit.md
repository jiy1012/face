# 注册 #

### APP 注册 ###
手机号/用户名/邮箱 + 密码 -> 初步验证 -> id_generator 生成用户id
-> 把用户id，账号密码 保存到app_passport ->继续注册把用户id 信息保存到user_profile

### 第三方登录注册 ##
登录成功回调-> id_generator 生成用户id
-> 把用户id，账号密码 保存到XXX_passport ->继续注册把用户id 信息保存到user_profile

# 登录 #
登录验证 -> 取得ticket 
