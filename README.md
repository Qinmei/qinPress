# 3.0版本

此套主题主要是将 wordpress 改造成纯api的站点，以便实现前后端分离的技术栈，目前的进度已经大致完成，唯一的问题就是需要安装 JWT token 插件，具体的请查看 <a href='https://github.com/qinvz/qinPress/wiki'>wiki</a> 的安装说明。

**主要注意的是本主题仅为后台，前台主题请自行编写。**

### 功能介绍

1. 豆瓣api需要注册获取密钥, 暂时不可用

4. 用户云端历史纪录，收藏记录，点赞记录等等。

5. 前后端分离，针对wordpress进行了大量的定制化，使其成为一个纯api输出的后台，前台因此可以部署在各个地方.
### 主题大致结构

|----主题结构示例<br />
|----api.qinmei.video&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//wp主站点，提供api后台管理等等<br />
|----www.qinmei.video&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//PC主站点，电脑访问自动跳转<br />
|----m.qinmei.video&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//移动端主题站点，自动跳转<br />
