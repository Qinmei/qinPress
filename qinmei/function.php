<?php

function request($url,$posts)
{
      if(is_array($posts) && !empty($posts))
      {
            foreach($posts as $key=>$value)
            {
                $post[] = $key.'='.urlencode($value);
            }
            $posts = implode('&',$post);
       }

      $curl = curl_init();


      $options = array(
                     CURLOPT_URL=>$url,
                     CURLOPT_CONNECTTIMEOUT => 2,
                     CURLOPT_TIMEOUT => 10,
                     CURLOPT_RETURNTRANSFER => true,
                     CURLOPT_POST => 1,
                     CURLOPT_POSTFIELDS=>$posts,
                     CURLOPT_USERAGENT=>'Mozilla/5.0 (Windows NT 5.1; rv:5.0) Gecko/20100101 Firefox/5.0'
                    );

    curl_setopt_array($curl,$options);

    $retval = curl_exec($curl);

    return $retval;
}


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
        'slug' => $cat['name']
      )
    );
  }


}
add_action( 'admin_action_qinmei_init', 'qinmei_init' );



function qinmei_create_animate(){

$general_options = get_option('ashuwp_general');

$year =  $general_options['qinmei_animate_add_year'];
$month = $general_options['qinmei_animate_add_month'];

$index = get_template_directory() . '/qinmei_animate/bangumi-data/data/items/'.$year.'/'.$month.'.json';
$data= file_get_contents($index); 

$data2 = json_decode($data,true);
$countnum = 0;

foreach ( $data2 as $unit ){

   $countnum++;
   $count = sprintf("%06d", $countnum );
   $title = $unit['title'];

   $ctitlearr = $unit['titleTranslate'];
   $ctitlearr2 = $ctitlearr['zh-Hans'];
   $ctitle = implode(" / ",$ctitlearr2);

   $dateorign = $unit['begin'];
   $datearr2 = explode("-",$dateorign);
   $date_year = $datearr2[0];
   $date_month = $datearr2[1];

   $type = $unit['type'];

   $officialSite = $unit['officialSite'];

   $danmucode = 'qinmei'.$count;

    $bangumiid='';
    $saraba1stid='';
    $acfunid='';
    $bilibiliid='';
    $tucaoid='';
    $sohuid='';
    $youkuid='';
    $tudouid='';
    $qqid='';
    $iqiyiid='';
    $letvid='';
    $pptvid='';
    $kankanid='';
    $mgtvid='';
    $nicovideoid='';
    $netflixid='';
    $dmhyid='';
    $nyaaid='';


   $websites = $unit['sites'];
    foreach ( $websites as $website ){
      $website_id = $website['id'];
      switch($website['site']){
          case "bangumi":
            $bangumiid = $website_id;
            break;
          case "saraba1st":
            $saraba1stid = $website_id;
            break;
          case "acfun":
            $acfunid = $website_id;
            break;
          case "bilibili":
              $bilibiliid = $website_id;
              break;
          case "tucao":
             $tucaoid = $website_id;
              break;
          case "sohu":
             $sohuid = $website_id;
              break;
          case "youku":
              $youkuid = $website_id;
              break;
           case "tudou":
              $tudouid = $website_id;
              break;
           case "qq":
              $qqid = $website_id;
              break;
           case "iqiyi":
              $iqiyiid = $website_id;
              break;
          case "letv":
              $letvid = $website_id;
              break;
           case "pptv":
              $pptvid = $website_id;
              break;
           case "kankan":
              $kankanid = $website_id;
              break;
           case "mgtv":
             $mgtvid = $website_id;
              break;
          case "nicovideo":
              $nicovideoid = $website_id;
              break;
           case "netflix":
              $netflixid = $website_id;
              break;
           case "dmhy":
              $dmhyid = $website_id;
              break;
          case "nyaa":
              $nyaaid = $website_id;
              break;
          default:
            $bangumiid = '';
      }
    }

    if(!empty($bangumiid)){
      $url =  get_site_url().'/wp-json/wp/v2/qinmei/getwebinfo';
      $posts = array('url'=>$bangumiid,
                     'type'=>'bgm',
                     'kind'=>'index'
                     );
      $data = json_decode(request($url,$posts),true);

      if($data['name_cn'] !== ''){
        $title = $data['name_cn'];
      }

      $summary = $data['summary'];
      $epsnum = $data['eps_count'];
      $date = $data['air_date'];
      $date_day = $data['air_weekday'];
      $rate = $data['rating'];
      $rate_score =$rate['score'];
      $rate_num = $rate['total'];
      $image = $data['images']['large'];
      $crts = $data['crt'];
      $worker = '';
      foreach ( $crts as $crt ){
         if(!empty($crt['name_cn'])){
          $worker_name = $crt['name_cn'];
        }else{
          $worker_name = $crt['name'];
        }
        $worker_actor = $crt['actors']['name'];
        $worker = $worker.$worker_name.':'.$worker_actor.'/';
      }

      $staffarr = $data['staff'];
      $staff = '';
      foreach ( $staffarr as $staffone ){
        if(!empty($staffone['name_cn'])){
          $staff_name = $staffone['name_cn'];
        }else{
          $staff_name = $staffone['name'];
        }
        $staff_actor = $staffone['jobs'];
        $staff = $staff.$staff_name.':'.(implode(" ",$staff_actor)).'/';
      }

      $recommend = $data['blog']['summary'];

      $geturl = '';
      $apiurl =   get_site_url().'/wp-json/wp/v2/qinmei/getwebinfo';

       if(!empty( $qqid)){
        $geturl = 'https://v.qq.com/detail/'.$qqid.'.html';
        $retval = request($apiurl,$posts = array('kind'=>'index','url'=>$geturl,'type'=>'qq'));
        if($retval !== false){
          $eps = json_decode($retval,true);
        }
      }else if(!empty( $letvid)){
        $geturl = 'https://www.le.com/comic/'.$letvid.'.html';
        $retval = request($apiurl,$posts = array('kind'=>'index','url'=>$geturl,'type'=>'letv'));
        if($retval !== false){
          $eps = json_decode($retval,true);
        }
      }else if(!empty( $pptvid)){
        $geturl = 'http://v.pptv.com/page/'.$pptvid.'.html';
        $retval = request($apiurl,$posts = array('kind'=>'index','url'=>$geturl,'type'=>'pptv'));
        if($retval !== false){
          $eps = json_decode($retval,true);
        }
      }else if(!empty( $bilibiliid)){
        $geturl = 'https://bangumi.bilibili.com/anime/'.$bilibiliid;
        $retval = request($apiurl,$posts = array('kind'=>'index','url'=>$geturl,'type'=>'bilibili'));
        if($retval !== false){
          $eps = json_decode($retval,true);
        }
      }else if(!empty( $iqiyiid)){
        $geturl = 'https://www.iqiyi.com/'.$iqiyiid.'.html';
        $retval = request($apiurl,$posts = array('kind'=>'index','url'=>$geturl,'type'=>'iqiyi'));
        if($retval !== false){
          $eps = json_decode($retval,true);
        }
      };


      if(!empty($geturl)){

        $epsform = array();

        $ep_sort = 0;

        foreach ( $eps as $ep ){
            $ep_sort++;
            $ep_title = $ep['title'];
            $ep_sort = sprintf("%02d", $ep_sort);
            $ep_link = $ep['link'];
            $ep_unit  = array('baseinfo_episode_sort' =>$ep_sort,'baseinfo_episode_title'=>$ep_title,'baseinfo_episode_link'=>$ep_link );
            $epsform[] = $ep_unit;
        }

      }

      $postargs = array(
        'comment_status' => 'open',
        'post_content'   => '',
        'post_excerpt'   => '',
        'post_name'      => $count,
        'post_status'    => 'draft',
        'post_title'     => $title,
        'post_type'      => 'animate',
        'meta_input' => array(
          'baseinfo_play_jpname' => $title,
          'baseinfo_play_cname' => $ctitle,
          'baseinfo_play_date' => $date_day,
          'baseinfo_play_type' => $type,
          'baseinfo_play_offical_web' => $officialSite,
          'baseinfo_play_bangumi' => $bangumiid,
          'baseinfo_play_saraba1st' => $saraba1stid,
          'baseinfo_play_acfun' => $acfunid,
          'baseinfo_play_bilibili' => $bilibiliid,
          'baseinfo_play_tucao' => $tucaoid,
          'baseinfo_play_sohu' => $sohuid,
          'baseinfo_play_youku' => $youkuid,
          'baseinfo_play_tudou' => $tudouid,
          'baseinfo_play_qq' => $qqid,
          'baseinfo_play_iqiyi' => $iqiyiid,
          'baseinfo_play_letv' => $letvid,
          'baseinfo_play_pptv' => $pptvid,
          'baseinfo_play_kankan' => $kankanid,
          'baseinfo_play_mgtv' => $mgtvid,
          'baseinfo_play_nicovideo' => $nicovideoid,
          'baseinfo_play_netflix' => $netflixid,
          'baseinfo_play_dmhy' => $dmhyid,
          'baseinfo_play_nyaa' => $nyaaid,
          'baseinfo_another_name'=>$title,
          'baseinfo_introduce' => $summary,
          'baseinfo_director' => $staff,
          'baseinfo_actor' => $worker,
          'baseinfo_website' => $officialSite,
          'baseinfo_first_play' => $date,
          'baseinfo_episode_con' => $epsform,
          'baseinfo_episode_num' => $epsnum,
          'baseinfo_rate' => $rate_score,
          'baseinfo_rate_num' => $rate_num,
          'baseinfo_commend' => $recommend,
          'baseinfo_img_link' => $image,
          'baseinfo_dplayer_id' => $danmucode,
          'baseinfo_year' => $date_year,
          'baseinfo_area' =>'日本'
         )
     );
  $new_post_id = wp_insert_post( $postargs );

  $taxonomy1 = 'animateyear';
  $termObj1 = $date_year.'-'.$date_month;
  wp_set_object_terms($new_post_id, $termObj1, $taxonomy1);

  $taxonomy2 = 'animatearea';
  $termObj2 = '日本';
  wp_set_object_terms($new_post_id, $termObj2, $taxonomy2);

  if($date_year == '2018' && $date_month == '07'){
     $taxonomy3 = 'animatecat';
    $termObj3 = 'day'.$date_day;
    wp_set_object_terms($new_post_id, $termObj3, $taxonomy3,true);
  };

  $taxonomy4 = 'animatetag';

  $termObj4 = $data['tag'];

  $taxonomy5 = 'animatekind';
  $termObj5data =  explode(",",$termObj4);
  $termcount = 0;
  foreach ($termObj5data as $termObj5list) {
    if($termcount == 0){
    switch ($termObj5list) {
      case '战斗':
      case '热血':
        $termObj5 = 'fight';
        $termcount = 1;
        break;
      case '搞笑':
        $termObj5 = 'fun';
        $termcount = 1;
        break;
      case '感动':
      case '治愈':
        $termObj5 = 'cure';
        $termcount = 1;
      break;
      case '异界':
        $termObj5 = 'world';
        $termcount = 1;
      break;
      case '致郁':
      case '粉切黑':
        $termObj5 = 'depress';
        $termcount = 1;
      break;
      case '日常':
        $termObj5 = 'daily';
        $termcount = 1;
      break;
      default:
         $termObj5 = 'daily';
        break;
    }}
    wp_set_object_terms($new_post_id, $termObj5list, $taxonomy4,true );
  }

  wp_set_object_terms($new_post_id, $termObj5, $taxonomy5);

  }
}

echo '导入完成,已导入'.($countnum).'部新番';


}


function qinmei_update(){
  $num = 0;
  $the_query = new WP_Query(
      array( 'post_type' => 'animate',
              'showposts' => '-1',
              'tax_query' => array(
                    array(
                       'taxonomy' => 'animatecat',
                       'field' => 'slug',
                       'terms' => array('day1','day2','day3','day4','day5','day6','day7'),
                       'operator' => 'IN'
                       )),
               'orderby' => 'time'
       ));
  while ($the_query->have_posts()) : $the_query->the_post();
    $count = 0;
    $ID = get_the_ID();
    $apiurl = get_site_url().'/wp-json/wp/v2/qinmei/getwebinfo';

    $dilidili = get_post_meta($ID,"baseinfo_play_dilidili",true);
    if(!empty($dilidili)){
     $dilieposide =array();

      $retval = request($apiurl,$posts = array('url'=>$dilidili,'type'=>'dilidili','kind'=>'index'));
      if($retval !== false){
          $dililist = json_decode($retval,true);
          foreach($dililist as $list){
            $count++;
            $sort  =  sprintf("%02d", $count);
            $ep_unit  = array('baseinfo_episode_sort' =>$sort,'baseinfo_episode_title'=>$list['title'],'baseinfo_episode_link'=>$list['link']);
            $dilieposide[] = $ep_unit;

          }
          update_post_meta($ID, 'baseinfo_episode_con', $dilieposide);
          $time = current_time('mysql');
          wp_update_post(
              array (
                  'ID'            => $ID,
                  'post_date'     => $time,
                  'post_date_gmt' => get_gmt_from_date( $time )
              )
          );
          $num++;
      }
    }else{
      $qqid= get_post_meta($ID,"baseinfo_play_qq",true);
      $iqiyiid = get_post_meta($ID,"baseinfo_play_iqiyi",true);
      $letvid = get_post_meta($ID,"baseinfo_play_letv",true);
      $pptvid = get_post_meta($ID,"baseinfo_play_pptv",true);
      $bilibiliid = get_post_meta($ID,"baseinfo_play_bilibili",true);
      if(!empty( $qqid)){
        $geturl = 'https://v.qq.com/detail/'.$qqid.'.html';
        $retval = request($apiurl,$posts = array('kind'=>'index','url'=>$geturl,'type'=>'qq'));
        if($retval !== false){
          $eps = json_decode($retval,true);
        }
      }else if(!empty( $letvid)){
        $geturl = 'https://www.le.com/comic/'.$letvid.'.html';
        $retval = request($apiurl,$posts = array('kind'=>'index','url'=>$geturl,'type'=>'letv'));
        if($retval !== false){
          $eps = json_decode($retval,true);
        }
      }else if(!empty( $pptvid)){
        $geturl = 'http://v.pptv.com/page/'.$pptvid.'.html';
        $retval = request($apiurl,$posts = array('kind'=>'index','url'=>$geturl,'type'=>'pptv'));
        if($retval !== false){
          $eps = json_decode($retval,true);
        }
      }else if(!empty( $bilibiliid)){
        $geturl = 'https://bangumi.bilibili.com/anime/'.$bilibiliid;
        $retval = request($apiurl,$posts = array('kind'=>'index','url'=>$geturl,'type'=>'bilibili'));
        if($retval !== false){
          $eps = json_decode($retval,true);
        }
      }else if(!empty( $iqiyiid)){
        $geturl = 'https://www.iqiyi.com/'.$iqiyiid.'.html';
        $retval = request($apiurl,$posts = array('kind'=>'index','url'=>$geturl,'type'=>'iqiyi'));
        if($retval !== false){
          $eps = json_decode($retval,true);
        }
      }else{
        $geturl = '';

      }

      if(!empty($geturl)){

        $dilieposide = array();

        $ep_sort = 0;

        foreach ( $eps as $ep ){
            $ep_sort++;
            $ep_title = $ep['title'];
            $ep_sort = sprintf("%02d", $ep_sort);
            $ep_link = $ep['link'];
            $ep_unit  = array('baseinfo_episode_sort' =>$ep_sort,'baseinfo_episode_title'=>$ep_title,'baseinfo_episode_link'=>$ep_link );
            $dilieposide[] = $ep_unit;
        }
        update_post_meta($ID, 'baseinfo_episode_con', $dilieposide);
        $time = current_time('mysql');
        wp_update_post(
            array (
                'ID'            => $ID,
                'post_date'     => $time,
                'post_date_gmt' => get_gmt_from_date( $time )
            )
        );
        $num++;
      }else{
         wp_update_post(
            array (
                'ID'            => $ID,
                'post_status'    => 'pending',
            )
        );
      }
    }


  endwhile;

  echo '更新完成,一共更新'.$num.'部番剧';
}
