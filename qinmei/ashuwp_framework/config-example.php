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
  ),
  'type'    => 'radio',
  'multiple'    => false
);

$ashu3_meta[] = array(
      'name' => '下载按钮标题',
      'id'   => 'baseinfo_download_title',
      'desc' => '',
      'std'  => '',
      'type' => 'text'
);

$ashu3_meta[] = array(
      'name' => '下载跳转地址',
      'id'   => 'baseinfo_download_link',
      'desc' => '',
      'std'  => '',
      'type' => 'text'
    );

$ashu3_meta[] = array(
  'name' => '弹幕唯一编码',
  'id'   => 'baseinfo_dplayer_id',
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


/**
*
*Tab style
*
**/

$tab_conf = array(
  'title' => 'PC图片设置',
  'id'=>'tab_box',
  'page'=>array('page'),
  'context'=>'normal',
  'priority'=>'low',
  'tab'=>true
);

$tab_meta = array();

$tab_meta[] = array(
  'name' => '头图',
  'id'   => 'page_tab_head_img',
  'desc' => '上传图片或者直接输入图片网址',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'upload'
);






$tab_box = new ashuwp_postmeta_feild($tab_meta, $tab_conf);
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
  'desc'       => '<a href="https://qinmei.video" class="page-title-action" style="margin-left:15px;">演示站点</a><a class="page-title-action" style="margin-left:15px;" href="/wp-admin/admin.php?action=qinmei_init">创建页面</a>',
  'filename'   => 'generalpage'
);

$ashu_options = array();


$ashu_options[] = array(
  'name' => '基础设置',
  'id'   => 'qinmei_base',
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
  'name' => '网站标题',
  'id'   => 'web-title',
  'desc' => '头图右侧显示大字',
  'std'  => 'Qinmei',
  'type' => 'text'
);

$ashu_options[] = array(
  'name' => '网站标语',
  'id'   => 'tab1_slogan',
  'desc' => '头图右侧显示',
  'std'  => '十年生死两茫茫，不思量，自难忘',
  'type' => 'text'
);

$ashu_options[] = array(
  'name' => '首页头图',
  'id'   => 'tab1_header_img',
  'desc' => '上传图片或者直接输入图片网址',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'upload'
);


$ashu_options[] = array(
  'name' => '搜索头图',
  'id'   => 'qinmei_base_search_img',
  'desc' => '上传图片或者直接输入图片网址',
  'std'  => '',
  'button_text' => 'Upload',
  'type' => 'upload'
);



$ashu_options[] = array(
  'name' => '专题图文分类',
  'id'   => 'tab3_modules',
  'desc' => '适合写文章之类的分类',
  'std'     => '',
  'subtype' => 'category',
  'type'    => 'checkbox',
  'multiple'    => false
);

$ashu_options[] = array(
  'name' => '报错页面设置',
  'id'   => 'tab2_error_link',
  'desc' => '新建个页面，可以接受用户视频报错的提示,需要打开评论功能',
  'std'     => '',
  'subtype' => 'page',
  'type'    => 'select'
);

$ashu_options[] = array(
  'name' => '上架页面设置',
  'id'   => 'tab2_upload_link',
  'desc' => '新建个页面，可以接受用户上架请求的提示,需要打开评论功能',
  'std'     => '',
  'subtype' => 'page',
  'type'    => 'select'
);


$ashu_options[] = array(
  'name' => '搜索项设置',
  'id'   => 'tab7_modules',
  'desc' => '',
  'subtype' => array(
    array(
      'name' => '搜索项标题',
      'id'   => 'tab7_modules_title',
      'desc' => '',
      'std'  => '',
      'type' => 'text'
    ),
    array(
      'name' => '点击跳转的链接',
      'id'   => 'tab7_modules_link',
      'desc' => '',
      'std'  => '',
      'type' => 'text'
    ),
  ),
  'multiple' => true,
  'type' => 'group'
);


$ashu_options[] = array(
  'name' => '底部导航链接',
  'id'   => 'tab9_modules',
  'desc' => '',
  'subtype' => array(
    array(
      'name' => '标题，如关于我们或者友链',
      'id'   => 'tab9_modules_title',
      'desc' => '',
      'std'  => '',
      'type' => 'text'
    ),
    array(
      'name' => '跳转链接',
      'id'   => 'tab9_modules_link',
      'desc' => '',
      'std'  => '',
      'type' => 'text'
    ),
  ),
  'multiple' => true,
  'type' => 'group'
);


$ashu_options[] = array(
  'name' => 'qq链接',
  'id'   => 'tab9_qq_link',
  'desc' => 'qq群链接，点击即可加群或者聊天',
  'std'  => '',
  'type' => 'text'
);


$ashu_options[] = array(
  'name' => '电子邮件',
  'id'   => 'tab9_mail_link',
  'desc' => '你的电子邮箱，用户点击即可跳转发送邮件',
  'std'  => '',
  'type' => 'text'
);


$ashu_options[] = array(
  'name' => '统计代码',
  'id'   => 'tab9_tongji_link',
  'desc' => '只支持百度统计，复制 hm.src 那一行里面的网址就行',
  'std'  => '',
  'type' => 'text'
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
  'name' => '解析接口1(默认)',
  'id'   => 'qinmei_play_jiexi1',
  'desc' => '',
  'std'  => 'https://jx.itaoju.top/?url=',
  'type' => 'text'
);

$ashu_options[] = array(
  'name' => '解析接口2',
  'id'   => 'qinmei_play_jiexi2',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);

$ashu_options[] = array(
  'name' => '解析接口3',
  'id'   => 'qinmei_play_jiexi3',
  'desc' => '',
  'std'  => '',
  'type' => 'text'
);

$ashu_options[] = array(
  'name' => '解析设置',
  'id'   => 'qinmei_play_jiexi_setting',
  'desc' => '',
  'std'     => 'true',
  'subtype' => array(
    'true'      => '用户手动切换线路',
    'false'    => '正则匹配自动切换',
  ),
  'type'    => 'radio',
  'multiple'    => false
);



$ashu_options[] = array(
  'name' => '解析正则模式',
  'id'   => 'qinmei_play_jiexi_pattern',
  'desc' => '',
  'subtype' => array(
    array(
      'name' => '正则表达式',
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
  'name' => '',
  'type' => 'close' //Look here
);



$ashu_options[] = array(
  'name' => '广告设置',
  'id'   => 'qinmei_ad_setting',
  'type' => 'open' //Look here
);


$ashu_options[] = array(
  'name' => 'PC首页广告位1',
  'id'   => 'qinmei_ad_pc_1',
  'desc' => '',
  'std'  => '',
  'type' => 'textarea'
);

$ashu_options[] = array(
  'name' => 'PC首页广告位2',
  'id'   => 'qinmei_ad_pc_2',
  'desc' => '',
  'std'  => '',
  'type' => 'textarea'
);

$ashu_options[] = array(
  'name' => 'PC首页广告位3',
  'id'   => 'qinmei_ad_pc_3',
  'desc' => '',
  'std'  => '',
  'type' => 'textarea'
);

$ashu_options[] = array(
  'name' => 'PC首页广告位4',
  'id'   => 'qinmei_ad_pc_4',
  'desc' => '',
  'std'  => '',
  'type' => 'textarea'
);


$ashu_options[] = array(
  'name' => 'PC首页广告位5',
  'id'   => 'qinmei_ad_pc_5',
  'desc' => '',
  'std'  => '',
  'type' => 'textarea'
);

$ashu_options[] = array(
  'name' => 'PC首页广告位6',
  'id'   => 'qinmei_ad_pc_6',
  'desc' => '',
  'std'  => '',
  'type' => 'textarea'
);

$ashu_options[] = array(
  'name' => 'PC首页广告位7',
  'id'   => 'qinmei_ad_pc_7',
  'desc' => '',
  'std'  => '',
  'type' => 'textarea'
);


$ashu_options[] = array(
  'name' => 'PC首页广告位8',
  'id'   => 'qinmei_ad_pc_8',
  'desc' => '',
  'std'  => '',
  'type' => 'textarea'
);


$ashu_options[] = array(
  'name' => 'PC首页广告位9',
  'id'   => 'qinmei_ad_pc_9',
  'desc' => '',
  'std'  => '',
  'type' => 'textarea'
);


$ashu_options[] = array(
  'name' => 'PC首页广告位10',
  'id'   => 'qinmei_ad_pc_10',
  'desc' => '',
  'std'  => '',
  'type' => 'textarea'
);


$ashu_options[] = array(
  'name' => 'PC首页广告位11',
  'id'   => 'qinmei_ad_pc_11',
  'desc' => '',
  'std'  => '',
  'type' => 'textarea'
);


$ashu_options[] = array(
  'name' => 'PC全部侧边广告位12',
  'id'   => 'qinmei_ad_pc_12',
  'desc' => '',
  'std'  => '',
  'type' => 'textarea'
);


$ashu_options[] = array(
  'name' => 'PC播放长广告位13',
  'id'   => 'qinmei_ad_pc_13',
  'desc' => '',
  'std'  => '',
  'type' => 'textarea'
);


$ashu_options[] = array(
  'name' => 'PC播放长广告位14',
  'id'   => 'qinmei_ad_pc_14',
  'desc' => '',
  'std'  => '',
  'type' => 'textarea'
);

$ashu_options[] = array(
  'name' => 'PC播放长广告位15',
  'id'   => 'qinmei_ad_pc_15',
  'desc' => '',
  'std'  => '',
  'type' => 'textarea'
);

$ashu_options[] = array(
  'name' => 'PC播放竖广告位16',
  'id'   => 'qinmei_ad_pc_16',
  'desc' => '',
  'std'  => '',
  'type' => 'textarea'
);

$ashu_options[] = array(
  'name' => 'PC播放竖广告位17',
  'id'   => 'qinmei_ad_pc_17',
  'desc' => '',
  'std'  => '',
  'type' => 'textarea'
);

$ashu_options[] = array(
  'name' => '手机主页广告位18',
  'id'   => 'qinmei_ad_pc_18',
  'desc' => '',
  'std'  => '',
  'type' => 'textarea'
);


$ashu_options[] = array(
  'name' => '手机主页广告位19',
  'id'   => 'qinmei_ad_pc_19',
  'desc' => '',
  'std'  => '',
  'type' => 'textarea'
);

$ashu_options[] = array(
  'name' => '手机主页广告位20',
  'id'   => 'qinmei_ad_pc_20',
  'desc' => '',
  'std'  => '',
  'type' => 'textarea'
);

$ashu_options[] = array(
  'name' => '手机主页广告位21',
  'id'   => 'qinmei_ad_pc_21',
  'desc' => '',
  'std'  => '',
  'type' => 'textarea'
);

$ashu_options[] = array(
  'name' => '手机播放页广告位22',
  'id'   => 'qinmei_ad_pc_22',
  'desc' => '',
  'std'  => '',
  'type' => 'textarea'
);

$ashu_options[] = array(
  'name' => '手机播放页广告位23',
  'id'   => 'qinmei_ad_pc_23',
  'desc' => '',
  'std'  => '',
  'type' => 'textarea'
);

$ashu_options[] = array(
  'name' => '手机播放页广告位24',
  'id'   => 'qinmei_ad_pc_24',
  'desc' => '',
  'std'  => '',
  'type' => 'textarea'
);


$ashu_options[] = array(
  'name' => '手机播放页广告位25',
  'id'   => 'qinmei_ad_pc_25',
  'desc' => '',
  'std'  => '',
  'type' => 'textarea'
);

$ashu_options[] = array(
  'name' => '',
  'type' => 'close' //Look here
);

$option_page = new ashuwp_options_feild($ashu_options, $page_info);
