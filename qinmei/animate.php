<?php

function filter_animate_json( $data, $post, $context ) {

  $eposidecon = get_post_meta( $post->ID, 'baseinfo_episode_con', true );
  $neweposide = array();
  foreach($eposidecon as $eposidesingle){
    $neweposide[]=array(
      'baseinfo_episode_sort' => $eposidesingle['baseinfo_episode_sort'],
      'baseinfo_episode_title' => $eposidesingle['baseinfo_episode_title'],
    );
  };

  $animatetags = wp_get_object_terms( $post->ID,  'animatetag' );
  $tags = array();
  $tagscount = 0;
  foreach ( $animatetags as $tag ) {
    if($tagscount >6){
      break;
    };
      $tagscount++;
      $tags[] = $tag->name;
  };
  
  $baseinfo_simg = esc_html( get_post_meta( $post->ID, 'baseinfo_simg_link', true  ));
  if($baseinfo_simg == ''){
  	$baseinfo_simg = esc_html(get_the_post_thumbnail_url($post->ID));
  }
	  
  
  //以下是要添加的自定义字段
  $data->data['baseinfo_actor'] = esc_html( get_post_meta( $post->ID, 'baseinfo_actor', true ) );
  $data->data['baseinfo_director'] = esc_html( get_post_meta( $post->ID, 'baseinfo_director', true ) );
  $data->data['baseinfo_introduce'] = esc_html( get_post_meta( $post->ID, 'baseinfo_introduce', true ) );
  $data->data['baseinfo_first_play'] = esc_html( get_post_meta( $post->ID, 'baseinfo_first_play', true ) );
  $data->data['baseinfo_episode_num'] = esc_html( get_post_meta( $post->ID, 'baseinfo_episode_num', true ) );
  $data->data['baseinfo_rate'] = esc_html( get_post_meta( $post->ID, 'baseinfo_rate', true ) );
  $data->data['baseinfo_rate_num'] = esc_html( get_post_meta( $post->ID, 'baseinfo_rate_num', true ) );
  $data->data['baseinfo_commend'] = esc_html( get_post_meta( $post->ID, 'baseinfo_commend', true ) );
  $data->data['baseinfo_img_link'] = esc_html( get_post_meta( $post->ID, 'baseinfo_img_link', true ) );
  $data->data['baseinfo_simg_link'] = $baseinfo_simg;
  $data->data['baseinfo_episode_con'] =  $neweposide;
  $data->data['baseinfo_season'] =  get_post_meta( $post->ID, 'baseinfo_season', true );
  $data->data['play_relative'] =  get_post_meta( $post->ID, 'baseinfo_season_con', true );
  $data->data['download'] =  array(
    'title'=> get_post_meta( $post->ID, 'baseinfo_download_title', true ),
    'link' => get_post_meta( $post->ID, 'baseinfo_download_link', true )
  );
  $data->data['animate'] = array(
    'like'=> get_post_meta( $post->ID, 'animate_like', true ),
    'look_for'=> get_post_meta( $post->ID, 'animate_look_for', true ),
    'look_gone'=> get_post_meta( $post->ID, 'animate_look_gone', true ),
    'playsort'=> get_post_meta( $post->ID, 'playsort', true ),
    'playtotal'=> get_post_meta( $post->ID, 'playtotal', true ),
    'comment_total'=>get_comments_number($post->ID),
    'longpost'=> get_post_meta( $post->ID, 'longpost', true ),
    'tags'=>$tags
  );
  
  unset( $data->data['guid'] );
  unset( $data->data['animatecat'] );
  unset( $data->data['animatearea'] );
  unset( $data->data['animateyear'] );
  unset( $data->data['animatekind'] );
  unset( $data->data['animatetag'] );
  unset( $data->data['animateweb'] );
  unset( $data->data['featured_media'] );
  unset( $data->data['comment_status'] );
  unset( $data->data['ping_status'] );
  unset( $data->data['template'] );
  unset( $data->data['date_gmt'] );
  unset( $data->data['type'] );
  unset( $data->data['link'] );
  unset( $data->data['excerpt'] );
  unset( $data->data['content'] );
  
  return $data;
}
add_filter( 'rest_prepare_animate', 'filter_animate_json', 10, 3 );

function my_update_post_meta($request) {
  $data = json_decode($request->get_body(), true);
  $animate = $data["id"];
  $user = get_current_user_id();
  $type = $data["meta"]['type'];
  if(in_array($type,['like','look_for','look_gone'])){
    if ( !is_user_logged_in()){
      return '404';
    };
    $click = false;
    $value = get_post_meta($animate, 'animate_'.$type,true);
    if (count($value)==count($value, 1)) {
      if(!is_array($value)){
        $value = [];
      }
    } else {
        $value = [];
    };
    $value = array_values($value);
    if(!in_array($user,$value)){
      array_push($value ,$user );
    }else{
      $key = array_search($user,$value);
    	if(isset($key)){
    		unset($value[$key]);
    	}
      $click = true;
    };
    update_post_meta( $animate,  'animate_'.$type, $value);

    $user_animate = get_user_meta( $user, 'animate_'.$type,true);
    if(!is_array($user_animate)){
      $user_animate = [];
    }else if (count($user_animate)==count($user_animate, 1)) {

    } else {
          $user_animate = [];
    };
    $user_animate = array_values($user_animate);

    if(!$click){
      array_push($user_animate ,$animate );
    }else{
      foreach($user_animate as $k=>$v){
        if($v == $animate){
          unset($user_animate[$k]);
        }
      }
    };
    update_user_meta( $user, 'animate_'.$type, $user_animate);
    return get_post_meta( $animate, 'animate_'.$type, false)[0];
  }else if(in_array($type,['playsort'])){
    $value = get_post_meta($animate, 'playsort',true);
    $total = get_post_meta($animate, 'playtotal',true);
    $sort = $data["meta"]['sort'];
    if($value[$sort] == ''){
      $value[$sort] = 1;
    }else{
      $value[$sort]++;
    };
    if($total == ''){
      $total = 1;
    }else{
      $total++;
    };
    update_post_meta( $animate, 'playsort', $value);
    update_post_meta( $animate, 'playtotal', $total);
    return get_post_meta( $animate, 'playsort', true)[$sort];
  }

}

add_action( 'rest_api_init', function () {
  register_rest_route( 'wp/v2/update', '/animate', array(
    'methods' => 'POST',
    'callback' => 'my_update_post_meta',
  ) );
} );

function get_play_link_info($request){
  $data = json_decode($request->get_body(), true);
  $animate = $data['animate'];
  $sort = $data['sort'];

  $playcon = get_post_meta( $animate, 'baseinfo_episode_con', true);
  $setting = get_post_meta( $animate, 'baseinfo_play_setting', true );
  $img = get_post_meta( $animate, 'baseinfo_img_link', true ) ;
  $title = get_post( $animate )->post_title;
  $slug =  get_post( $animate )->post_name;
  $desc = esc_html( get_post_meta( $animate, 'baseinfo_introduce', true ) );
  $playcount = get_post_meta($animate, 'playsort',true);
  $dplayer = esc_html( get_post_meta( $animate, 'baseinfo_dplayer_id', true ) );
  $star = esc_html( get_post_meta( $animate, 'baseinfo_rate', true ) );

  $playlimit = get_post_meta($animate,'baseinfo_play_roles',true);
  $baseaddress = get_post_meta( $animate, 'baseinfo_baseaddress',true);

  $neweposide = array();
  foreach($playcon as $single){
     $neweposide[]=array(
      'baseinfo_episode_sort' => $single['baseinfo_episode_sort'],
      'baseinfo_episode_title' => $single['baseinfo_episode_title'],
    );
    if($single['baseinfo_episode_sort'] == $sort){
      $playlink = $single['baseinfo_episode_link'];
      $playdanmu = $single['baseinfo_episode_danmu'];
      $playtitle = $single['baseinfo_episode_title'];
    }
  };

  $showplay = false;

  $general_options = get_option('ashuwp_general');
  $qinmeibaselevel = $general_options["qinmei_play_leve0"];
  $qinmeibasetime = $qinmeibaselevel["qinmei_play_leve0_time"];
  $qinmeibasesecret = $qinmeibaselevel["qinmei_play_leve0_key"];
  $qinmeibaselink = $qinmeibaselevel["qinmei_play_leve0_link"];

  if ( is_user_logged_in()){
	  $qinmeibaselevel = $general_options["qinmei_play_leve1"];
	  $qinmeibasetime = $qinmeibaselevel["qinmei_play_leve1_time"];
	  $qinmeibasesecret = $qinmeibaselevel["qinmei_play_leve1_key"];
	  $qinmeibaselink = $qinmeibaselevel["qinmei_play_leve1_link"];
  };  
  if (current_user_can('delete_posts')){
	  $qinmeibaselevel = $general_options["qinmei_play_leve2"];
	  $qinmeibasetime = $qinmeibaselevel["qinmei_play_leve2_time"];
	  $qinmeibasesecret = $qinmeibaselevel["qinmei_play_leve2_key"];
	  $qinmeibaselink = $qinmeibaselevel["qinmei_play_leve2_link"];
  };

  if (current_user_can('publish_posts')){
	  $qinmeibaselevel = $general_options["qinmei_play_leve3"];
	  $qinmeibasetime = $qinmeibaselevel["qinmei_play_leve3_time"];
	  $qinmeibasesecret = $qinmeibaselevel["qinmei_play_leve3_key"];
	  $qinmeibaselink = $qinmeibaselevel["qinmei_play_leve3_link"];
  };

  if (current_user_can('publish_pages')){
	  $qinmeibaselevel = $general_options["qinmei_play_leve4"];
	  $qinmeibasetime = $qinmeibaselevel["qinmei_play_leve4_time"];
	  $qinmeibasesecret = $qinmeibaselevel["qinmei_play_leve4_key"];
	  $qinmeibaselink = $qinmeibaselevel["qinmei_play_leve4_link"];
  };

  if (current_user_can('manage_options')){
	  $qinmeibaselevel = $general_options["qinmei_play_leve5"];
	  $qinmeibasetime = $qinmeibaselevel["qinmei_play_leve5_time"];
	  $qinmeibasesecret = $qinmeibaselevel["qinmei_play_leve5_key"];
	  $qinmeibaselink = $qinmeibaselevel["qinmei_play_leve5_link"];
  };

  switch ($playlimit) {
    case 'level0':
      $showplay = true;
      break;
    case 'level1':
      if ( is_user_logged_in()){
        $showplay = true;
      };
      break;
    case 'level2':
      if (current_user_can('delete_posts')){
        $showplay = true;
      };
      break;
    case 'level3':
      if (current_user_can('publish_posts')){
        $showplay = true;
      };
      break;
    case 'level4':
      if (current_user_can('publish_pages')){
        $showplay = true;
      };
      break;
    case 'level5':
      if (current_user_can('manage_options')){
        $showplay = true;
      };
      break;       
    default:
      $showplay = false;
      break;
  }

  if($showplay == true){

    if($setting == 'true'){

      $totallink = $baseaddress.$playlink;

      $path   = $totallink;
      $secret = $qinmeibasesecret;
      $validtime = $qinmeibasetime;
      $expire = time() + $validtime; 

      $md5 = base64_encode(md5($secret . $path . $expire, true));
      $md5 = strtr($md5, '+/', '-_');
      $md5 = str_replace('=', '', $md5);

      $uri = $path . '?st=' . $md5 . '&e=' . $expire;

      $showuserlink = $qinmeibaselink.$uri;

    }else{

        $patterns = $general_options['qinmei_play_jiexi_pattern'];
        $jiexiarr =array();
        $patterncount = 0;
        if(!empty($patterns)){
          foreach($patterns as $pattern){
              $pattern_p = $pattern['qinmei_play_jiexi_pattern_p'];
              if (preg_match($pattern_p,$playlink)) {
                $jiexiarr[] = $pattern['qinmei_play_jiexi_pattern_j'];
                $patterncount ++;
              };
          };
          if($patterncount == 0){
            $jiexi = $general_options['qinmei_play_jiexi1'];
          }else{
            $jiexi = $jiexiarr[array_rand($jiexiarr,1)];
          }
        }else{
          $jiexi = $general_options['qinmei_play_jiexi1'];
        }

      $showuserlink = $jiexi.$playlink;
    }
  }else{
    $showuserlink = '404';
  }


  $play = array(
    'name'=>$title,
    'slug'=>$slug,
    'img'=> $img,
    'desc'=>$desc,
    'star'=>$star,
    'title'=>$playtitle,
    'link'=>$showuserlink,
    'dplayer'=>$dplayer.$sort,
    'danmu'=>$playdanmu,
    'setting'=>$setting,
    'count'=>$playcount[$sort],
    'eposide'=>$neweposide
  );
  return $play;
}
add_action( 'rest_api_init', function () {
  register_rest_route( 'wp/v2/animeinfo', '/play', array(
    'methods' => 'POST',
    'callback' => 'get_play_link_info',
  ) );
} );

add_filter('rest_endpoints', function ($routes) {
  foreach (array('animate') as $type) {
    if (!($route =& $routes['/wp/v2/' . $type])) {
      continue;
    }

    // Allow ordering by meta values
    $route[0]['args']['orderby']['enum'][] = 'baseinfo_rate';

    // Allow only specific meta keys
    $route[0]['args']['meta_key'] = array(
        'description'       => 'The meta key to query.',
        'type'              => 'string',
        'enum'              => ['baseinfo_rate_num'],
        'validate_callback' => 'rest_validate_request_arg',
    );
  }
  return $routes;
}, 10, 1);

// Manipulate query
add_filter('rest_animate_query', function ($args, $request) {
  $order_key = $request->get_param('orderby');
  if (!empty($order_key) && $order_key === 'baseinfo_rate') {
    $args['meta_key'] = $order_key;
  }

  return $args;
}, 10, 2);

add_filter( 'rest_animate_collection_params', 'prefix_rest_orderby_rand', 10, 1 );
function prefix_rest_orderby_rand( $params ) {
    $params['orderby']['enum'][] = 'rand';
    return $params;
}

add_filter( 'rest_animate_collection_params', 'my_prefix_change_post_per_page', 10, 1 );

function my_prefix_change_post_per_page( $params ) {
    if ( isset( $params['per_page'] ) ) {
        $params['per_page']['maximum'] = 1000;
    }

    return $params;
}

