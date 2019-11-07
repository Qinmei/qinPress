<?php

function get_animate_longpost($request) {
  $data = json_decode($request->get_body(), true);
  $animate = $data["animate"];
  $type = $data['type'];

  if($type){
  	if ( !is_user_logged_in()){
	  return '404';
	};

	$userid = get_current_user_id();

	if($type == 'write'){
		$args = array(
		    'post_type'         => 'post',
		    'posts_per_page'    => -1,
		    'orderby'           => 'time',
		    'author' => $userid
		  );
		$animate = array();
	  	$posts = get_posts($args);
	    foreach($posts as $post){
		    $content =strip_tags($post->post_content);
		    $content = substr($content , 0 , 60);
		    $headimg = get_post_meta($post->ID, 'headimg',true);
		    $avatar = get_user_meta( $userid, 'vue_avatar', true);
	    	$author = get_user_by('id', $userid)->user_login;
		    $comment = get_comments_number( $post->ID);
		    $view = get_post_meta($post->ID, 'view',true);
		    $animate[] = array(
		      'id'=>$post->ID,
		      'author'=>$author,
	      	  'avatar'=>$avatar,
		      'date'=>$post->post_date,
		      'status'=>$post->post_status,
		      'title'=>$post->post_title,
		      'content'=>$content,
		      'headimg' => $headimg,
		      'comment' => $comment,
		      'view' => $view
		    );
		}
	}else{
		$animate = array();
	  	$userarr = get_user_meta($userid,'longpost_'.$type,true);
	  	if(!is_array($userarr)){
	  		return ;
	  	};
	    foreach($userarr as $single){
	      $post = get_post($single['id']);
	      $time = $single['time'];
	      $report = $single['report'];
	      $status = $single['status'];
	      $avatar = get_user_meta( $userid, 'vue_avatar', true);
	      $author = get_user_by('id', $userid)->user_login;
	      $content =strip_tags($post->post_content);
	      $content = substr($content , 0 , 60);
		  $headimg = get_post_meta($post->ID, 'headimg',true);
		  $comment = get_comments_number( $post->ID);
		  $view = get_post_meta($post->ID, 'view',true);
	      $animate[] = array(
	        'id'=>$post->ID,
	        'title'=>$post->post_title,
	        'time'=>$time,
	        'author'=>$author,
	      	'avatar'=>$avatar,
	        'report'=>$report,
	        'content'=>$content,
		    'headimg' => $headimg,
		    'status' => $status,
		    'comment' => $comment,
		    'view' => $view
	      );
	    };
	}
    return $animate;
  }else{
	  $args = array(
	    'post_type'         => 'post',
	    'post_status'       => 'publish',
	    'posts_per_page'    => -1,
	    'orderby'           => 'time',
	    'meta_query'        => array(
	        array(
	            'key'       => 'animate',
	            'value'     => $animate,
	        )
	    )
	  );
	  $posts = get_posts($args);
	  $longpost = array();
	  foreach($posts as $post){
	    $content =strip_tags($post->post_content);
	    $user_id = $post->post_author;
	    $avatar = get_user_meta( $user_id, 'vue_avatar', true);
	    $author = get_user_by('id', $user_id)->user_login;
	    $content = substr($content , 0 , 60);
	    $headimg = get_post_meta($post->ID, 'headimg',true);
	    $comment = get_comments_number( $post->ID);
	    $view = get_post_meta($post->ID, 'view',true);
	    $longpost[] = array(
	      'id'=>$post->ID,
	      'author'=>$author,
	      'avatar'=>$avatar,
	      'date'=>$post->post_date,
	      'title'=>$post->post_title,
	      'content'=>$content,
	      'headimg' => $headimg,
	      'comment' => $comment,
	      'view' => $view
	    );
	  }
	  update_post_meta( $animate,  'longpost', count($posts));
	  return $longpost;
	}
}

add_action( 'rest_api_init', function () {
  register_rest_route( 'wp/v2/anime', '/longpost', array(
    'methods' => 'post',
    'callback' => 'get_animate_longpost',
  ) );
} );



function dw_rest_prepare_post( $data, $post, $request ) {
  $data->data['headimg'] = get_post_meta($post->ID, 'headimg',true);
  $data->data['animate'] = get_post_meta($post->ID, 'animate',true);
  $content =strip_tags($post->post_content);
  $content = substr($content , 0 , 60);
  $data->data['view'] = get_post_meta($post->ID, 'view',true);
  $data->data['comment'] =  get_comments_number( $post->ID);
  $data->data['headimg'] =  get_post_meta($post->ID, 'headimg',true);
  $data->data['like'] =  get_post_meta($post->ID, 'like',true);
  $data->data['report'] =  get_post_meta($post->ID, 'report',true);
  $data->data['user'] = array(
    'avatar'=> get_user_meta( $post->post_author, 'vue_avatar', true),
    'name'=>get_user_by( 'id',$post->post_author)->user_login,
    'desc'=>get_user_meta( $post->post_author, 'description', true),
    'animate' => get_post(get_post_meta($post->ID, 'animate',true))->post_title,
    'smalldes' => $content
  );
  unset( $data->data['date'] );
  unset( $data->data['comment_status'] );
  unset( $data->data['status'] );
  unset( $data->data['excerpt'] );
  unset( $data->data['ping_status'] );
  unset( $data->data['type'] );
  unset( $data->data['guid'] );
  unset( $data->data['featured_media'] );
  unset( $data->data['modified'] );
  unset( $data->data['modified_gmt'] );
  unset( $data->data['ping_status'] );
  unset( $data->data['sticky'] );
  unset( $data->data['template'] );
  unset( $data->data['format'] );
  unset( $data->data['categories'] );
	return $data;

}

add_filter( 'rest_prepare_post', 'dw_rest_prepare_post', 10, 3 );

add_action( 'rest_api_init', function() {

	register_rest_field( 'post', 'metadata', array(

		'get_callback' => function( $object ) {
			return get_post_meta($object->ID);
		},

		'update_callback' => function( $meta, $post ) {
			$postId = $post->ID;

			foreach ($meta as $data) {
				update_post_meta($postId, $data['key'], $data['value']);
			}

			return true;
		},

	));

});



function my_update_post_meta_longpost($request) {


  $data = json_decode($request->get_body(), true);
  $post = $data["id"];
  $type = $data["meta"]['type'];

  if($type == 'view'){
  	 $value = get_post_meta($post,$type,true);
  	 if(is_numeric($value)){
  	 	$value++;
  	 }else{
  	 	$value = 0;
  	 };
  	 
  	 update_post_meta( $post, $type, $value);
  	 return $value;
  };
  if ( !is_user_logged_in()){
    return '404';
  };
  $user = get_current_user_id();

  if($type == 'like' || $type == 'report'){

    $value = get_post_meta($post,$type,true);
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
    update_post_meta( $post, $type, $value);

    $user_post = get_user_meta( $user, 'longpost_'.$type,true);
    if(!is_array($user_post)){
      $user_post = [];
    }else if (count($user_post)==count($user_post, 1)) {

    } else {
          $user_post = [];
    };
    $user_post = array_values($user_post);
    $user_post = array_filter($user_post);
    if(!$click){
      array_push($user_post ,$post );
    }else{
      foreach($user_post as $k=>$v){
        if($v == $post){
          unset($user_post[$k]);
        }
      }
    };
    update_user_meta( $user, 'longpost_'.$type, $user_post);
  }
  return get_post_meta( $post, $type, false)[0];
}

add_action( 'rest_api_init', function () {
  register_rest_route( 'wp/v2/update', '/post', array(
    'methods' => 'POST',
    'callback' => 'my_update_post_meta_longpost',
  ) );
} );