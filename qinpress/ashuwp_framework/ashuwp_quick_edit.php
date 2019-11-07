<?php
/**
* Author: Ashuwp
* Author url: http://www.ashuwp.com
* Version: 6.4
**/

class ashuwp_postmeta_quick_edit extends ashuwp_framework_core {
  
  var $ashu_meta, $meta_conf, $clear;
  
  function __construct($ashu_meta, $meta_conf) {
    $this->ashu_meta = $ashu_meta;
    $this->meta_conf = $meta_conf;
    $this->ashuwp_quick_edit_type_allowed();
    
    foreach ($this->meta_conf['page'] as $area) {
      //Display custom columns
      add_filter( "manage_{$area}_posts_columns", array(&$this, 'ashuwp_post_type_columns') );
      add_action( "manage_{$area}_posts_custom_column", array(&$this, 'ashuwp_show_post_type_column'), 10, 2 );
      //Quick edit box
      add_action( 'quick_edit_custom_box', array(&$this, 'ashuwp_add_quick_edit_box'), 10, 2 );
    }
    
    add_action('save_post', array(&$this, 'ashuwp_save_quick_edit_data'));
  }
  
  public function ashuwp_quick_edit_type_allowed(){
    foreach($this->ashu_meta as $key=>$meta){
      if( empty($meta['id']) ){
        unset($this->ashu_meta[$key]);
      }
      if( !empty($meta['multiple']) && $meta['multiple'] != true ){
        unset($this->ashu_meta[$key]);
      }
      
      if( !in_array( $meta['type'], array( 'text', 'numbers_array', 'color', 'radio', 'checkbox', 'textarea', 'select' ) ) ){
        unset($this->ashu_meta[$key]);
      }
    }
  }
  //Add a custom column
  public function ashuwp_post_type_columns( $columns ){
    unset($columns['date']);
    foreach($this->ashu_meta as $ashu_meta){
      if( !empty($ashu_meta['id']) ){
        $columns[$ashu_meta['id']] = $ashu_meta['name'];
      }
    }
    $columns['date']=__('Date');
    return $columns;
  }
  
  public function ashuwp_show_post_type_column( $column_name, $id ){

    foreach($this->ashu_meta as $ashu_meta){
      if( !empty($ashu_meta['id']) ){
        
        if( $column_name == $ashu_meta['id'] ){
          $meta_value = get_post_meta($id, $ashu_meta['id'], true);
          
          if( in_array($ashu_meta['type'], array('text', 'textarea') ) ){
            echo $meta_value;
          }
          
          if( $ashu_meta['type'] == 'numbers_array' ){
            if( !empty($meta_value) && is_array($meta_value) ){
              echo implode( ',', $meta_value );
            }
          }
            
          if( $ashu_meta['type'] == 'color' ){
            echo '<span data-color="'.$meta_value.'" style="display:block;margin: 5px 0 0 0;width:30px;height:10px;background-color:'.$meta_value.'"></span>';
          }
            
            
          if( in_array($ashu_meta['type'], array('radio', 'select') ) ){
            $entries = $this->select_entries($ashu_meta);
            foreach(  $entries as $id => $title ) {
              if( $meta_value == $id ) {
                echo $title;
              }
            }
          }
            
          if( $ashu_meta['type'] == 'checkbox' ){
            $entries = $this->select_entries($ashu_meta);
            if(empty($meta_value)){
              $meta_value = array();
            }
              
            $t = array();
            foreach(  $entries as $id => $title ) {
              if( in_array($id,$meta_value) ) {
                $t[] = $title;
              }
            }
              
            echo implode( ',', $t );
          }
        }
      }
    }
  }
  
  public function ashuwp_add_quick_edit_box(  $column_name, $post_type ){
    if( in_array( $post_type, $this->meta_conf['page']) ){
      foreach($this->ashu_meta as $key=>$ashu_meta){
        if($column_name==$ashu_meta['id']){
          $values = array(
            'id'  => $ashu_meta['id'],
            'name'=> $ashu_meta['name'],
            'desc'=> '',
            'std' => '',
            'class' => 'ashuwp_quick_edit_field',
            'type' => $ashu_meta['type']
          );
          if( !empty($ashu_meta['subtype']) ){
            $values['subtype'] = $ashu_meta['subtype'];
          }
          $this->{$ashu_meta['type']}($values);
        }
      }
    }
  }
  
  public function ashuwp_save_quick_edit_data(){
    if( isset( $_POST['action'] ) && $_POST['action']=='inline-save' ){
      $post_id = $_POST['post_ID'];
      if(!$post_id)
        return;
      
      if ( 'page' == $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id  ) )
          return 0;
      }else{
        if ( !current_user_can( 'edit_post', $post_id  ) )
          return 0;
      }
      
      foreach ($this->ashu_meta as $ashu_meta) {
        if( isset($ashu_meta['id']) && $ashu_meta['id'] ){
          
          $old_data = get_post_meta($post_id , $ashu_meta['id']);
          
          if( $ashu_meta['type'] == 'checkbox' ){
            $data =  $_POST[$ashu_meta['id']];
          }elseif( $ashu_meta['type'] == 'numbers_array' ){
            if($_POST[$ashu_meta['id']]!=''){
              $data = explode( ',', $_POST[$ashu_meta['id']] );
              $data = array_filter($data);
            }else{
              $data = '';
            }
          }else{
            $data = htmlspecialchars($_POST[$ashu_meta['id']], ENT_QUOTES,"UTF-8");
          }
          
          if($data == "")
            delete_post_meta($post_id , $ashu_meta['id'], $data);
          else
            update_post_meta($post_id , $ashu_meta['id'], $data);
          
        }
      }
    }
  }
  
}