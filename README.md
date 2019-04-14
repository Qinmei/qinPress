# 3.0版本

此套主题主要是将 wordpress 改造成纯api的站点，以便实现前后端分离的技术栈，目前的进度已经大致完成，唯一的问题就是需要安装 JWT token 插件，具体的请查看 <a href='https://github.com/qinvz/qinPress/wiki'>wiki</a> 的安装说明。

**主要注意的是本主题仅为后台，前台主题请自行编写。**

### 功能介绍

1. 批量导入番剧，同时自动获取bangumi的番剧信息，包括评分以及剧集信息等等，另外大部分的番剧还可自动获取来自爱奇艺，B站，腾讯等网站的播放连接，方便解析使用。

2. 创建番剧时可一键搜索其他来源的网址，还可获取bangumi的剧集信息，支持获取爱奇艺等播放连接。

3. 批量更新番剧播放链接。

4. 用户云端历史纪录，收藏记录，点赞记录等等。

5. 前后端分离，针对wordpress进行了大量的定制化，使其成为一个纯api输出的后台，前台因此可以部署在各个地方，同时把图库分离出来，抛弃wp自带的上传接口。理论上来说，这样无论是开发小程序亦或者是app或者什么的都很方便。

### 主题大致结构

|----主题结构示例<br />
|----api.qinmei.video&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//wp主站点，提供api后台管理等等<br />
|----img.qinmei.video&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//图库站点，提供api上传图片等服务<br />
|----www.qinmei.video&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//PC主站点，电脑访问自动跳转<br />
|----m.qinmei.video&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//移动端主题站点，自动跳转<br />
