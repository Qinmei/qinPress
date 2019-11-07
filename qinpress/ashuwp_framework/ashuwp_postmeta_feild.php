<?php
/**
* Author: Ashuwp
* Author url: http://www.ashuwp.com
* Version: 6.1
**/

class ashuwp_postmeta_feild extends ashuwp_framework_core {
  
  var $ashu_meta, $meta_conf;
  
  function __construct($ashu_meta, $meta_conf) {
    $this->ashu_meta = $ashu_meta;
    $this->meta_conf = $meta_conf;
    
    $this->ashuwp_set_quick_edit();
    
    add_action('admin_menu', array(&$this, 'init_boxes'));
    add_action('save_post', array(&$this, 'save_postdata'));
    add_action( 'admin_enqueue_scripts', array(&$this, 'enqueue_css_js') );
    add_action( 'admin_footer', array(&$this, 'enqueue_html') );
  }
  
  public function init_boxes() {
    $this->create_meta_box();
    
  }
  
  public function create_meta_box(){
    if ( function_exists('add_meta_box') && is_array($this->meta_conf['page']) ) {
      foreach ($this->meta_conf['page'] as $area) {
      
        if( isset($this->meta_conf['template']) && $area=='page' ){
          if(isset($_GET['post']))
            $post_id = $_GET['post'];
          else
            $post_id = 0;
          
          $page_template = get_post_meta($post_id,'_wp_page_template',true);
          if( $this->meta_conf['template'] == $page_template ){
            add_meta_box(
              $this->meta_conf['id'],
              $this->meta_conf['title'],
              array(&$this, 'new_meta_boxes'), $area, $this->meta_conf['context'],
              $this->meta_conf['priority']
            );
          }
        }else{
          add_meta_box(
            $this->meta_conf['id'],
            $this->meta_conf['title'],
            array(&$this, 'new_meta_boxes'), $area, $this->meta_conf['context'],
            $this->meta_conf['priority']
          );
        }
      }
    }  
  }
  
  public function new_meta_boxes(){
    if(isset($_GET['post']))
      $post_id = $_GET['post'];
    else
      $post_id = 0;
    
    echo '<div class="tab-content ashuwp_feild_tabs clearfix">';
    $this->tab_toggle($this->ashu_meta);
    
    foreach($this->ashu_meta as $ashu_meta){
      if( ( $ashu_meta['type']=='open' || $ashu_meta['type']=='close' ) || (isset($ashu_meta['id']) && method_exists($this, $ashu_meta['type'])) ) {
        if($ashu_meta['type']=='open' || $ashu_meta['type']=='close'){
          $this->{$ashu_meta['type']}($ashu_meta);
          continue;
        }
        $meta_value = get_post_meta($post_id, $ashu_meta['id'], true);
        
        if($meta_value != "")
          $ashu_meta['std'] = $meta_value;
        
        $this->{$ashu_meta['type']}($ashu_meta);
        
      }
    }
    
    echo '</div>';
  }
  
  public function save_postdata() {
    if( isset( $_POST['post_type'] ) && in_array($_POST['post_type'],$this->meta_conf['page'] ) && (isset($_POST['save']) || isset($_POST['publish']) ) ){
	  
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
          
          if( $ashu_meta['type'] == 'tinymce' ){
            $data =  stripslashes( $_POST[$ashu_meta['id']] );
          }elseif( ( !empty($ashu_meta['multiple']) && $ashu_meta['multiple']===true ) || $ashu_meta['type'] == 'group' ){
            if($_POST[$ashu_meta['id']]!=''){
              $data = array_filter($_POST[$ashu_meta['id']]);
            }else{
              $data = '';
            }
          }elseif( $ashu_meta['type'] == 'checkbox' ){
            $data =  $_POST[$ashu_meta['id']];
          }elseif( $ashu_meta['type'] == 'numbers_array' || $ashu_meta['type'] == 'gallery' ){
            if($_POST[$ashu_meta['id']]!=''){
              $data = explode( ',', $_POST[$ashu_meta['id']] );
              $data = array_filter($data);
            }else{
              $data = '';
            }
          }elseif( in_array( $ashu_meta['type'], array('open','close','title') ) ){
            continue;
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
  
  public function ashuwp_set_quick_edit(){
    $quick_metas = array();
    foreach($this->ashu_meta as $meta){
      if( !empty($meta['quick_edit']) && $meta['quick_edit'] === true ){
        $quick_metas[] = $meta;
      }
    }
    
    if( !empty($quick_metas) ){
      $quick_edit_conf = $this->meta_conf;
      new ashuwp_postmeta_quick_edit($quick_metas, $quick_edit_conf);
    }
  }
}