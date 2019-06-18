# 3.0版本

此套主题主要是将 wordpress 改造成纯api的站点，以便实现前后端分离的技术栈，目前的进度已经大致完成，唯一的问题就是需要安装 JWT token 插件，具体的请查看 <a href='https://github.com/qinvz/qinPress/wiki'>wiki</a> 的安装说明。

**主要注意的是本主题仅为后台，前台主题请自行编写。**

### 功能介绍

1. 豆瓣api目前使用的是第三方代理 可能有失效的风险

2. 用户云端历史纪录，收藏记录，点赞记录等等。

3. 前后端分离，针对wordpress进行了大量的定制化，使其成为一个纯api输出的后台，前台因此可以部署在各个地方.

### 安装须知

目前的wordpress5.0版本以上的使用了最新的编辑器, 会导致无法发布的问题,解决方法: 使用经典编辑器插件换回旧的编辑器, 或者直接使用4.9版本的WP;

### 主题大致结构

|----主题结构示例<br />
|----api.qinmei.video&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//wp主站点，提供api后台管理等等<br />
|----www.qinmei.video&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//PC主站点，电脑访问自动跳转<br />
|----m.qinmei.video&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//移动端主题站点，自动跳转<br />
