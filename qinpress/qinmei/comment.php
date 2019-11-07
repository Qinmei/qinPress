<?php
function add_custom_comment_field( $comment_id ) {
   add_comment_meta( $comment_id, 'zan', [] );
   add_comment_meta( $comment_id, 'unzan',[] );
   add_comment_meta( $comment_id, 'share', [] );
   add_comment_meta( $comment_id, 'like', [] );
   add_comment_meta( $comment_id, 'report', [] );
   add_comment_meta( $comment_id, 'img', [] );
   add_comment_meta( $comment_id, 'base', 0 );
}

add_action( 'comment_post', 'add_custom_comment_field' );

function filter_rest_prepare_comment( $data, $comment, $request ) {
    $data->data['avatar'] =get_user_meta( $comment->user_id, 'vue_avatar', true);
    $data->data['info'] = $comment->comment_content;
    $data->data['time'] = explode('T',$comment->comment_date)[0].' '.explode('T',$comment->comment_date)[1];
    $data->data['qinmei'] = array(
      'img' => get_comment_meta( $comment->comment_ID, 'img', true ),
      'zan' => get_comment_meta( $comment->comment_ID, 'zan', true ),
      'unzan' => get_comment_meta( $comment->comment_ID, 'unzan', true ),
      'share' => get_comment_meta( $comment->comment_ID, 'share', true ),
      'like' => get_comment_meta( $comment->comment_ID, 'like', true ),
      'report' => get_comment_meta( $comment->comment_ID, 'report', true ),
      'base' => get_comment_meta( $comment->comment_ID, 'base', true )
    );

    $parent = $data->data['parent'];

    $post =  $data->data['post'];

    if($parent == 0){
      $comments_child = array();
      $args = array(
          'status' => 'approve',
          'post_id' => $post,
          'parent'  => $comment->comment_ID,
          'orderby'=>'time',
          'order'=>'ASC'
      );
      $children = get_comments($args);

      foreach($children as $child) :
      $avatar = get_user_meta( $child->user_id, 'vue_avatar', true);
      $child_zan = get_comment_meta($child->comment_ID,'zan',true);
      $child_unzan = get_comment_meta($child->comment_ID,'unzan',true);
      $child_report = get_comment_meta($child->comment_ID,'report',true);
      $comments_child[] = array('id'=>$child->comment_ID,
                                'name'=>$child->comment_author,
                                'avatar'=>$avatar,
                                'content'=>$child->comment_content,
                                'zan'=>$child_zan,
                                'unzan'=>$child_unzan,
                                'report'=>$child_report,
                                'time'=>$comment->comment_date
                              );
      endforeach;
      $data->data['children'] = $comments_child;
    }
    return $data;
};

function aa_comment_update($comment, $request, $create){
    if ($request['qinmei']["img"]) {
        update_comment_meta( $comment->comment_ID, 'img', $request['qinmei']["img"] );
    };
    if($request['qinmei']["base"]) {
        update_comment_meta( $comment->comment_ID, 'base', $request['qinmei']["base"] );
    }
}
add_action( 'rest_insert_comment', 'aa_comment_update', 12, 3 );

function my_update_comment_meta($request) {
  if ( !is_user_logged_in()){
    return '404';
  };
  $data = json_decode($request->get_body(), true);
  $comment = $data["id"];
  $user = get_current_user_id();
  $type = $data["meta"]['type'];
  if(in_array($type,['zan','unzan','share','like','report'])){
    $click = false;
    $value = get_comment_meta($comment,$type,true);
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
    update_comment_meta( $comment, $type, $value);

    $user_comment = get_user_meta( $user, 'comment_'.$type,true);
    if(!is_array($user_comment)){
      $user_comment = [];
    }else if (count($user_comment)==count($user_comment, 1)) {

    } else {
          $user_comment = [];
    };
    $user_comment = array_values($user_comment);
    $user_comment = array_filter($user_comment);
    if(!$click){
      array_push($user_comment ,$comment );
    }else{
      foreach($user_comment as $k=>$v){
        if($v == $comment){
          unset($user_comment[$k]);
        }
      }
    };
    update_user_meta( $user, 'comment_'.$type, $user_comment);
  }
  return get_comment_meta( $comment, $type, false)[0];
}

add_action( 'rest_api_init', function () {
  register_rest_route( 'wp/v2/update', '/comment', array(
    'methods' => 'POST',
    'callback' => 'my_update_comment_meta',
  ) );
} );

// add the filter
add_filter( 'rest_prepare_comment', 'filter_rest_prepare_comment', 10, 3 );


function my_get_user_comment( $request ) {
  if ( !is_user_logged_in()){
    return '404';
  };

  $data = json_decode($request->get_body(), true);
  $type = $data['type'];

  $userid = get_current_user_id();

  if($type == 'write'){
  	$args = array(
		'user_id' => $userid,
		'status' => 'approve'
	);
	$animate = array();
	$comments = get_comments($args);

	foreach($comments as $comment){
		$data = array();
		$data['id'] = $comment->comment_ID;
		$data['avatar'] =get_user_meta( $comment->user_id, 'vue_avatar', true);
		$data['author'] =get_userdata( $comment->user_id)->user_login;
	    $data['info'] = $comment->comment_content;
	    $data['postid'] = $comment->comment_post_ID;
	    $data['time'] = explode('T',$comment->comment_date)[0].' '.explode('T',$comment->comment_date)[1];
	    $data['qinmei'] = array(
	      'img' => get_comment_meta( $comment->comment_ID, 'img', true ),
	      'zan' => get_comment_meta( $comment->comment_ID, 'zan', true ),
	      'unzan' => get_comment_meta( $comment->comment_ID, 'unzan', true ),
	      'share' => get_comment_meta( $comment->comment_ID, 'share', true ),
	      'like' => get_comment_meta( $comment->comment_ID, 'like', true ),
	      'report' => get_comment_meta( $comment->comment_ID, 'report', true )
	    );

	    $parent = $comment->comment_parent;

	    $post =  $comment->comment_post_ID;

	    if($parent == 0){
	      $comments_child = array();
	      $args = array(
	          'status' => 'approve',
	          'post_id' => $post,
	          'parent'  => $comment->comment_ID,
	          'orderby'=>'time',
	          'order'=>'ASC'
	      );
	      $children = get_comments($args);

	      foreach($children as $child) :
	      $avatar = get_user_meta( $child->user_id, 'vue_avatar', true);
	      $child_zan = get_comment_meta($child->comment_ID,'zan',true);
	      $child_unzan = get_comment_meta($child->comment_ID,'unzan',true);
	      $child_report = get_comment_meta($child->comment_ID,'report',true);
	      $comments_child[] = array('id'=>$child->comment_ID,
	                                'name'=>$child->comment_author,
	                                'avatar'=>$avatar,
	                                'content'=>$child->comment_content,
	                                'zan'=>$child_zan,
	                                'unzan'=>$child_unzan,
	                                'report'=>$child_report,
	                                'time'=>$comment->comment_date
	                              );
	      endforeach;
	      $data['children'] = $comments_child;
	    }else{

	    }

	   $animate[] = $data;
	}

	return $animate;
  }


  $animatearr = get_user_meta($userid,'comment_'.$type,true);

  if(!$animatearr){
  	return;
  }

  if(in_array($type,['zan','share','like','report'])){

	$animate = array();



	$args=array(
		'comment__in' => $animatearr,
		'status' => 'approve',
	);
	$comments = get_comments($args);
	foreach($comments as $comment){
		$data = array();

		$data['id'] = $comment->comment_ID;
		$data['avatar'] =get_user_meta( $comment->user_id, 'vue_avatar', true);
		$data['author'] =get_userdata( $comment->user_id)->user_login;
	    $data['info'] = $comment->comment_content;
	    $data['postid'] = $comment->comment_post_ID;
	    $data['time'] = explode('T',$comment->comment_date)[0].' '.explode('T',$comment->comment_date)[1];
	    $data['qinmei'] = array(
	      'img' => get_comment_meta( $comment->comment_ID, 'img', true ),
	      'zan' => get_comment_meta( $comment->comment_ID, 'zan', true ),
	      'unzan' => get_comment_meta( $comment->comment_ID, 'unzan', true ),
	      'share' => get_comment_meta( $comment->comment_ID, 'share', true ),
	      'like' => get_comment_meta( $comment->comment_ID, 'like', true ),
	      'report' => get_comment_meta( $comment->comment_ID, 'report', true )
	    );

	    $parent = $comment->comment_parent;

	    $post =  $comment->comment_post_ID;

	    if($parent == 0){
	      $comments_child = array();
	      $args = array(
	          'status' => 'approve',
	          'post_id' => $post,
	          'parent'  => $comment->comment_ID,
	          'orderby'=>'time',
	          'order'=>'ASC'
	      );
	      $children = get_comments($args);

	      foreach($children as $child) :
	      $avatar = get_user_meta( $child->user_id, 'vue_avatar', true);
	      $child_zan = get_comment_meta($child->comment_ID,'zan',true);
	      $child_unzan = get_comment_meta($child->comment_ID,'unzan',true);
	      $child_report = get_comment_meta($child->comment_ID,'report',true);
	      $comments_child[] = array('id'=>$child->comment_ID,
	                                'name'=>$child->comment_author,
	                                'avatar'=>$avatar,
	                                'content'=>$child->comment_content,
	                                'zan'=>$child_zan,
	                                'unzan'=>$child_unzan,
	                                'report'=>$child_report,
	                                'time'=>$comment->comment_date
	                              );
	      endforeach;
	      $data['children'] = $comments_child;
	    }else{

	    }

	   $animate[] = $data;
	}

	return $animate;
  }

}

add_action( 'rest_api_init', function () {
  register_rest_route( 'wp/v2/userdata', '/comment', array(
    'methods' => 'POST',
    'callback' => 'my_get_user_comment',
  ) );
} );




add_filter('rest_endpoints', function ($routes) {
  foreach (array('comments') as $type) {
    if (!($route =& $routes['/wp/v2/' . $type])) {
      continue;
    }

    // Allow only specific meta keys
    $route[0]['args']['meta_key'] = array(
        'description'       => 'The meta key to query.',
        'type'              => 'string',
        'enum'              => ['base'],
        'validate_callback' => 'rest_validate_request_arg',
    );
  }
  return $routes;
}, 10, 1);

// Manipulate query
add_filter('rest_comment_query', function ($args, $request) {
  $order_key = $request->get_param('base');
  if (!empty($order_key)) {
    $args['meta_key'] = 'base';
    $args['meta_value'] = $order_key;
  }

  return $args;
}, 10, 2);
