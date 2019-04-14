<?php

function qinmei_create(){

$new = array(
  array('title'=>'缘之空','folder'=>'Airforse','eposide'=>array(
    array('s'=>'S01','e'=>'12')
  ),'name'=>'N301','introduce'=>'兄妹情深'),
);

foreach ( $new as $list ){
  
  $title = $list['title'];

  $folder = $list['folder'];

  $eposide = $list['eposide'];

  $name = $list['name'];

  $introduce = $list['introduce'];

  $catp = wp_create_category( $title);

  foreach($eposide as $season){
    $catc = wp_create_category( $season['s'].'-'.$title, $catp);
  }

      $args = array(
      'comment_status' => 'open',
      'post_content'   => '',
      'post_excerpt'   => '',
      'post_name'      => $name,
      'post_status'    => 'publish',
      'post_title'     => $title,
      'post_type'      => 'page',
      'meta_input' => array( 
        'page_tab_address' => $folder,
        'page_tab_cat' => $catp
      )
    );
    wp_insert_post( $args );

}

}