# 用户 #

## 接口: ##
    全局参数:ticket 识别登录状态
    标* 为必须参数

#### 获取信息 ####
    url/ajax/user/profile/info
#### 参数: ####
       ticket  *
#### 返回 ####
    {
        "errno": 0,
        "errmsg": "ok",
        "data": {
            "uid": "1",
            "nickname": "刘神马",
            "head_img": "1.jpg",
            "twitter": "这是Twitter",
            "introduction": "这是简介",
            "area": "210882",
            "area_desc":"营口市"
            "profession": "2",
            "profession_desc":"互联网"
            "company": "滴滴",
            "job": "php开发",
            "school": "大连工业",
            "major": "纺织工程",
            "reg_ip": "",
            "login_ip": "",
            "createtime": "0",
            "updatetime": "0"
        }
    }


#### 修改信息 ####
    url/ajax/user/profile/edit
#### 参数: ####
       ticket *
       `nickname`  '昵称',
       `head_img`  '头像url',
       `twitter`  '说说',
       `introduction`  '个人简介',
       `area`  '地区',
       `profession`  '行业',
       `company`  '公司',
       `job` '职业',
       `school` '学校',
       `major` '专业',
#### 返回 ####
    {
        "errno": 0,//非0报错
        "data": "",//
        "errmsg": "ok"//错误提示
    }