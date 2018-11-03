<?php

function get_qinmei_config_output() {
  $general_options = get_option('ashuwp_general');
  $qconfig["color"] = $general_options["qinmei_base_color"];
  $qconfig["name"] = $general_options["qinmei_name"];
  $qconfig["slogan"] = $general_options["qinmei_slogan"];
  $qconfig["imgurl"] = $general_options["qinmei_imgurl"];
  $qconfig["search_modules"] = $general_options["qinmei_search_modules"];
  $qconfig["weixin"] = $general_options["qinmei_weixin_img"];
  $qconfig["qq"] = $general_options["qinmei_qq_link"];
  $qconfig["mail"] = $general_options["qinmei_mail_link"];
  $qconfig["tongji"] = $general_options["qinmei_tongji_link"];

  $qconfig["img"] = array(
    "index" => $general_options["qinmei_header_img"],
    "new" => $general_options["qinmei_new_img"],
    "recommend" => $general_options["qinmei_recommend_img"],
    "topic"=> $general_options["qinmei_topic_img"],
    "discuss" => $general_options["qinmei_discuss_img"],
    "all" => $general_options["qinmei_all_img"],
    "fight" => $general_options["qinmei_fight_img"],
    "cure" => $general_options["qinmei_cure_img"],
    "daily" => $general_options["qinmei_daily_img"],
    "depress" => $general_options["qinmei_depress_img"],
    "fun" => $general_options["qinmei_fun_img"],
    "world" => $general_options["qinmei_world_img"],
    "search" => $general_options["qinmei_search_img"],
    "auth" => $general_options["qinmei_auth_img"],
    "avatar" => $general_options["qinmei_user_avatar"],
    "backimg" => $general_options["qinmei_user_backimg"],
    "mindex" => $general_options["qinmei_mobile_index"],
    "dplayer" => $general_options["qinmei_dplayer_cover"],
  );

  $categories = get_categories(array(
    'orderby' => 'name',
    'order'   => 'ASC'
  ) );

  $postsimple = array();

  foreach ($categories as $category) {
    if(in_array($category->slug, array("ding","cat1","cat2","cat3","cat4","cat5"))){
       $postsimple[] = array(
          'title'=> $category->name,
          'cat'=> $category->term_id,
          'slug'=> $category->slug,
        );
    }
  }

  $qconfig["post"] = $postsimple;

  $cattotal = get_terms( array(
    'taxonomy' => 'animatecat',
    'hide_empty' => false,
  ));

  $catsimple = array();

  foreach ($cattotal as $catsingle) {
    $catreceive = array("day1","day3","day2","day5","day6","day4","day7","recommend","top","scroll");
    if(in_array($catsingle->slug, $catreceive)){
      $catsimple[$catsingle->slug] = $catsingle->term_id;
    }
  }

   $kindtotal = get_terms( array(
    'taxonomy' => 'animatekind',
    'hide_empty' => false,
  ));

  $kindsimple = array();

  foreach ($kindtotal as $kindsingle) {
    $kindreceive = array("world","fight","fun","daily", "cure","depress");
    if(in_array($kindsingle->slug, $kindreceive)){
      $kindsimple[$kindsingle->slug] = $kindsingle->term_id;
    }
  }

  $pagesimple =  array(
    "discuss" => get_page_by_path( 'discuss' )->ID,
    "info" => get_page_by_path( 'info' , OBJECT, 'post')->ID,
    "theme" => get_page_by_path( 'theme' , OBJECT, 'post')->ID,
    "weixin" => get_page_by_path( 'weixin' , OBJECT, 'post')->ID
  );


  $qconfig["termid"] = array(
    'cat'=> $catsimple,
    'kind'=> $kindsimple,
    'page'=>$pagesimple
  );

  return $qconfig;
}

add_action( 'rest_api_init', function () {
  register_rest_route( 'wp/v2/qinmei', '/config', array(
    'methods' => 'GET',
    'callback' => 'get_qinmei_config_output'
  )
 );
});