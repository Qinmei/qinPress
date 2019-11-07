<?php


function qinmei_init(){

  $pagecreate = array(
      array('name'=>'discuss','title' =>'动态讨论')
  );

  foreach($pagecreate as $page){
    $args = array(
      'comment_status' => 'close',
      'post_content'   => '',
      'post_excerpt'   => '',
      'post_name'      => $page['name'],
      'post_status'    => 'publish',
      'post_title'     => $page['title'],
      'post_type'      => 'page'
    );
    $new_post_id = wp_insert_post( $args );
  }


  $catcreate = array(
      array('name'=>'top','title' =>'置顶番剧'),
      array('name'=>'recommend','title' =>'站长推荐'),
      array('name'=>'scroll','title' =>'轮播图'),
      array('name'=>'day1','title' =>'周一更新番剧'),
      array('name'=>'day2','title' =>'周二更新番剧'),
      array('name'=>'day3','title' =>'周三更新番剧'),
      array('name'=>'day4','title' =>'周四更新番剧'),
      array('name'=>'day5','title' =>'周五更新番剧'),
      array('name'=>'day6','title' =>'周六更新番剧'),
      array('name'=>'day7','title' =>'周日更新番剧')
  );

  foreach($catcreate as $cat){
    wp_insert_term(
      $cat['title'], // the term
      'animatecat', // the taxonomy
      array(
        'slug' => $cat['name']
      )
    );
  }

  $kindcreate = array(
    array('name'=>'fun','title' =>'搞笑番剧'),
    array('name'=>'fight','title' =>'战斗番剧'),
    array('name'=>'daily','title' =>'日常番剧'),
    array('name'=>'cure','title' =>'治愈番剧'),
    array('name'=>'depress','title' =>'致郁番剧'),
    array('name'=>'world','title' =>'异界番剧')
  );

  foreach($kindcreate as $kind){
    wp_insert_term(
      $kind['title'], // the term
      'animatekind', // the taxonomy
      array(
        'slug' => $kind['name']
      )
    );
  }

  echo '页面初始化完成，请检查类型以及分类是否已经添加上去';


}
add_action( 'admin_action_qinmei_init', 'qinmei_init' );



