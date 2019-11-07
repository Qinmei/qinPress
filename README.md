# 3.0 版本

此套主题主要是将 wordpress 改造成纯 api 的站点，以便实现前后端分离的技术栈，目前的进度已经大致完成，唯一的问题就是需要安装 JWT token 插件，具体的请查看 <a href='https://github.com/qinvz/qinPress/wiki'>wiki</a> 的安装说明。

### 功能介绍

1. 支持豆瓣以及 bangumi 的一键获取信息, 豆瓣 api 目前使用的是第三方代理 可能有失效的风险.

2. 用户云端历史纪录，收藏记录，点赞记录等等。

3. 前后端分离，针对 wordpress 进行了大量的定制化，使其成为一个纯 api 输出的后台，前台因此可以部署在各个地方.

### 目录结构

```js
|---qinpress   // wordpress主题文件
|---web        // pc 端文件
|---h5         // 移动端文件
|---picture    // 安装图片相关
```

### 安装须知

目前的 wordpress5.0 版本以上的使用了最新的编辑器, 会导致无法发布的问题,解决方法: 使用经典编辑器插件换回旧的编辑器, 或者直接使用 4.9 版本的 WP;

### 主题大致结构

```js
主题结构示例
|----api.qinmei.video    //wp 主站点，提供 api 后台管理等等
|----www.qinmei.video    //PC 主站点，电脑访问自动跳转
|----m.qinmei.video      //移动端主题站点，自动跳转
```

### 主题预览

![picture](https://raw.githubusercontent.com/Qinmei/qinpress/3.0/picture/18.PNG)
![picture](https://raw.githubusercontent.com/Qinmei/qinpress/3.0/picture/19.PNG)
![picture](https://raw.githubusercontent.com/Qinmei/qinpress/3.0/picture/20.PNG)
![picture](https://raw.githubusercontent.com/Qinmei/qinpress/3.0/picture/21.PNG)
![picture](https://raw.githubusercontent.com/Qinmei/qinpress/3.0/picture/22.PNG)
![picture](https://raw.githubusercontent.com/Qinmei/qinpress/3.0/picture/23.PNG)
![picture](https://raw.githubusercontent.com/Qinmei/qinpress/3.0/picture/24.PNG)
![picture](https://raw.githubusercontent.com/Qinmei/qinpress/3.0/picture/25.PNG)
![picture](https://raw.githubusercontent.com/Qinmei/qinpress/3.0/picture/26.PNG)
