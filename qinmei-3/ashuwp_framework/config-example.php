<?php
/**
*Author: Ashuwp
*Author url: http://www.ashuwp.com
*Version: 6.0
**/

/**
*
*post meta test
*
**/
$meta_conf = array(
  'title' => '基本信息',
  'id'=>'qinmei_base',
  'page'=>array('animate'),
  'context'=>'normal',
  'priority'=>'low'
);

$ashu_meta = array();

$ashu_meta[] = array(
  'name' => 'bangumi',
  'id'   => 'baseinfo_play_bangumi',
  'desc' => '<a class="button" id="baseinfo-bangumi-get-btn">获取ID信息</a>',
  'std'  => '',
  'type' => 'text'
);


$ashu_meta[] = array(
  'name' => '豆瓣地址',
  'id'   => 'baseinfo_douban_link',
  'desc' => '<a class="button" id="baseinfo-daouban-get-btn">获取豆瓣信息</a>',
  'std'  => '',
  'type' => 'text'
);

$ashu_meta[] = array(
  'name' => '又名',
  'id'   => 'baseinfo_another_name',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);

$ashu_meta[] = array(
  'name' => '简介',
  'id'   => 'baseinfo_introduce',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);


$ashu_meta[] = array(
  'name' => '工作人员',
  'id'   => 'baseinfo_director',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);

$ashu_meta[] = array(
  'name' => '声优',
  'id'   => 'baseinfo_actor',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);

$ashu_meta[] = array(
  'name' => '官方网站',
  'id'   => 'baseinfo_website',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);

$ashu_meta[] = array(
  'name' => '地区',
  'id'   => 'baseinfo_area',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);

$ashu_meta[] = array(
  'name' => '年份',
  'id'   => 'baseinfo_year',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);

$ashu_meta[] = array(
  'name' => '类型',
  'id'   => 'baseinfo_kind',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);


$ashu_meta[] = array(
  'name' => '首播',
  'id'   => 'baseinfo_first_play',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);

$ashu_meta[] = array(
  'name' => '播放日期',
  'id'   => 'baseinfo_play_date',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);

$ashu_meta[] = array(
  'name' => '集数',
  'id'   => 'baseinfo_episode_num',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);

$ashu_meta[] = array(
  'name' => '评分',
  'id'   => 'baseinfo_rate',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);

$ashu_meta[] = array(
  'name' => '评分人数',
  'id'   => 'baseinfo_rate_num',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);

$ashu_meta[] = array(
  'name' => '点评',
  'id'   => 'baseinfo_commend',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);

//Add more
$new_box = new ashuwp_postmeta_feild($ashu_meta, $meta_conf);

$meta2_conf = array(
  'title' => '外链图像',
  'id'=>'baseinfo_img',
  'page'=>array('animate'),
  'context'=>'side',
  'priority'=>'low'
);

$ashu2_meta = array();

$ashu2_meta[] = array(
  'name' => '',
  'id'   => 'baseinfo_img_link',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);

$new_box = new ashuwp_postmeta_feild($ashu2_meta, $meta2_conf);


$meta6_conf = array(
  'title' => '横向图像(用于轮播啥的)',
  'id'=>'baseinfo_simg',
  'page'=>array('animate'),
  'context'=>'side',
  'priority'=>'low'
);

$ashu6_meta = array();

$ashu6_meta[] = array(
  'name' => '',
  'id'   => 'baseinfo_simg_link',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);

$new_box = new ashuwp_postmeta_feild($ashu6_meta, $meta6_conf);

$meta4_conf = array(
  'title' => '关联信息',
  'id'=>'baseinfo_relative',
  'page'=>array('animate'),
  'context'=>'normal',
  'priority'=>'low'
);

$ashu4_meta = array();

$ashu4_meta[] = array(
      'name' => '下载按钮标题',
      'id'   => 'baseinfo_download_title',
      'desc' => '',
      'std'  => '',
      'type' => 'text'
);

$ashu4_meta[] = array(
      'name' => '下载跳转地址',
      'id'   => 'baseinfo_download_link',
      'desc' => '',
      'std'  => '',
      'type' => 'text'
    );

$ashu4_meta[] = array(
  'name' => '弹幕唯一编码',
  'id'   => 'baseinfo_dplayer_id',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);

$ashu4_meta[] = array(
  'name' => '番剧季数',
  'id'   => 'baseinfo_season',
  'desc' => '',
  'std'  => '第一季',
  'type' => 'text'
);

$ashu4_meta[] = array(
  'name' => '关联其他季',
  'id'   => 'baseinfo_season_con',
  'desc' => '',
  'std'  => '',
  'subtype' => array(
    array(
      'name' => '季数',
      'id'   => 'baseinfo_season_sort',
      'desc' => '',
      'std'  => '',
      'type' => 'text'
    ),
    array(
      'name' => '番剧别名',
      'id'   => 'baseinfo_season_slug',
      'desc' => '',
      'std'  => '',
      'type' => 'text'
    ),
  ),
  'type' => 'group',
  'multiple'    => true
);

$new_box = new ashuwp_postmeta_feild($ashu4_meta, $meta4_conf);

$meta3_conf = array(
  'title' => '剧集信息',
  'id'=>'baseinfo_episode',
  'page'=>array('animate'),
  'context'=>'normal',
  'priority'=>'low'
);

$ashu3_meta = array();


$ashu3_meta[] = array(
  'name' => '播放设置',
  'id'   => 'baseinfo_play_setting',
  'desc' => '',
  'std'     => 'false',
  'subtype' => array(
    'true'      => '直链',
    'false'    => '解析',
    'm3u8' => 'm3u8'
  ),
  'type'    => 'radio',
  'multiple'    => false
);

$ashu3_meta[] = array(
  'name' => '等级限定',
  'id'   => 'baseinfo_play_roles',
  'desc' => '',
  'std'     => 'level0',
  'subtype' => array(
    'level0' => '游客',
    'level1' => '订阅者',
    'level2' => '投稿者',
    'level3' => '作者',
    'level4' => '编辑',
    'level5' => '管理员',
  ),
  'type'    => 'radio',
  'multiple'    => false
);


$ashu3_meta[] = array(
      'name' => '链接前缀',
      'id'   => 'baseinfo_baseaddress',
      'desc' => '',
      'std'  => '',
      'type' => 'text'
);

$ashu3_meta[] = array(
      'name' => '<a class="button" id="baseinfo-link_transfer_btn">快速添加</a>',
      'id'   => 'baseinfo_link_transfer',
      'desc' => '',
      'std'  => '',
      'type' => 'text'
);

$ashu3_meta[] = array(
  'name' => '',
  'id'   => 'baseinfo_episode_con',
  'desc' => '',
  'std'  => '',
  'subtype' => array(
    array(
      'name' => '剧集序号',
      'id'   => 'baseinfo_episode_sort',
      'desc' => '',
      'std'  => '',
      'type' => 'text'
    ),
    array(
      'name' => '剧集标题',
      'id'   => 'baseinfo_episode_title',
      'desc' => '',
      'std'  => '',
      'type' => 'text'
    ),
    array(
      'name' => 'B站弹幕ID',
      'id'   => 'baseinfo_episode_danmu',
      'desc' => '',
      'std'  => '',
      'type' => 'text'
    ),
    array(
      'name' => '剧集链接',
      'id'   => 'baseinfo_episode_link',
      'desc' => '',
      'std'  => '',
      'type' => 'text'
    ),
  ),
  'type' => 'group',
  'multiple'    => true
);

$new_box = new ashuwp_postmeta_feild($ashu3_meta, $meta3_conf);

$meta5_conf = array(
  'title' => '解析获取',
  'id'=>'baseinfo_play_info',
  'page'=>array('animate'),
  'context'=>'normal',
  'priority'=>'low'
);

$ashu5_meta = array();


$ashu5_meta[] = array(
  'name' => 'dilidili',
  'id'   => 'baseinfo_play_dilidili',
  'desc' => '<a class="button" id="baseinfo-play-dilidili-btn">获取剧集信息</a>',
  'std'  => '',
  'type' => 'text'
);


$ashu5_meta[] = array(
  'name' => 'saraba1st',
  'id'   => 'baseinfo_play_saraba1st',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);

$ashu5_meta[] = array(
  'name' => 'acfun',
  'id'   => 'baseinfo_play_acfun',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);

$ashu5_meta[] = array(
  'name' => 'bilibili',
  'id'   => 'baseinfo_play_bilibili',
  'desc' => '<a class="button" id="baseinfo-play-bilibili-btn">获取剧集信息</a>',
  'std'  => '',
  'type' => 'text'
);

$ashu5_meta[] = array(
  'name' => 'tucao',
  'id'   => 'baseinfo_play_tucao',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);

$ashu5_meta[] = array(
  'name' => 'sohu',
  'id'   => 'baseinfo_play_sohu',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);


$ashu5_meta[] = array(
  'name' => 'youku',
  'id'   => 'baseinfo_play_youku',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);

$ashu5_meta[] = array(
  'name' => 'tudou',
  'id'   => 'baseinfo_play_tudou',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);

$ashu5_meta[] = array(
  'name' => 'qq',
  'id'   => 'baseinfo_play_qq',
  'desc' => '<a class="button" id="baseinfo-play-qq-btn">获取剧集信息</a>',
  'std'  => '',
  'type' => 'text'
);
$ashu5_meta[] = array(
  'name' => 'iqiyi',
  'id'   => 'baseinfo_play_iqiyi',
  'desc' => '<a class="button" id="baseinfo-play-iqiyi-btn">获取剧集信息</a>',
  'std'  => '',
  'type' => 'text'
);
$ashu5_meta[] = array(
  'name' => 'letv',
  'id'   => 'baseinfo_play_letv',
  'desc' => '<a class="button" id="baseinfo-play-letv-btn">获取剧集信息</a>',
  'std'  => '',
  'type' => 'text'
);

$ashu5_meta[] = array(
  'name' => 'pptv',
  'id'   => 'baseinfo_play_pptv',
  'desc' => '<a class="button" id="baseinfo-play-pptv-btn">获取剧集信息</a>',
  'std'  => '',
  'type' => 'text'
);

$ashu5_meta[] = array(
  'name' => 'kankan',
  'id'   => 'baseinfo_play_kankan',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);

$ashu5_meta[] = array(
  'name' => 'mgtv',
  'id'   => 'baseinfo_play_mgtv',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);

$ashu5_meta[] = array(
  'name' => 'nicovideo',
  'id'   => 'baseinfo_play_nicovideo',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);

$ashu5_meta[] = array(
  'name' => 'netflix',
  'id'   => 'baseinfo_play_netflix',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);

$ashu5_meta[] = array(
  'name' => 'dmhy',
  'id'   => 'baseinfo_play_dmhy',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);


$ashu5_meta[] = array(
  'name' => 'nyaa',
  'id'   => 'baseinfo_play_nyaa',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);

$new_box = new ashuwp_postmeta_feild($ashu5_meta, $meta5_conf);


/**
*
*Optinos page
*
**/
/**General options**/
$page_info = array(
  'full_name'  => 'Qinmei主题设置',
  'optionname' => 'general',
  'child'      => false,
  'desc'       => '<a href="https://qinmei.video" class="page-title-action" style="margin-left:15px;">演示站点</a><a class="page-title-action" style="margin-left:15px;" href="/wp-admin/admin.php?action=qinmei_init">创建页面</a><a class="page-title-action" style="margin-left:15px;" href="/wp-admin/edit.php?post_type=animate&action=qinmei_update">更新动漫</a>',
  'filename'   => 'generalpage'
);

$ashu_options = array();

$ashu_options[] = array(
  'name' => '基础设置',
  'id'   => 'qinmei_setting',
  'type' => 'open' //Look here
);


$ashu_options[]  = array(
  'name' => '网站基础色',
  'id'   => 'qinmei_base_color',
  'desc' => '基础颜色，奠定整体色调,暂时不可用',
  'std'  => '',
  'type' => 'color'
);


$ashu_options[] = array(
  'name' => '网站名',
  'id'   => 'qinmei_name',
  'desc' => '网站名，简短重要，四个字以内',
  'std'  => 'Qinmei',
  'type' => 'text'
);

$ashu_options[] = array(
  'name' => '网站标语',
  'id'   => 'qinmei_slogan',
  'desc' => '简单描述，15字以内最好',
  'std'  => '十年生死两茫茫，不思量，自难忘',
  'type' => 'text'
);

$ashu_options[] = array(
  'name' => '图床地址',
  'id'   => 'qinmei_imgurl',
  'desc' => '前端图片上传的图床地址，不上传至wordpress，推荐使用Qinimg',
  'std'  => '',
  'type' => 'text'
);



$ashu_options[] = array(
  'name' => '搜索项设置',
  'id'   => 'qinmei_search_modules',
  'desc' => '',
  'subtype' => array(
    array(
      'name' => '动漫标题',
      'id'   => 'qinmei_search_title',
      'desc' => '',
      'std'  => '',
      'type' => 'text'
    ),
    array(
      'name' => '动漫别名',
      'id'   => 'qinmei_search_slug',
      'desc' => '',
      'std'  => '',
      'type' => 'text'
    ),
  ),
  'multiple' => true,
  'type' => 'group'
);


$ashu_options[] = array(
  'name' => '微信图片',
  'id'   => 'qinmei_weixin_img',
  'desc' => '上传图片或者直接输入图片网址',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'upload'
);


$ashu_options[] = array(
  'name' => 'qq链接',
  'id'   => 'qinmei_qq_link',
  'desc' => 'qq群链接，点击即可加群或者聊天',
  'std'  => '',
  'type' => 'text'
);


$ashu_options[] = array(
  'name' => '电子邮件',
  'id'   => 'qinmei_mail_link',
  'desc' => '你的电子邮箱，用户点击即可跳转发送邮件',
  'std'  => '',
  'type' => 'text'
);

$ashu_options[] = array(
  'name' => '统计代码',
  'id'   => 'qinmei_tongji_link',
  'desc' => '只支持百度统计，输入hm.src后面的网址即可',
  'std'  => '',
  'type' => 'text'
);

$ashu_options[] = array(
  'name' => '',
  'type' => 'close' //Look here
);


$ashu_options[] = array(
  'name' => '图片设置',
  'id'   => 'qinmei_img_setting',
  'type' => 'open' //Look here
);


$ashu_options[] = array(
  'name' => '首页头图',
  'id'   => 'qinmei_header_img',
  'desc' => '上传图片或者直接输入图片网址',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'upload'
);

$ashu_options[] = array(
  'name' => '新番头图',
  'id'   => 'qinmei_new_img',
  'desc' => '上传图片或者直接输入图片网址',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'upload'
);


$ashu_options[] = array(
  'name' => '推荐头图',
  'id'   => 'qinmei_recommend_img',
  'desc' => '上传图片或者直接输入图片网址',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'upload'
);


$ashu_options[] = array(
  'name' => '专题头图',
  'id'   => 'qinmei_topic_img',
  'desc' => '上传图片或者直接输入图片网址',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'upload'
);


$ashu_options[] = array(
  'name' => '动态头图',
  'id'   => 'qinmei_discuss_img',
  'desc' => '上传图片或者直接输入图片网址',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'upload'
);


$ashu_options[] = array(
  'name' => '全部头图',
  'id'   => 'qinmei_all_img',
  'desc' => '上传图片或者直接输入图片网址',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'upload'
);


$ashu_options[] = array(
  'name' => '搞笑头图',
  'id'   => 'qinmei_fun_img',
  'desc' => '上传图片或者直接输入图片网址',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'upload'
);

$ashu_options[] = array(
  'name' => '战斗头图',
  'id'   => 'qinmei_fight_img',
  'desc' => '上传图片或者直接输入图片网址',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'upload'
);

$ashu_options[] = array(
  'name' => '日常头图',
  'id'   => 'qinmei_daily_img',
  'desc' => '上传图片或者直接输入图片网址',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'upload'
);

$ashu_options[] = array(
  'name' => '致郁头图',
  'id'   => 'qinmei_depress_img',
  'desc' => '上传图片或者直接输入图片网址',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'upload'
);


$ashu_options[] = array(
  'name' => '治愈头图',
  'id'   => 'qinmei_cure_img',
  'desc' => '上传图片或者直接输入图片网址',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'upload'
);

$ashu_options[] = array(
  'name' => '异界头图',
  'id'   => 'qinmei_world_img',
  'desc' => '上传图片或者直接输入图片网址',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'upload'
);

$ashu_options[] = array(
  'name' => '搜索头图',
  'id'   => 'qinmei_search_img',
  'desc' => '上传图片或者直接输入图片网址',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'upload'
);

$ashu_options[] = array(
  'name' => '登录图片',
  'id'   => 'qinmei_auth_img',
  'desc' => '上传图片或者直接输入图片网址',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'upload'
);

$ashu_options[] = array(
  'name' => '默认头像',
  'id'   => 'qinmei_user_avatar',
  'desc' => '上传图片或者直接输入图片网址',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'upload'
);

$ashu_options[] = array(
  'name' => '默认背景图',
  'id'   => 'qinmei_user_backimg',
  'desc' => '上传图片或者直接输入图片网址',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'upload'
);


$ashu_options[] = array(
  'name' => '手机启动图',
  'id'   => 'qinmei_mobile_index',
  'desc' => '上传图片或者直接输入图片网址',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'upload'
);

$ashu_options[] = array(
  'name' => 'dplayer播放图',
  'id'   => 'qinmei_dplayer_cover',
  'desc' => '上传图片或者直接输入图片网址',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'upload'
);


$ashu_options[] = array(
  'name' => '',
  'type' => 'close' //Look here
);


$ashu_options[] = array(
  'name' => '播放设置',
  'id'   => 'qinmei_play',
  'type' => 'open' //Look here
);



$ashu_options[] = array(
  'name' => '默认解析接口',
  'id'   => 'qinmei_play_jiexi1',
  'desc' => '',
  'std'  => 'https://jx.itaoju.top/?url=',
  'type' => 'text'
);



$ashu_options[] = array(
  'name' => '解析正则模式',
  'id'   => 'qinmei_play_jiexi_pattern',
  'desc' => '',
  'subtype' => array(
    array(
      'name' => '正则表达式(前后带斜杠)',
      'id'   => 'qinmei_play_jiexi_pattern_p',
      'desc' => '',
      'std'  => '',
      'type' => 'text'
    ),
    array(
      'name' => '匹配解析接口',
      'id'   => 'qinmei_play_jiexi_pattern_j',
      'desc' => '',
      'std'  => '',
      'type' => 'text'
    ),
  ),
  'multiple' => true,
  'type' => 'group'
);



$ashu_options[] = array(
  'name' => '游客播放地址',
  'id'   => 'qinmei_play_leve0',
  'desc' => '',
  'std'  => '',
  'subtype' => array(
    array(
      'name' => '地址前缀',
      'id'   => 'qinmei_play_leve0_link',
      'desc' => '地址前缀,仅支持直链的播放方式，解析则会采用正则',
      'std'  => '',
      'type' => 'text'
    ),
    array(
      'name' => '加密key',
      'id'   => 'qinmei_play_leve0_key',
      'desc' => '加密key',
      'std'  => '',
      'type' => 'text'
    ),
    array(
      'name' => '过期时间',
      'id'   => 'qinmei_play_leve0_time',
      'desc' => '过期时间',
      'std'  => '',
      'type' => 'text'
    ),
  ),
  'type' => 'group' //Look here.
);

$ashu_options[] = array(
  'name' => '订阅者播放地址',
  'id'   => 'qinmei_play_leve1',
  'desc' => '',
  'std'  => '',
  'subtype' => array(
    array(
      'name' => '地址前缀',
      'id'   => 'qinmei_play_leve1_link',
      'desc' => '地址前缀,仅支持直链的播放方式，解析则会采用正则',
      'std'  => '',
      'type' => 'text'
    ),
    array(
      'name' => '加密key',
      'id'   => 'qinmei_play_leve1_key',
      'desc' => '加密key',
      'std'  => '',
      'type' => 'text'
    ),
    array(
      'name' => '过期时间',
      'id'   => 'qinmei_play_leve1_time',
      'desc' => '过期时间',
      'std'  => '',
      'type' => 'text'
    ),
  ),
  'type' => 'group' //Look here.
);

$ashu_options[] = array(
  'name' => '投稿者播放地址',
  'id'   => 'qinmei_play_leve2',
  'desc' => '',
  'std'  => '',
  'subtype' => array(
    array(
      'name' => '地址前缀',
      'id'   => 'qinmei_play_leve2_link',
      'desc' => '地址前缀,仅支持直链的播放方式，解析则会采用正则',
      'std'  => '',
      'type' => 'text'
    ),
    array(
      'name' => '加密key',
      'id'   => 'qinmei_play_leve2_key',
      'desc' => '加密key',
      'std'  => '',
      'type' => 'text'
    ),
    array(
      'name' => '过期时间',
      'id'   => 'qinmei_play_leve2_time',
      'desc' => '过期时间',
      'std'  => '',
      'type' => 'text'
    ),
  ),
  'type' => 'group' //Look here.
);

$ashu_options[] = array(
  'name' => '作者播放地址',
  'id'   => 'qinmei_play_leve3',
  'desc' => '',
  'std'  => '',
  'subtype' => array(
    array(
      'name' => '地址前缀',
      'id'   => 'qinmei_play_leve3_link',
      'desc' => '地址前缀,仅支持直链的播放方式，解析则会采用正则',
      'std'  => '',
      'type' => 'text'
    ),
    array(
      'name' => '加密key',
      'id'   => 'qinmei_play_leve3_key',
      'desc' => '加密key',
      'std'  => '',
      'type' => 'text'
    ),
    array(
      'name' => '过期时间',
      'id'   => 'qinmei_play_leve3_time',
      'desc' => '过期时间',
      'std'  => '',
      'type' => 'text'
    ),
  ),
  'type' => 'group' //Look here.
);

$ashu_options[] = array(
  'name' => '编辑播放地址',
  'id'   => 'qinmei_play_leve4',
  'desc' => '',
  'std'  => '',
  'subtype' => array(
    array(
      'name' => '地址前缀',
      'id'   => 'qinmei_play_leve4_link',
      'desc' => '地址前缀,仅支持直链的播放方式，解析则会采用正则',
      'std'  => '',
      'type' => 'text'
    ),
    array(
      'name' => '加密key',
      'id'   => 'qinmei_play_leve4_key',
      'desc' => '加密key',
      'std'  => '',
      'type' => 'text'
    ),
    array(
      'name' => '过期时间',
      'id'   => 'qinmei_play_leve4_time',
      'desc' => '过期时间',
      'std'  => '',
      'type' => 'text'
    ),
  ),
  'type' => 'group' //Look here.
);

$ashu_options[] = array(
  'name' => '管理员播放地址',
  'id'   => 'qinmei_play_leve5',
  'desc' => '',
  'std'  => '',
  'subtype' => array(
    array(
      'name' => '地址前缀',
      'id'   => 'qinmei_play_leve5_link',
      'desc' => '地址前缀,仅支持直链的播放方式，解析则会采用正则',
      'std'  => '',
      'type' => 'text'
    ),
    array(
      'name' => '加密key',
      'id'   => 'qinmei_play_leve5_key',
      'desc' => '加密key',
      'std'  => '',
      'type' => 'text'
    ),
    array(
      'name' => '过期时间',
      'id'   => 'qinmei_play_leve5_time',
      'desc' => '过期时间',
      'std'  => '',
      'type' => 'text'
    ),
  ),
  'type' => 'group' //Look here.
);




$ashu_options[] = array(
  'name' => '',
  'type' => 'close' //Look here
);



$ashu_options[] = array(
  'name' => '导入新番',
  'id'   => 'qinmei_animate_add',
  'type' => 'open' //Look here
);


$ashu_options[] = array(
  'name' => '番剧年份',
  'id'   => 'qinmei_animate_add_year',
  'desc' => '根据年份导入该时间的番剧',
  'std'     => '',
  'subtype' => array(
    '2018'    => '2018',
    '2017'    => '2017',
    '2016'    => '2016'
  ),
  'type'    => 'select'
);

$ashu_options[] = array(
  'name' => '番剧月份',
  'id'   => 'qinmei_animate_add_month',
  'desc' => '根据月份导入该时间的番剧',
  'std'     => '01',
  'subtype' => array(
    '01'    => '01',
    '02'    => '02',
    '03'    => '03',
    '04'    => '04',
    '05'    => '05',
    '06'    => '06',
    '07'    => '07',
    '08'    => '08',
    '09'    => '09',
    '10'    => '10',
    '11'    => '11',
    '12'    => '12'
  ),
  'type'    => 'select'
);


$ashu_options[] = array(
  'name' => '<a class="button" id="qinmei_animate_add_start_btn" href="/wp-admin/edit.php?post_type=animate&action=qinmei_create_animate">开始导入</a>',
  'id'   => 'qinmei_animate_add_start',
  'desc' => '需要注意的是，必须先勾选年份月份然后保存下来，再点击导入按钮才行，另外受限于线程等，可能无播放信息，需要自己手动添加',
  'std'     => '',
  'type'    => 'text'
);


$ashu_options[] = array(
  'name' => '',
  'type' => 'close' //Look here
);


$ashu_options[] = array(
  'name' => '授权访问',
  'id'   => 'qinmei_allow_site',
  'type' => 'open' //Look here
);
$ashu_options[] = array(
  'name' => '电脑端网址',
  'id'   => 'qinmei_allow_site_web',
  'desc' => '写全, 带http这些, 只能写一个',
  'std'  => '',
  'type' => 'text'
);
$ashu_options[] = array(
  'name' => '手机端网址',
  'id'   => 'qinmei_allow_site_mobile',
  'desc' => '写全, 带http这些, 只能写一个',
  'std'  => '',
  'type' => 'text'
);
$ashu_options[] = array(
  'name' => '',
  'type' => 'close' //Look here
);

$option_page = new ashuwp_options_feild($ashu_options, $page_info);
