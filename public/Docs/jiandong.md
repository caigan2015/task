タスク公众号H5应用接口文档
==================

[TOC]

- 文档访问地址

```json
http://120.146.79.180/Docs/jiandong.html
```

- 接口访问地址

```json
http://120.146.79.180
```

## **接口调用规则**
**请求头部(header)**
`除获取令牌接口外，所有接口必须在请求头部携带TOKEN`
```json
#参数名：token    值：633e83d9303e40cbff6ea81d468379dd
```
**请求主体(body)**
```json
# 请求格式  json
# 请求例子
# {
#        "param1": "value1",
#        "param2": "value2",
#        "param3": "value3",
#        ……
# }
#
#
# 返回格式 JSON
# 返回字段
#     * 请参考相应命令字说明
# 返回例子1:查询结果
#    {
#        "字段 1": "值 1",
#        "字段 2": "值 2",
#        "字段 3": "值 3",
#       ……
#    }
#
#返回例子2:操作结果
#    {
#      "msg": "success",
#      "error_code": 0,                     //参考错误码表
#      "request_url": "/api/v1/user/save"    //接口访问路径
#    }
#

```

## **1、用户登录获取令牌** 
`/api/v1/token/user`
- 请求方法：POST
- 请求参数

```json
code                        #网页授权码 （必要）
```
- 返回参数

```json
token                        #令牌
```
## **2、获取用户信息** 
`/api/v1/user/info`
- 请求方法：GET
- 请求参数：无

- 返回参数

```json
username                    #用户名
mobile                      #手机号码
sex                         #性别
country                     #所在国家
province                    #所在省份
city                        #所在城市
head_img                    #头像
is_member                   #是否会员
register_time               #注册时间
last_login_time             #上次登录时间
member_status               #会员状态 0：非会员；1：正常会员；2：因其它原因被管理员禁用的会员；3：过期会员
member_expire_time          #会员有效期
```
## **3、用户修改个人信息** 
`api/v1/user/save`
- 请求方法：POST
- 请求参数

```json
username                    #用户名（非必要，字符长度4~25）
sex                         #性别（非必要）1：男；2：女；0：保密
head_img                    #头像（非必要）
```
- 返回参数

```json
error_code                   #状态 参考错误码表
msg                          #提示    
request_url                  #接口名
```
## **4、获取手机验证码** 
`api/v1/identify/code`
- 请求方法：POST
- 请求参数

```json
phone                       #手机号码
```
- 返回参数

```json
error_code                   #状态 参考错误码表
msg                          #提示    
request_url                  #接口名                  
```
## **5、关联(绑定)手机号** 
`api/v1/user/bind`
- 请求方法：POST
- 请求参数

```json
phone                       #手机号（必要）
code                        #验证码（必要）
```
- 返回参数

```json
error_code                   #状态 参考错误码表
msg                          #提示    
request_url                  #接口名                  
```
## **6、获取球员信息** 
`api/v1/member/info`
- 请求方法：GET
- 请求参数：无

- 返回参数

```json
cn_name                         #中文名
birthday                        #出生日期
birth_addr                      #出生地点
mobile                          #手机号码
age                             #年龄
sex                             #性别
stature                         #身高
weight                          #体重
native_place                    #籍贯
nation                          #民族
photo                           #个人近照
individual                      #个人简介
team                            #所属球队
number                          #球衣号码
position                        #位置
school                          #学校
experience                      #成长经历
feature                         #技术特点 
honor                           #人个荣誉
comment                         #评价
```
## **7、获取球员赛事列表(手风琴)**
`api/v1/competition/by_member`
- 请求方法：GET
- 请求参数

- 返回参数

```json
name                            #球队名称
logo                            #球队LOGO
competitions{
    id                          #赛事id
    title                       #赛事标题
    main_img_url                #赛事封面照
    play_time                   #赛事时间
}
```
## **8、加入会员业务介绍** 
`api/v1/business/joinus`
- 请求方法：GET
- 请求参数

- 返回参数

```json
id                              #业务ID
s_id                            #业务分类ID
title                           #业务标题
cost                            #原价
price                           #现价
content                         #内容
remark                          #备注
num                             #编号
valid_time                      #有效期（年）
amount                          #库存数
specs                           #规格
people                          #享有人数
audit_time                      #审核时间（暂无关）
istui                           #是否热销业务
```
## **9、提交订单** 
`api/v1/order/commit`
- 请求方法：POST
- 请求参数

```json
business_id                     #业务ID（必要）
name                            #订单标题（非必要）
```
- 返回参数

```json
id                              #订单ID
order_no                        #订单号
total_price                     #应付金额
name                            #订单标题
create_time                     #订单提交时间
```

## **10、订单取消** 
`api/v1/order/cancel`
- 请求方法：POST
- 请求参数

```json
id                     #订单ID（必要）
```
- 返回参数

```json
error_code                   #状态 参考错误码表
msg                          #提示    
request_url                  #接口名               
```
## **11、订单详情** 
`api/v1/order/:id`
- 请求方法：GET
- 请求参数：加在uri中，如api/v1/order/1 代表获取id为1的订单详情

```json
id                     #订单ID（必要，加在uri中）
```
- 返回参数

```json
id                              #订单ID
order_no                        #订单号
count                           #业务数量
price                           #业务单价
business_id                     #业务ID
name                            #订单标题
pay_amount                      #订单支付金额
pay_time                        #支付时间
pay_way                         #支付方式
remark                          #备注
status                          #订单状态
coupon                          #优惠券
phone                           #预留手机号码
discounts                       #优惠金额
snap_items                      #业务快照
create_time                     #提交订单时间
```

## **12、关闭订单** 
`api/v1/order/close`
- 请求方法：POST
- 请求参数

```json
id                     #订单ID（必要）
```
- 返回参数

```json
error_code                   #状态 参考错误码表
msg                          #提示    
request_url                  #接口名               
```
## **13、获取当前用户所有订单**
`api/v1/order/by_user`
- 请求方法：GET
- 请求参数：无

- 返回参数


```json
id                              #订单ID
order_no                        #订单号
count                           #业务数量
price                           #业务单价
business_id                     #业务ID
name                            #订单标题
pay_amount                      #订单支付金额
pay_time                        #支付时间
pay_way                         #支付方式
remark                          #备注
status                          #订单状态
coupon                          #优惠券
phone                           #预留手机号码
discounts                       #优惠金额
create_time                     #提交订单时间
```

## **14、订单支付**
`api/v1/pay/pre_order`
- 请求方法：POST
- 请求参数

```json
id                     #订单ID（必要）
```

- 返回参数

```json
timestamp                         #时间戳
nonceStr                          #随机字符串
package                           #订单详情扩展字符串
signType                          #签名方式
paySign                           #签名
```
## **15、支付回调**
`api/v1/pay/notify`
- 请求方法：POST
- 请求参数：由微信发起

- 返回参数

```json
true
```
## **16、提交意见反馈**
`api/v1/feeds`
- 请求方法：POST
- 请求参数

```json
type                              #类型：1建议，2投诉，3其它(非必要，默认建议)
phone                             #手机号码(非必要)
title                             #标题(非必要)
content                           #内容(必要)
```

- 返回参数

```json
error_code                   #状态 参考错误码表
msg                          #提示
request_url                  #接口名
```

## **17、赛事详情**
`api/v1/competition/:id`
- 请求方法：GET
- 请求参数：加在uri中，如api/v1/competition/1 代表获取id为1的赛事详情

- 返回参数

```json
id                                  #赛事ID
title                               #赛事标题
summary                             #赛事简介
description                         #赛事数据详情
score                               #赛事结果
main_img_url                        #封面照
play_time                           #比赛时间
notes                               #备注
is_hot                              #是否热门赛事
```
## **18、即将开始的赛事列表（分页）**
`api/v1/competition/begins`
- 请求方法：GET
- 请求参数：无

- 返回参数

```json
current_page                            #当前页码数
total                                   #总数
data
    id                                  #赛事ID
    title                               #赛事标题
    summary                             #简介
    main_img_url                        #封面照
    play_time                           #比赛时间
    apply_status                        #报名状态
```

## **19-1、提交赛事报名**
`api/v1/competition/apply/commit`
- 请求方法：POST
- 请求参数：

```json
id                              #赛事ID
```

- 返回参数

```json
error_code                   #状态 参考错误码表
msg                          #提示
request_url                  #接口名
```
## **19-2、取消赛事报名**
`api/v1/competition/apply/cancel`
- 请求方法：POST
- 请求参数：

```json
id                              #赛事ID
```

- 返回参数

```json
error_code                   #状态 参考错误码表
msg                          #提示
request_url                  #接口名
```

## **20、赛事历史播放列表（分页）**
`api/v1/competition/video`
- 请求方法：POST
- 请求参数：
- GET请求：uri+'?page=1&size=30'
```json
page                                        #当前页码 默认1
size                                        #每页显示条数 默认30
```
- POST请求
```json
search                                      #搜索关键字 (非必要)
competition_id                              #赛事ID (非必要)
type                                        #播放类型 1回放;2集锦 (非必要)
```

- 返回参数

```json
current_page                            #当前页码数
total                                   #总数
data
    id                                        #视频ID
    title                                     #视频标题
    summary                                   #简介
    main_img_url                              #封面照
    competition_id                            #赛事ID
    browse_num                                #观看次数
    type                                      #视频类型
    publish_time                              #发布时间
    file
        cate                                  #文件类型
        name                                  #资源路径
        original                              #文件名
        size                                  #文件大小
```

## **21、获取广告位**
`api/v1/banner/:id`
- 请求方法：GET
- 请求参数：加在uri中，如api/v1/order/1 代表获取id为1的广告位内容

- 返回参数

```json
id                                              #广告位ID
title                                           #标题
description                                     #描述
position                                        #广告位置
img_url                                         #图片路径
jump_url                                        #链接
img
    cate                                        #文件类型
    name                                        #图片路径
    original                                    #原文件名
    size                                        #图片大小
```
## **22、获取轮播图**
`api/v1/banner/by_position`
- 请求方法：POST
- 请求参数：

```json
id                              #广告位位置 1,球员中心,2,赛事中心,3,资讯中心,
```

- 返回参数

```json
id                                              #广告位ID
title                                           #标题
description                                     #描述
position                                        #广告位置
img_url                                         #图片路径
jump_url                                        #链接
img
    cate                                        #文件类型
    name                                        #图片路径
    original                                    #原文件名
    size                                        #图片大小
```

## **23、获取赛事直播列表（分页）**
`api/v1/competition/live`
- 请求方法：POST
- 请求参数：
- GET请求：uri+'?page=1&size=30'
```json
page                                        #当前页码 默认1
size                                        #每页显示条数 默认30
```
- POST请求
```json
search                                      #搜索关键字 (非必要)
competition_id                              #赛事ID (非必要)
```

- 返回参数

```json
current_page                                  #当前页码数
total                                         #总数
data
    id                                        #视频ID
    title                                     #视频标题
    summary                                   #简介
    main_img_url                              #封面照
    competition_id                            #赛事ID
    browse_num                                #观看次数
    play_rtmp                                 #RTMP格式播放地址
    play_flv                                  #FLV格式播放地址
    play_m3u8                                 #M3U8格式播放地址
    plug_flow                                 #推流地址
    type                                      #类型 3  直播
    live_status                               #当前直播状态
    online_num                                #当前直播在线人数
```


## **24、进入播放后的回调操作（增加浏览量）**
`api/v1/competition/play_notify`
- 请求方法：POST
- 请求参数：

```json
id                              #播放源ID
type                            #播放源：1：录像；2：直播
```

- 返回参数

```json
error_code                   #状态 参考错误码表
msg                          #提示
request_url                  #接口名
```

## **25、获取在线直播人数**
`api/v1/competition/online`
- 请求方法：GET
- 请求参数：加在uri中，如api/v1/competition/online/1 代表获取id为1的直播源ID

- 返回参数

```json
TotalUserNumber                   #总人数
OnlineUserInfo
    LiveStreamOnlineUserNumInfo(数组)
      Time                        #时间(UTC格式)
      StreamUrl                   #推流资源路径
      UserNumber                  #在线人数
RequestId                         #访问ID
```

## **26、直播聊天室**
 URL:`ws://120.79.146.180:19833`
- 收发消息体(json格式)：
1(群发)、'{"type":"SEND_ALL","room_id":"1","uuid":"MC4wLjAuMF8xOTgzMl82","content":"扑街","user":{"username":"caicaizi","head_img":"http://www.michellelee.top/tmp/upload/20180105/dsfadfafadfa.jpg"},"msg_time":235433453,"myself":true,"token":token}';
2(私聊)、'{"type":"SEND_ONE","room_id":"1","uuid":"MC4wLjAuMF8xOTgzMl82","send_to_one":"MC4wLjAuMF8xOTgzMl82","content":"扑街","username":"caicaizi","head_img":"http://www.michellelee.top/tmp/upload/20180105/dsfadfafadfa.jpg","msg_time":235433453,"myself":true}';

- 备注：

```json
type                                    #"LOGIN": 上线;"LOGOUT":下线;"SEND_ALL":群发(默认);"SEND_ALL": 私聊(用不上)
room_id                                 #可用直播源ID代替
content                                 #消息内容
user                                    #json格式：username用户名,head_img用户头像
uuid                                    #用户当前连接的唯一身份标识
send_to_one                             #收消息用户当前连接的唯一身份标识
msg_time                                #消息时间
myself                                  #是否本人（收到消息）
token                                   #令牌    （发送消息,那条获取在线人数的看不见的消息不用传）
```

## **27、视频详情**
`api/v1/competitionvideo/:id`
- 请求方法：GET
- 请求参数：加在uri中，如api/v1/competitionvideo/1 代表获取id为1的视频详情

```json
id                                #订单ID（必要，加在uri中）
```
- 返回参数

```json
id                                #视频ID
title                             #标题
summary                           #简介
competition_id                    #赛事ID
main_img_url                      #封面路径
browse_num                        #打开数量
type                              #类型
publish_time                      #发布时间
file

    cate                            #文件分类
    name                            #视频链接
    original                        #文件原名
    size                            #文件大小
```

## **28、直播详情**
`api/v1/competitionlive/:id`
- 请求方法：GET
- 请求参数：加在uri中，如api/v1/competitionlive/1 代表获取id为1的直播详情

```json
id                                #直播ID（必要，加在uri中）
```
- 返回参数

```json
id                                #直播ID
title                             #标题
summary                           #简介
competition_id                    #赛事ID
main_img_url                      #封面路径
browse_num                        #打开数量
play_rtmp                         #rtmp格式播放链接
play_flv                          #flv格式播放链接
play_m3u8                         #m3u8格式播放链接
publish_time                      #发布时间
type                              #类型 3  直播
live_status                       #当前直播状态
```

## **29、获取会员参与过的所有球队列表**
`api/v1/team/by_user`
- 请求方法：GET
- 请求参数：无

- 返回参数

```json
id                                  #球队ID
name                                #球队名称
logo                                #球队LOGO
```

## **30、根据球队ID获取球队参与过的赛事列表**
`api/v1/team/:id/competitions`
- 请求方法：GET
- 请求参数：加在uri中，如api/v1/team/1/competitions 代表获取球队id为1的赛事列表

```json
id                                #球队ID（必要，加在uri中）
```
- 返回参数

```json
id                                #赛事ID
title                             #标题
main_img_url                      #封面路径
```

## **31、获取微信js接口调用前的配置信息**
`api/v1/wxconfig`
- 请求方法：POST
- 请求参数：

```json
cur_url                                #调用接口的页面路径
```
- 返回参数

```json
appId                               #APPID
nonceStr                            #随机字符串
timestamp                           #时间戳
url                                 #页面路径
signature                           #签名
rawString                           #原始字符串
access_token                        #令牌
```

## **32、搜索播放资源列表（直播与回放）**
`api/v1/competition/play`
- 请求方法：POST
- 请求参数：
- GET请求：uri+'?page=1&size=30'
```json
page                                        #当前页码 默认1
size                                        #每页显示条数 默认30
```
- POST请求
```json
search                                      #搜索关键字 (必要)
```
- 返回参数

```json
current_page                                  #当前页码数
total                                         #总数
data

//直播
    id                                        #视频ID
    title                                     #视频标题
    summary                                   #简介
    main_img_url                              #封面照
    competition_id                            #赛事ID
    browse_num                                #观看次数
    play_rtmp                                 #RTMP格式播放地址
    play_flv                                  #FLV格式播放地址
    play_m3u8                                 #M3U8格式播放地址
    plug_flow                                 #推流地址
    type                                      #类型 3  直播
    live_status                               #当前直播状态

//回放
   id                                        #视频ID
   title                                     #视频标题
   summary                                   #简介
   main_img_url                              #封面照
   competition_id                            #赛事ID
   browse_num                                #观看次数
   type                                      #视频类型
   publish_time                              #发布时间
   file
       cate                                  #文件类型
       name                                  #资源路径
       original                              #文件名
       size
```

## **33、获取页面配置项值**
`api/v1/config/value`
- 请求方法：POST
- 请求参数：
```json
code                                        #配置编码（必要,可以单个——字符格式""，也可以是多个——数组格式["",""……]）
tags                                        #是否去除html标签（必要）"1/0"
```

- 返回参数
```json
value                                       #配置值
或
code                                        #配置编码
value                                       #配置值
```

## **34、聊天记录**
`api/v1/guest/:id`
- 请求方法：GET
- 请求参数：加在uri中，如api/v1/guest/1 代表获取直播id为1的聊天列表

```json
id                                #直播ID（必要，加在uri中）
```

```json
type                                    #"LOGIN": 上线;"LOGOUT":下线;"SEND_ALL":群发(默认);"SEND_ONE": 私聊(用不上)
room_id                                 #可用直播源ID代替
content                                 #消息内容
user                                    #json格式：username用户名,head_img用户头像
msg_time                                #消息时间
myself                                  #是否本人（收到消息）
```

## **HTTP状态码**
```
200                          请求成功
201                          已创建
202                          已经接受请求，但未处理完成
204                          无内容
205                          服务器处理成功
301                          请求的资源已被永久的移动到新URI
400                          错误请求
401                          未授权
403                          禁止
404                          请求的资源（网页等）不存在
500                          内部服务器错误
```

## **错误码**
```
0				操作成功

99999				参数错误

10000				操作错误
10001				权限不够
10002				身份验证失败
10003				Token已过期或无效Token
10004				用户不存在或被禁用
10005				订单与用户不匹配
10006				手机号码已被其他人使用
10007				验证码错误
10008				授权失败
10009				手机验证吗不存在
10010				用户重复发送验证码
10011				当前用户未绑定手机号码

20000				业务不存在或已禁用
20001				业务类别不存在
			
30000				赛事不存在
30001				球队信息不存在
30002				会员信息不存在或已被禁用
30003				当前会员未加入任何球队
30004				赛事视频不存在
30005				赛事直播不存在
30006				当前球队未参与任何赛事
30007				重复提交赛事报名
30008				赛事报名不存在

40000				指定图片不存在
40001				保存图片失败
40002				请求banner不存在
40003				请求轮播图片不存在
40004				请求配置不存在

50000				微信服务器异常

60000				订单不存在
60001				订单已经支付过
60002				订单不允许取消
60003				订单不允许关闭
60004				用户收货地址不存在，下单失败
60005				还没付款或者你已经更新过订单
60006				商品不存在，订单创建失败
60007				没有权限更改订单状态

70000				发送短信失败
80000               阿里云服务器异常

```