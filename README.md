# Qinmeiorg

此套主题主要是将 wordpress 改造成纯api的站点，以便实现前后端分离的技术栈，目前的进度已经大致完成，唯一的问题就是需要安装 JWT token 插件，具体的请查看 wiki 的安装说明。

demo网站：http://qinmeiss.com,  用户名：qinmei,  密码：qinmei

**主要注意的是本主题仅为后台，前台主题请自行编写。**

### 功能介绍

1. 批量导入番剧，同时自动获取bangumi的番剧信息，包括评分以及剧集信息等等，另外大部分的番剧还可自动获取来自爱奇艺，B站，腾讯等网站的播放连接，方便解析使用。

2. 创建番剧时可一键搜索其他来源的网址，还可获取bangumi的剧集信息，支持获取爱奇艺等播放连接。

3. 批量更新番剧播放链接。

4. 用户云端历史纪录，收藏记录，点赞记录等等。

升级到3.0之后，主要是进行前后端的分离，针对wordpress进行了大量的定制化，使其成为一个纯api输出的后台，前台因此可以部署在各个地方，同时把图库分离出来，抛弃wp自带的上传接口。理论上来说，这样无论是开发小程序亦或者是app或者什么的都很方便。

## 主题大致结构

|----主题结构示例<br />
|----api.qinmei.video&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//wp主站点，提供api后台管理等等<br />
|----img.qinmei.video&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//图库站点，提供api上传图片等服务<br />
|----www.qinmei.video&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//PC主站点，电脑访问自动跳转<br />
|----m.qinmei.video&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//移动端主题站点，自动跳转<br />

## 安装说明

### 1.安装wordpress

**首先新建个php站点,然后安装wp，这个不用多说了吧，域名最好是二级的，这样方便点。**

![01](https://img.qinmei.org/upload/theme/01.png)

![01](https://img.qinmei.org/upload/theme/02.png)

**然后上传后台主题，直接ftp上传就好，后台上传估计不行，最好新建个qinmei文件夹，然后把东西都解压到里面去。**

![01](https://img.qinmei.org/upload/theme/03.png)

**去后台启用主题**

![01](https://img.qinmei.org/upload/theme/07.png)

**访问网站首页能看到登录界面（注意退出登录才能看到）就OK了。**

![01](https://img.qinmei.org/upload/theme/08.png)

**测试下数据的输出有没有问题，在域名后面加上/wp-json/wp/v2/访问能看到下面的这些信息就代表没问题了**

![01](https://img.qinmei.org/upload/theme/06.png)

**在后台的主题设置栏里面点击创建页面**

![01](https://img.qinmei.org/upload/theme/10.png)

**然后在动漫的分类以及类型啥的能看到自动生成的分类即可，若有错误需要手动改正**

![01](https://img.qinmei.org/upload/theme/09.png)

**最后安装认证插件 JWT Authentication for WP-API**

![01](https://img.qinmei.org/upload/theme/11.png)

**点击详情查看设置内容**

![01](https://img.qinmei.org/upload/theme/12.png)

**首先是允许header，这个一般都没不用去设置，除非网站真的是有问题再考虑这个**

![01](https://img.qinmei.org/upload/theme/13.png)

**然后设置key,我们照着设置就好。**

![01](https://img.qinmei.org/upload/theme/14.png)

**先去图上的地址去生成一个key,访问之后会一次性生成好几个，随便复制一个就行**

![01](https://img.qinmei.org/upload/theme/15.png)

**然后把那两个参数填写到网站根目录的wp-config.php里面，放到那一堆key的下面就好。**

![01](https://img.qinmei.org/upload/theme/16.png)

**最后记得去主题设置处允许前端域名访问，基本上安装就搞定了**

![01](https://img.qinmei.org/upload/theme/04.png)

### 前端静态站安装

**静态站才是展示的主要地方，需要注意点**

**首先新建个www的PC站**

![01](https://img.qinmei.org/upload/theme/17.png)

**上传主题文件**

![01](https://img.qinmei.org/upload/theme/18.png)

**然后设置伪静态规则，用wordpress的就行，然后把index.php改成index.html;**

![01](https://img.qinmei.org/upload/theme/19.png)

**手机端与移动端的相互跳转在nginx里面设置就好,给个简单的示例**

![01](https://img.qinmei.org/upload/theme/20.png)

**然后设置static/config.js 的内容**

![01](https://img.qinmei.org/upload/theme/21.png)

**baseurl就是你的后端域名,key忽略,website 则是多站点配置,填写动漫的站点分类ID即可,这个比较有意思,后续再深入讲解**

**设置好之后,我们点开网页,能看到下面的内容就表示没问题了**

![01](https://img.qinmei.org/upload/theme/23.png)

**然后点击登录看看登录注册没有没问题**

![01](https://img.qinmei.org/upload/theme/24.png)

**进入下面的用户面板就表示没啥问题了**

![01](https://img.qinmei.org/upload/theme/25.png)

### 3.图库安装

imgurl这个自己搜下,我改过的版本主要是去除了一些页面的东西,官方的安装起来简单点,然后地址则填写图库域名 + /functions/api.php, 测试没问题就行

### 统计代码啥的自己添加到index.html就行

