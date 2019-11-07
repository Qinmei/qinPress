<?php

add_filter( 'user_contactmethods', 'wpdaxue_add_contact_fields' );
function wpdaxue_add_contact_fields( $contactmethods ) {
  if(current_user_can('manage_options' )){
    $contactmethods['time'] = '会员有效期';
  }
  unset( $contactmethods['yim'] );
  unset( $contactmethods['aim'] );
  unset( $contactmethods['jabber'] );
  return $contactmethods;
}


add_action( 'user_register', 'wpse223196_registration_save', 10, 1 );

$general_options = get_option('ashuwp_general');

function wpse223196_registration_save( $user_id ){
  add_user_meta($user_id, 'vue_backimg', $general_options["qinmei_user_backimg"]);
  add_user_meta($user_id, 'vue_avatar', $general_options["qinmei_user_avatar"]);
  add_user_meta($user_id, 'animate_like', []);
  add_user_meta($user_id, 'animate_look_for', []);
  add_user_meta($user_id, 'animate_look_gone', []);
  add_user_meta($user_id, 'animate_report', []);
  add_user_meta($user_id, 'longpost_like', []);
  add_user_meta($user_id, 'longpost_write', []);
  add_user_meta($user_id, 'longpost_report', []);
  add_user_meta($user_id, 'comment_zan', []);
  add_user_meta($user_id, 'comment_unzan', []);
  add_user_meta($user_id, 'comment_share', []);
  add_user_meta($user_id, 'comment_like', []);
  add_user_meta($user_id, 'comment_report', []);
  add_user_meta($user_id, 'qinmei_fls0a7lK_sorce', 0);
  add_user_meta($user_id, 'qinmei_fls0a7lK_level', 0);
  add_user_meta($user_id, 'qinmei_fls0a7lK_aid', str_pad($user_id, 6, mt_rand(0, 9), STR_PAD_BOTH));
}


function dw_rest_prepare_user( $data, $user, $request ) {
 	$data->data['qinmei'] = array(
      'vue_backimg' => get_user_meta( $user->ID, 'vue_backimg', true),
      'vue_avatar' => get_user_meta( $user->ID, 'vue_avatar', true),
    );
  	$data->data['node'] = array(
      'sorce' => get_user_meta( $user->ID, 'qinmei_fls0a7lK_sorce', true),
      'level' => get_user_meta( $user->ID, 'qinmei_fls0a7lK_level', true),
      'aid' => get_user_meta( $user->ID, 'qinmei_fls0a7lK_aid', true),
    );
  	$data->data['email'] = get_userdata( $user->ID)->user_email;
  	unset( $data->data['url'] );
  	unset( $data->data['link'] );
  	unset( $data->data['slug'] );
  	unset( $data->data['avatar_urls'] );
  	unset( $data->data['meta'] );
	return $data;
}

add_filter( 'rest_prepare_user', 'dw_rest_prepare_user', 10, 3 );

function aa_user_update($user, $request, $create)
{
    if ($request['qinmei']) {
        $user_id = $user->ID;
        foreach ($request['qinmei'] as $key => $value) {

        	if($key == 'animate_report'){
        		$origin = get_user_meta( $user_id, $key, true);
        		if($value == 0){
        			$origin = '';
        		}else{
        			$origin[] = $value;
        		}
        		update_user_meta( $user_id, $key, $origin );
        	}else if( $key == 'animate_look_gone'){
            $origin = get_user_meta( $user_id, $key, true);
            if($value == 0){
              $origin = '';
            }else{
              $addhistory = false;
              foreach($origin as $k=>$v){
                if($v['id'] == $value['id']){
                  $origin[$k]['sort'] = $value['sort'];
                  $origin[$k]['time'] = $value['time'];
                  $addhistory = true;
                }
              }
              if($addhistory == false){
                $origin[] = $value;
              }
            }
            update_user_meta( $user_id, $key, $origin );
          }else if( $key == 'vue_backimg' || $key == 'vue_avatar'){
        		update_user_meta( $user_id, $key, $value );
        	}
            
        }
    }
}
add_action( 'rest_insert_user', 'aa_user_update', 12, 3 );



function get_userdata_info($request) {
  if ( !is_user_logged_in()){
    return '404';
  };
  $data = json_decode($request->get_body(), true);
  $type = $data['type'];

  $userid = get_current_user_id();

  if($type == 'animate_look_for'){
    $animate = array();
    $args = array(
	    'post_type'         => 'animate',
	    'orderby'           => 'time',
	    'posts_per_page'          =>30,
	    'author'            =>$userid
	  );
	$posts = get_posts($args);
    foreach($posts as $post){
      $animate[] = array(
        'slug'=>$post->post_name,
        'title'=>$post->post_title,
        'time'=>$post->post_date,
        'status'=>$post->post_status,
        'img'=>get_post_meta($post->ID, 'baseinfo_img_link',true)
      );
    };
    return $animate;
  };

  $animatearr = get_user_meta($userid,$type,true);

  if(!$animatearr){
  	return;
  }

  if($type == 'animate_look_gone'){
    $animate = array();
    foreach($animatearr as $single){
      $post = get_post($single['id']);
      $time = $single['time'];
      $sort = $single['sort'];
      $animate[] = array(
        'slug'=>$post->post_name,
        'title'=>$post->post_title,
        'time'=>$time,
        'sort'=>$sort,
        'img'=>get_post_meta($post->ID, 'baseinfo_img_link',true)
      );
    };
  }else if($type == 'animate_like'){
    $animate = array();
    foreach($animatearr as $single){
      $post = get_post($single);
      $sort = end(get_post_meta($post->ID, 'baseinfo_episode_con',true))['baseinfo_episode_sort'];
      $animate[] = array(
        'slug'=>$post->post_name,
        'title'=>$post->post_title,
        'time'=>$post->post_modified,
        'sort'=>$sort,
        'img'=>get_post_meta($post->ID, 'baseinfo_img_link',true)
      );
    };
  }else if($type == 'animate_report'){
    $animate = array();
    foreach($animatearr as $single){
      $post = get_post($single['id']);
      $time = $single['time'];
      $content = $single['content'];
      $animate[] = array(
        'slug'=>$post->post_name,
        'title'=>$post->post_title,
        'time'=>$time,
        'sort'=>$single['sort'],
        'content'=>$content,
        'status'=>$single['status'],
        'img'=>get_post_meta($post->ID, 'baseinfo_img_link',true)
      );
    };
  }else if($type == 'longpost_write'){
    $animate = array();
    foreach($animatearr as $single){
      $post = get_post($single);
      $animate[] = array(
        'slug'=>$post->post_name,
        'title'=>$post->post_title,
        'time'=>$time,
        'sort'=>$single['sort'],
        'content'=>$content,
        'status'=>$single['status'],
        'img'=>get_post_meta($post->ID, 'baseinfo_img_link',true)
      );
    };
  }else if($type == 'longpost_like'){
    $animate = array();
    foreach($animatearr as $single){
      $post = get_post($single);
      $animate[] = array(
        'slug'=>$post->post_name,
        'title'=>$post->post_title,
        'time'=>$time,
        'sort'=>$single['sort'],
        'content'=>$content,
        'status'=>$single['status'],
        'img'=>get_post_meta($post->ID, 'baseinfo_img_link',true)
      );
    };
  }

  return $animate;
}

add_action( 'rest_api_init', function () {
  register_rest_route( 'wp/v2/userdata', '/info', array(
    'methods' => 'post',
    'callback' => 'get_userdata_info',
  ) );
} );