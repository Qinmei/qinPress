<?php
/**
* Ashuwp_framework
* Author: Ashuwp
* Author url: http://www.ashuwp.com
* Version: 6.4
**/

class ashuwp_framework_core {
  
  public $file_ico=array(
    'archive' => 'images/media/archive.png',
    'audio' => 'images/media/audio.png',
    'code' =>  'images/media/code.png',
    '_default' =>  'images/media/default.png',
    '_document' =>  'images/media/document.png',
    'interactive' =>  'images/media/interactive.png',
    'spreadsheet' => 'images/media/spreadsheet.png',
    '_text' => 'images/media/text.png',
    'video' => 'images/media/video.png'
  );
  public $enqueue_html = array();
  
  public function enqueue_css_js() {
    wp_enqueue_media();
    wp_enqueue_style('ashuwp_framework_css', get_template_directory_uri(). '/ashuwp_framework/css/ashuwp_framework.css');
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker' );
    wp_enqueue_script( 'jquery-ui-tabs' );
    wp_enqueue_script('ashuwp_framework_js', get_template_directory_uri(). '/ashuwp_framework/js/ashuwp_framework.js','','',true);
    wp_localize_script( 'ashuwp_framework_js', 'ashu_file_preview', array('img_base'=>includes_url(),'img_path'=>$this->file_ico,'ajaxurl' => admin_url( 'admin-ajax.php' )));
  }
  
  public function enqueue_html(){
    $html_output = '';
    foreach( $this->enqueue_html as $id => $tem_html ){
      $html_output .= '<script type="text/html" id="'.$id.'">';
      $html_output .= $tem_html;
      $html_output .= '</script>';
    }
    
    echo $html_output;
  }
  
  public function get_file_ico($src){
    $file_type = substr($src, strrpos($src , '.') + 1);
    $file_ico = includes_url();
    if( in_array($file_type,array('png','jpg','gif','bmp','svg')) ){
      $file_ico = $src;
    }elseif( in_array($file_type,array('zip','rar','7z','gz','tar','bz','bz2')) ){
      $file_ico .= $this->file_ico['archive'];
    }elseif( in_array($file_type,array('mp3','wma','wav','mod','ogg','au')) ){
      $file_ico .= $this->file_ico['audio'];
    }elseif( in_array($file_type,array('avi','mov','wmv','mp4','flv','mkv')) ){
      $file_ico .= $this->file_ico['video'];
    }elseif( in_array($file_type,array('swf')) ){
      $file_ico .= $this->file_ico['interactive'];
    }elseif( in_array($file_type,array('php','js','css','json','html','xml')) ){
      $file_ico .= $this->file_ico['code'];
    }elseif( in_array($file_type,array('doc','docx','pdf','wps')) ){
      $file_ico .= $this->file_ico['_document'];
    }elseif( in_array($file_type,array('xls','xlsx','csv','et','ett')) ){
      $file_ico .= $this->file_ico['spreadsheet'];
    }elseif( in_array($file_type,array('txt','rtf')) ){
      $file_ico .= $this->file_ico['_text'];
    }else{
      $file_ico .= $this->file_ico['_default'];
    }
    return $file_ico;
  }
  
  public function ashuwp_get_posts_by_level($args, $space = ''){
    $pages = array();
    $args['posts_per_page'] = 999;
    $top_pages = get_posts($args);
    
    if(!empty($top_pages)){
      foreach($top_pages as $page){
        
        $pages[$page->ID] = $page->post_title;
        
        $args['post_parent'] = $page->ID;

        $child_pages = $this->ashuwp_get_posts_by_level( $args );
        foreach($child_pages as $key=>$title){
          $pages[$key] = $space . $title;
        }
      }
    }
    
    return $pages;
  }
  
  public function ashuwp_get_terms_by_level($args, $space = ''){
    $terms = array();
    $top_terms = get_terms($args);
    
    if ( $top_terms && ! is_wp_error( $top_terms ) ){
      foreach($top_terms as $term){
        
        $terms[$term->term_id] = $term->name;
        $args['parent'] = $term->term_id;

        $child_terms = $this->ashuwp_get_terms_by_level( $args, $space );
        foreach($child_terms as $key=>$title){
          $terms[$key] = $space . $title;
        }
      }
    }
    
    return $terms;
  }
  
  public function select_entries( $values ){
    if( empty($values['subtype'])){
      $values['subtype'] = '';
    }
    
    $taxonomies_names = get_taxonomies( array("show_ui" => true, "_builtin" => false), 'names' );
    $taxonomies_names[] = 'category';
    $taxonomies_names[] = 'post_tag';
    $taxonomies_names[] = 'nav_menu';
        
    $post_types = get_post_types( array( 'public'   => true, '_builtin' => false), 'names' );
    $post_types[] = 'post';
    $post_types[] = 'page';
    
    $entries = array();
    
    if( in_array($values['subtype'], $post_types) ) {
      if($values['type']=='select'){
        $space = '&nbsp;&nbsp;&nbsp;';
      }else{
        $space = '';
      }
      $entries = $this->ashuwp_get_posts_by_level( array('post_type'=>$values['subtype'],'post_parent'=>0), $space );
    }elseif($values['subtype'] == 'sidebar'){
      global $wp_registered_sidebars;
      $sidebars = $wp_registered_sidebars;
      foreach( $sidebars as $sidebar ){
        $entries[$sidebar['id']] = $sidebar['id'];
      }
    }elseif( in_array($values['subtype'],$taxonomies_names) ){
      $t_args = array(
        'taxonomy' => $values['subtype'],
        'hide_empty' => false,
        'parent' => 0,
        'orderby' => 'id',
        'order' => 'DESC'
      );
      if($values['type']=='select'){
        $space = '&nbsp;&nbsp;&nbsp;';
      }else{
        $space = '';
      }
      $entries = $this->ashuwp_get_terms_by_level( $t_args, $space );
    }elseif($values['subtype'] == 'user'){
      $all_users = get_users();
      foreach($all_users as $user){
        $entries[$user->ID] = $user->user_login;
      }
    }else{
      if(is_array($values['subtype'])){
        $entries = $values['subtype'];
      }else{
        $entries = array();
      }
    }
    
    return $entries;
  }
  
  /**tab toggle**/
  public function tab_toggle($arr){
    if(!$arr)
      return;
    
    $active = 'class="active"';
    $output = '';
    
    foreach($arr as $values){
     if( empty($values['id']) )
        continue;
      
      if( $values['type']=='open' ){
        if( empty($values['name']) )
          $values['name'] = $values['id'];
        
        $output .= '<li '.$active.'><a href="#tab_'.$values['id'].'" data-toggle="tab">'.$values['name'].'</a></li>';
        $active = '';
      }
    }
    if( $output != '' )
      echo '<ul class="nav-tabs">'.$output.'</ul>';
  }
  
  /**tab open**/
  public function open($values) {
    if(empty($values['id']))
      return;
    
    $group_class = 'class="widefat field_groups tab-pane"';
    $group_id = 'tab_'.$values['id'];

    if(empty($values['name']))
        $values['name'] = "";
    
    echo '<div id="'.$group_id.'" '.$group_class .'>';
      
    if( !isset($values['name']) && $values['name']!='' )
      echo '<div class="groups_title">'.$values['name'].'</div>';
  }
  
  /**tab close**/
  public function close($values) {
    if( !empty($values['name']) )
      echo '<div class="groups_footer_title">'.$values['name'].'</div>';
    
    echo '</div>';
  }
  
  function before_tags($values){
    $class = array('ashuwp_field');
    $class[] = 'ashuwp_'.$values['type'].'_field';
    if( !empty($values['class']) ){
      $class[] = $values['class'];
    }
    $name = '';
    if( !empty($values['name']) ){
      $name = $values['name'];
    }
    if($values['type']=='title'){
      $values['id'] = '';
    }
    echo '<div class="'.implode(' ', $class).'">';
      if( !empty($name) ){
        echo '<label class="ashuwp_field_label" for="'.$values['id'].'">'.$name.'</label>';
      }
      echo '<div class="ashuwp_field_area">';
  }
  
  function after_tags(){
    echo '</div></div>';
  }
  
  /**cutsom page**/
  public function custom($values) {
    if(!empty($values['function']) && function_exists( $values['function'] ) ){
      call_user_func($values['function']);
    }
  }
  
  /**title**/
  public function title($values) {
    
    $this->before_tags($values);
      
      if( !empty($values['desc']) )
        echo '<p>'.$values['desc'].'</p>';
      
    $this->after_tags();
  }
  
  /**input type=text**/
  public function text($values) {
    if( empty($values['id']) )
      return;
    
    if( empty($values['std']) ){
      $values['std'] = '';
    }
    
    if( !empty($values['desc']) ){
      $values['desc'] = '<p>'.$values['desc'].'</p>';
    }else{
      $values['desc'] = '';
    }
    
    $format = '<input type="text" id="%s" name="%s" value="%s" class="ashuwp_field_input" />%s';
    
    if( !empty($values['multiple']) && $values['multiple'] === true ){
      $format = '<div class="multiple_item clearfix">'.$format.'<a href="#" class="delete_item">Delete</a></div>';
      
      $this->enqueue_html['ashuwp_framework_html_'.$values['id']] = sprintf( $format, $values['id'].'_{{i}}', $values['id'].'[{{i}}]', '', $values['desc'] );
      
    }

    $this->before_tags($values);
    
    
    if( !empty($values['multiple']) && $values['multiple'] === true ){
      if( empty( $values['std'] ) || !is_array( $values['std'] ) ){
        $values['std'] = array();
      }
      $i=0;
      echo '<div class="multiple_wrap clearfix">';
      foreach($values['std'] as $key=>$val){
        $i++;
        echo sprintf( $format, $values['id'].'_'.$i, $values['id'].'['.$i.']', $val, $values['desc'] );
      }
      echo '<a href="#" class="add_item button-secondary" data_name="ashuwp_framework_html_'.$values['id'].'">Add</a></div>';
    }else{
      echo sprintf( $format, $values['id'], $values['id'], $values['std'], $values['desc'] );
    }
    
    $this->after_tags();
    
  }
  
  /**input type=numbers_array**/
  public function numbers_array($values) {
    if( empty($values['id']) )
      return;
    
    if( !empty($values['multiple']) && $values['multiple'] === true ){
      if( !empty($values['std']) && is_array($values['std']) ){
        foreach( $values['std'] as $key => $value ){
          $value_tem = '';
          $value_tem = implode( ',', $value );
          $values['std'][$key] = $value_tem;
        }
      }else{
        $values['std'] = array();
      }
      
    }else{
      if( !empty($values['std']) && is_array($values['std']) ){
        $nums = implode( ',', $values['std'] );
      }else{
        $nums = '';
      }
      
      $values['std'] = $nums;
    }
    
    if( !empty($values['desc']) ){
      $values['desc'] = '<p>'.$values['desc'].'</p>';
    }else{
      $values['desc'] = '';
    }
    
    $this->text($values);
    
  }
  
  /**coloricker**/
  public function color($values) {
    if( empty($values['id']) )
      return;
    
    if( empty($values['class']) ){
      $values['class'] = '';
    }
    $values['class'] .= 'ashuwp_color_picker';
    
    $this->text($values);

  }
  
  /*input type=radio*/
  public function radio($values) {
    if( empty($values['id']) )
      return;
    
    if( empty($values['std']) ){
      $values['std'] = '';
    }
    
    if( !empty($values['desc']) ){
      $values['desc'] = '<p>'.$values['desc'].'</p>';
    }else{
      $values['desc'] = '';
    }
    
    $entries = $this->select_entries($values);
    
    $format = '<label for="%s"><input type="radio" id="%s" name="%s" value="%s" class="ashuwp_field_radio" %s data-text="%s" />%s</label>';
    
    if( !empty($values['multiple']) && $values['multiple'] === true ){
      
      $html_format = '<div class="multiple_item clearfix">';
      foreach(  $entries as $id => $title ) {
        $checked = '';
        if( $values['std'] == $id ) {
          $checked = 'checked = "checked"';
        }
          
        $html_format .= sprintf( $format, $values['id'].'_'.$id.'_{{i}}', $values['id'].'_'.$id.'_{{i}}', $values['id'].'[{{i}}]', $id, $checked, $title, $title );
      }
      $html_format .= $values['desc'].'<a href="#" class="delete_item">Delete</a></div>';
      
      $this->enqueue_html['ashuwp_framework_html_'.$values['id']] = $html_format;
      
    }
    
    $this->before_tags($values);
    
      if( !empty($values['multiple']) && $values['multiple'] === true ){
        
        if( empty( $values['std'] ) || !is_array( $values['std'] ) ){
          $values['std'] = array();
        }
        
        echo '<div class="multiple_wrap clearfix">';
        
        
        $i=0;
        foreach($values['std'] as $key=>$val){
          $i++;
          echo '<div class="multiple_item clearfix">';
          
          foreach(  $entries as $id => $title ) {
            $checked = '';
            if( $val == $id ) {
              $checked = 'checked = "checked"';
            }
            
            echo sprintf( $format, $values['id'].'_'.$id.'_'.$i, $values['id'].'_'.$id.'_'.$i, $values['id'].'['.$i.']', $id, $checked, $title, $title );
            
            echo '<a href="#" class="delete_item">Delete</a>';
            
          }
          
          echo $values['desc'].'</div>';

        }
        
        echo '<a href="#" class="add_item button-secondary" data_name="ashuwp_framework_html_'.$values['id'].'">Add</a></div>';
        
      }else{
        foreach(  $entries as $id => $title ) {
          $checked = '';
          if( $values['std'] == $id ) {
            $checked = 'checked = "checked"';
          }
          
          echo sprintf( $format, $values['id'].'_'.$id, $values['id'].'_'.$id, $values['id'], $id, $checked, $title, $title );
        }
        
        echo $values['desc'];
      }
        
    $this->after_tags();
  }
  
  /*input type=checkbox*/
  public function checkbox($values) {
    
    if( empty($values['id']) )
      return;
    
    if(empty($values['std'])){
      $values['std'] = array();
    }

    if( !empty($values['desc']) ){
      $values['desc'] = '<p>'.$values['desc'].'</p>';
    }else{
      $values['desc'] = '';
    }
    
    $entries = $this->select_entries($values);
    
    $format = '<label for="%s"><input type="checkbox" id="%s" name="%s" value="%s" class="ashuwp_field_checkbox" %s data-text="%s" />%s</label>';
    
    if( !empty($values['multiple']) && $values['multiple'] === true ){
      
      $html_format = '<div class="multiple_item clearfix">';
      foreach(  $entries as $id => $title ) {
        $checked = '';
        if( in_array($id,$values['std']) ) {
          $checked = 'checked = "checked"';
        }
          
        $html_format .= sprintf( $format, $values['id'].'_'.$id.'_{{i}}', $values['id'].'_'.$id.'_{{i}}', $values['id'].'[{{i}}][]', $id, $checked, $title, $title );
      }
      $html_format .= $values['desc'].'<a href="#" class="delete_item">Delete</a></div>';
      
      $this->enqueue_html['ashuwp_framework_html_'.$values['id']] = $html_format;
      
    }
    
    $this->before_tags($values);
      if( !empty($values['multiple']) && $values['multiple'] === true ){
        
        if( empty( $values['std'] ) || !is_array( $values['std'] ) ){
          $values['std'] = array();
        }
        
        echo '<div class="multiple_wrap clearfix">';
        
        $i=0;
        foreach($values['std'] as $key=>$val){
          if( is_array($val)){
            $i++;
            echo '<div class="multiple_item clearfix">';
            
            foreach(  $entries as $id => $title ) {
              $checked = '';
              if( in_array($id,$val) ) {
                $checked = 'checked = "checked"';
              }
              
              echo sprintf( $format, $values['id'].'_'.$id.'_'.$i, $values['id'].'_'.$id.'_'.$i, $values['id'].'['.$i.']'.'[]', $id, $checked, $title, $title );
              
              echo '<a href="#" class="delete_item">Delete</a>';
              
            }
            
            echo $values['desc'].'</div>';
          }
        }
        
        echo '<a href="#" class="add_item button-secondary" data_name="ashuwp_framework_html_'.$values['id'].'">Add</a></div>';
        
      }else{
        foreach(  $entries as $id => $title ) {
          $checked ="";
          if( in_array($id,$values['std']) ) {
            $checked = 'checked = "checked"';
          }
          
          echo sprintf( $format, $values['id'].'_'.$id, $values['id'].'_'.$id, $values['id'].'[]', $id, $checked, $title, $title );
        }
        
        echo $values['desc'];
      }

    $this->after_tags();
  }
  
  /*textarea*/
  public function textarea($values) {
    if( empty($values['id']) )
      return;
    
    if( empty($values['std']) ){
      $values['std'] = '';
    }
    
    if( !empty($values['desc']) ){
      $values['desc'] = '<p>'.$values['desc'].'</p>';
    }else{
      $values['desc'] = '';
    }
    
    $format = '%s<textarea id="%s" name="%s" class="ashuwp_field_textarea" >%s</textarea>';
    
    if( !empty($values['multiple']) && $values['multiple'] === true ){
      $format = '<div class="multiple_item clearfix">'.$format.'<a href="#" class="delete_item">Delete</a></div>';
      
      $this->enqueue_html['ashuwp_framework_html_'.$values['id']] = sprintf( $format, $values['desc'], $values['id'].'_{{i}}', $values['id'].'[{{i}}]', '' );
      
    }

    $this->before_tags($values);
    
    if( !empty($values['multiple']) && $values['multiple'] === true ){
      if( empty( $values['std'] ) || !is_array( $values['std'] ) ){
        $values['std'] = array();
      }
      $i=0;
      echo '<div class="multiple_wrap clearfix">';
      foreach($values['std'] as $key=>$val){
        $i++;
        echo sprintf( $format, $values['desc'], $values['id'].'_'.$i, $values['id'].'['.$i.']', $val );
      }
      echo '<a href="#" class="add_item button-secondary" data_name="ashuwp_framework_html_'.$values['id'].'">Add</a></div>';
    }else{
      echo sprintf( $format, $values['desc'], $values['id'], $values['id'], $values['std'] );
    }
    
    $this->after_tags();

  }
  
  /*select*/
  public function select($values) {
    if( empty($values['id']) )
      return;
    
    if( !empty($values['desc']) ){
      $values['desc'] = '<p>'.$values['desc'].'</p>';
    }else{
      $values['desc'] = '';
    }
    
    $entries = $this->select_entries($values);

    $format = '<option value="%s" %s >%s</option>';
    
    if( !empty($values['multiple']) && $values['multiple'] === true ){

      $html_format = '<div class="multiple_item clearfix">';
      
      $html_format .= '<select id="'. $values['id'].'_{{i}}' .'" name="'. $values['id'].'[{{i}}]' .'" class="ashuwp_field_select">';
      
      $html_format .= '<option value="">Select...</option>';
      foreach(  $entries as $id => $title ) {
        $checked = '';
        if( $values['std'] == $id ) {
          $checked = 'selected="selected"';
        }
          
        $html_format .= sprintf( $format, $id, $checked, $title );
      }
      
      $html_format .= '</select>';
      $html_format .= $values['desc'].'<a href="#" class="delete_item">Delete</a></div>';
      
      $this->enqueue_html['ashuwp_framework_html_'.$values['id']] = $html_format;
      
    }
    
    $this->before_tags($values);
      if( !empty($values['multiple']) && $values['multiple'] === true ){
        
        if( empty( $values['std'] ) || !is_array( $values['std'] ) ){
          $values['std'] = array();
        }
        
        echo '<div class="multiple_wrap clearfix">';
        
        $i=0;
        foreach($values['std'] as $key=>$val){
          $i++;
          echo '<div class="multiple_item clearfix">';
          
          echo '<select id="'. $values['id'].'_'.$i .'" name="'. $values['id'].'['.$i .']' .'" class="ashuwp_field_select">';
          
          echo '<option value="">Select...</option>';
          
          foreach(  $entries as $id => $title ) {
            $selected = '';
            if( $val == $id ) {
              $selected = "selected='selected'";
            }
            
            echo sprintf( $format, $id, $selected, $title );
          }
          
          echo '</select>';
          echo $values['desc'].'<a href="#" class="delete_item">Delete</a></div>';

        }
        
        echo '<a href="#" class="add_item button-secondary" data_name="ashuwp_framework_html_'.$values['id'].'">Add</a></div>';
        
      }else{
        
        echo '<select class="ashuwp_field_select" id="'. $values['id'] .'" name="'. $values['id'] .'"> ';
        
          echo '<option value="">Select...</option>';
          
          foreach ($entries as $id => $title) {

            if ($values['std'] == $id ) {
              $selected = "selected='selected'";
            }else{
              $selected = "";
            }
            
            echo '<option '.$selected.' value="'. $id.'">'. $title.'</option>';
          }
        echo '</select>';
        echo $values['desc'];
      }
        
    $this->after_tags();
  }
  
  /**upload**/
  public function upload($values) {
    if( empty($values['id']) )
      return;
    
    if( empty($values['std']) ){
      $values['std'] = '';
    }
    
    if( !empty($values['desc']) ){
      $values['desc'] = '<p>'.$values['desc'].'</p>';
    }else{
      $values['desc'] = '';
    }

    $button_text = (empty($values['button_text'])) ? 'Upload' : $values['button_text'];

    $file_view = '';
    
    if( $values['std'] != '' && !is_array($values['std']) ){
      $file_view = '<img src="'.$this->get_file_ico($values['std']).'" />';
    }
    
    if( !empty($values['multiple']) && $values['multiple'] === true ){
      $format = '<div class="multiple_item clearfix"><div id="%s" class="ashuwp_file_preview">%s</div><div class="ashuwp_upload_input"><input type="text" id="%s" name="%s" value="%s" class="ashuwp_field_upload" /><a id="%s" class="ashu_upload_button button" href="#">%s</a></div>%s<a href="#" class="delete_item">Delete</a></div>';
      
      $this->enqueue_html['ashuwp_framework_html_'.$values['id']] = sprintf( $format, $values['id'].'_preview_{{i}}','', $values['id'].'_upload_{{i}}', $values['id'].'[{{i}}]', '', $values['id'].'_{{i}}',  $button_text, $values['desc'] );
      
    }else{
      $format = '<div id="%s" class="ashuwp_file_preview">%s</div><div class="ashuwp_upload_input"><input type="text" id="%s" name="%s" value="%s" class="ashuwp_field_upload" /><a id="%s" class="ashu_upload_button button" href="#">%s</a></div>%s';
    }
    
    $this->before_tags($values);
      if( !empty($values['multiple']) && $values['multiple'] === true ){
        if( empty( $values['std'] ) || !is_array( $values['std'] ) ){
          $values['std'] = array();
        }
        $i=0;
        echo '<div class="multiple_wrap clearfix">';
        foreach($values['std'] as $key=>$val){
          $i++;
          $file_view = '';
          if( $val != '' ){
            $file_view = '<img src="'.$this->get_file_ico($val).'" />';
            
          }
          
          echo sprintf( $format, $values['id'].'_preview_'.$i, $file_view, $values['id'].'_upload_'.$i, $values['id'].'['.$i.']', $val, $values['id'].'_'.$i,  $button_text, $values['desc']  );
        }
        echo '<a href="#" class="add_item button-secondary" data_name="ashuwp_framework_html_'.$values['id'].'">Add</a></div>';
      }else{
        
        echo sprintf( $format, $values['id'].'_preview', $file_view, $values['id'].'_upload', $values['id'], $values['std'], $values['id'],  $button_text, $values['desc']  );
      }
    $this->after_tags();
  }
  
  /*gallery*/
  public function gallery($values){
    if( empty($values['id']) )
      return;
    
    if( !empty($values['multiple']) && $values['multiple'] === true ){
      if( !empty($values['std']) && is_array($values['std']) ){
        foreach( $values['std'] as $key => $value ){
          if( !empty($value) && is_array($value) ){
            $value_tem = '';
            $value_tem = implode( ',', $value );
            $image_ids[$key] = $value_tem;
          }
        }
      }else{
        $image_ids = array();
      }
      
    }else{
      if( !empty($values['std']) && is_array($values['std']) ){
        $image_ids = implode( ',', $values['std'] );
      }else{
        $image_ids = '';
      }
    }

    $button_text = (empty($values['button_text'])) ? 'Upload' : $values['button_text'];
    
    if( !empty($values['multiple']) && $values['multiple'] === true ){
      $format = '<div class="multiple_item multiple_gallery_item clearfix">%s<div class="gallery_container"><div class="gallery_view clearfix">%s</div><input type="hidden" id="%s" name="%s" value="%s" class="ashuwp_gallery_input" /><a href="#" class="add_gallery button">%s</a></div><a href="#" class="delete_item">Delete</a></div>';
      
      $this->enqueue_html['ashuwp_framework_html_'.$values['id']] = sprintf( $format, $values['desc'], '', $values['id'].'_input_{{i}}', $values['id'].'[{{i}}]', '', $button_text );
      
    }
    
    $this->before_tags($values);
      if( !empty($values['multiple']) && $values['multiple'] === true ){
        
        if( empty( $values['std'] ) || !is_array( $values['std'] ) ){
          //$values['std'] = explode( ',', $values['std'] );
          $values['std'] = array();
        }
        $i=0;
        echo '<div class="multiple_wrap clearfix">';
        
        
        
        foreach($values['std'] as $key=>$value){
          $i++;
          $html_li = '';
          if(!is_array($value)){
            $value_array = explode( ',', $value );
          }else{
            $value_array = $value;
          }
            
          if( !empty($value_array) && is_array($value_array) ){
            $image_ids = '';
           
            $image_ids = implode( ',', $value_array);
            
            foreach($value_array as $attachment_id){
              $attachment = array();
              $attachment = wp_get_attachment_image_src($attachment_id, 'thumbnail');
              $file_type = substr($attachment[0], strrpos($attachment[0] , '.') + 1);
              
              if( in_array($file_type,array('png','jpg','gif','bmp','svg')) ){
                $ico_src = $attachment[0];
              }else{
                $ico_src = wp_mime_type_icon($attachment_id);
              }
    
              $html_li .= '<div class="image" data-attachment_id="' . $attachment_id . '"><img src="' . $ico_src . '" /><div class="actions"><a href="#" class="delete" title="Delete image">Delete</a></div></div>';
            }
          }
          
          echo sprintf( $format, $values['desc'], $html_li, $values['id'].'_input_{{i}}', $values['id'].'[{{i}}]', $image_ids, $button_text );
          
        }
        
        echo '<a href="#" class="add_item button-secondary" data_name="ashuwp_framework_html_'.$values['id'].'">Add</a></div>';
        
      }else{
        echo $values['desc'];
        
        echo '<div class="gallery_container"><div class="gallery_view">';
         
        if ( !empty($values['std']) && is_array($values['std']) ){
          foreach ( $values['std'] as $attachment_id ) {
            $attachment = array();
            $attachment = wp_get_attachment_image_src($attachment_id, 'thumbnail');
            $file_type = substr($attachment[0], strrpos($attachment[0] , '.') + 1);
              
            if( in_array($file_type,array('png','jpg','gif','bmp','svg')) ){
              $ico_src = $attachment[0];
            }else{
              $ico_src = wp_mime_type_icon($attachment_id);
            }
            echo '<div class="image" data-attachment_id="' . $attachment_id . '"><img src="' . $ico_src . '" /><div class="actions"><a href="#" class="delete" title="Delete image">Delete</a></div></div>';
          }
        }
        
        echo '</div>';
        
        echo '<input type="hidden" id="'.$values['id'].'_input" class="ashuwp_gallery_input" name="'.$values['id'].'" value="'.$image_ids.'" />';
         
        echo '<a href="#" class="add_gallery button">'.$button_text.'</a>';
         
        echo '</div>';
        
      }
      
    $this->after_tags();
  }
  
  /*tinymce*/
  public function tinymce($values){
    if( empty($values['id']) )
      return;
    
    if( empty($values['std']) )
      $values['std'] = '';
    
    $this->before_tags($values);
    
        if( !empty($values['desc']) ){
          echo '<p>'.$values['desc'].'</p>';
        }
        
        $settings = array('tinymce'=>1,'editor_height'=>300);
        
        if(isset($values['style']) && $values['style']!='')
          $settings['tinymce'] = array(
            'content_css' => $values['style']
          );
        
        if( isset($values['media']) && !$values['media'] )
          $settings['media_buttons'] = 0;
        else
          $settings['media_buttons'] = 1;
        
        if( !empty($values['textarea_name']) ){
          $settings['textarea_name'] = $values['textarea_name'];
        }
        
        wp_editor( $values['std'], $values['id'],$settings );
    
    $this->after_tags();
  }
  
  /**group**/
  public function group($values){
    if( empty($values['id']) )
      return;
    if( empty($values['std']) ){
      $values['std'] = array();
    }
    
    if( empty($values['subtype']) || !is_array($values['subtype']) ){
      $values['subtype'] = array();
    }
    
    if( empty($values['class']) ){
      $values['class'] = '';
    }
    $values['class'] .= ' ashuwp_field_group';
    
    $has_gallery = '';
    foreach($values['subtype'] as $sub_type){
      if( $sub_type['type'] == 'gallery' ){
        $has_gallery = 'multiple_item_has_gallery';
        break;
      }
    }
    
    if( !empty($values['multiple']) && $values['multiple'] === true ){
      
      $html_format = '<div class="multiple_item multiple_group_item '.$has_gallery.' clearfix">';
      
      $html_format .= '<div class="field_group clearfix">';
      
      $before_tags_format = '<div class="ashuwp_field %s"><label class="ashuwp_field_label" for="%s" >%s</label><div class="ashuwp_field_area">';
      $after_tags_format = '</div></div>';
      
      foreach( $values['subtype'] as $sub_type ){
        $format = '';
        
        $class = array();
        if( $sub_type['type'] == 'color' ){
          $class[] .= 'ashuwp_color_picker';
        }
        $class[] = 'ashuwp_'.$sub_type['type'].'_field';
        if( !empty($sub_type['class']) ){
          $class[] = $sub_type['class'];
        }
        $class_text = implode(' ', $class);
        
        $html_format .= sprintf($before_tags_format, $class_text, $values['id'].'[{{i}}]['.$sub_type['id'].']', $sub_type['name']);
        
        if( !empty($sub_type['desc']) ){
          $sub_type['desc'] = '<p>'.$sub_type['desc'].'</p>';
        }else{
          $sub_type['desc'] = '';
        }
        
        if( $sub_type['type'] == 'text' || $sub_type['type'] == 'numbers_array' || $sub_type['type'] == 'color' ){
          
          $format = '<input type="text" id="%s" name="%s" value="%s" class="ashuwp_field_input" />%s';
          $html_format .= sprintf( $format, $values['id'].'[{{i}}]['.$sub_type['id'].']', $values['id'].'[{{i}}]['.$sub_type['id'].']', '', $sub_type['desc'] );
          
        }elseif( $sub_type['type'] == 'radio' ){
          
          $entries = $this->select_entries($sub_type);
          $format_radio = '<label for="%s"><input type="radio" id="%s" name="%s" value="%s" class="ashuwp_field_radio" %s />%s</label>';
          
          foreach(  $entries as $id => $title ) {
            $checked = '';
            if( $sub_type['std'] == $id ) {
              $checked = 'checked = "checked"';
            }
            
            $html_format .= sprintf( $format_radio, $values['id'].'[{{i}}]['.$sub_type['id'].']_'.$id, $values['id'].'[{{i}}]['.$sub_type['id'].']_'.$id, $values['id'].'[{{i}}]['.$sub_type['id'].']', $id, $checked, $title );
          }
          
          $html_format .= $sub_type['desc'];
    
        }elseif( $sub_type['type'] == 'checkbox' ){
          
          $entries = $this->select_entries($sub_type);
          $format_checkbox = '<label for="%s"><input type="checkbox" id="%s" name="%s" value="%s" class="ashuwp_field_checkbox" %s />%s</label>';
          
          foreach(  $entries as $id => $title ) {
            $checked ="";
            
            $html_format .= sprintf( $format_checkbox, $values['id'].'[{{i}}]['.$sub_type['id'].']_'.$id, $values['id'].'[{{i}}]['.$sub_type['id'].']_'.$id, $values['id'].'[{{i}}]['.$sub_type['id'].'][]', $id, $checked, $title );
          }
          
          $html_format .= $sub_type['desc'];
          
        }elseif( $sub_type['type'] == 'select' ){
          
          $entries = $this->select_entries($sub_type);
          
          $format_select = '<option value="%s" >%s</option>';
          
          $html_format .= '<select id="'. $values['id'].'[{{i}}]['.$sub_type['id'].']' .'" name="'. $values['id'].'[{{i}}]['.$sub_type['id'].']' .'" class="ashuwp_field_select"><option value="">Select...</option>';
          
          foreach(  $entries as $id => $title ) {
            $html_format .= sprintf( $format_select, $id, $title );
          }
          
          $html_format .= '</select>';
          
          $html_format .= $sub_type['desc'];
          
        }elseif( $sub_type['type'] == 'textarea' ){
          
          $format_textarea = '%s<textarea id="%s" name="%s" class="ashuwp_field_textarea" >%s</textarea>';
          $html_format .= sprintf( $format_textarea, $sub_type['desc'], $values['id'].'[{{i}}]['.$sub_type['id'].']', $values['id'].'[{{i}}]['.$sub_type['id'].']', $sub_type['std'] );
           
        }elseif( $sub_type['type'] == 'upload' ){
          
          $button_text = (empty($sub_type['button_text'])) ? 'Upload' : $sub_type['button_text'];
          
          $format_upload = '<div id="%s_preview" class="ashuwp_file_preview"></div><div class="ashuwp_upload_input"><input type="text" id="%s" name="%s" value="%s" class="ashuwp_field_upload" /><a id="%s" class="ashu_upload_button button" href="#">%s</a></div>%s';
          
          $html_format .= sprintf( $format_upload, $values['id'].'[{{i}}]['.$sub_type['id'].']_preview', $values['id'].'[{{i}}]['.$sub_type['id'].']_upload', $values['id'].'[{{i}}]['.$sub_type['id'].']', '', $values['id'].'[{{i}}]['.$sub_type['id'].']',  $button_text, $sub_type['desc']  );
          
        }elseif( $sub_type['type'] == 'gallery' ){
          
          $button_text = (empty($sub_type['button_text'])) ? 'Upload' : $sub_type['button_text'];

      
          $html_format .= $sub_type['desc'];
        
          $html_format .=  '<div class="gallery_container"><div class="gallery_view"></div><div class="clear"></div>';
           
          $html_format .= '<input type="hidden" id="'. $values['id'].'[{{i}}]['.$sub_type['id'].']_input" class="ashuwp_gallery_input" name="'. $values['id'].'[{{i}}]['.$sub_type['id'].']" value="" />';
           
          $html_format .= '<a href="#" class="add_gallery button">'.$button_text.'</a>';
           
          $html_format .= '</div>';
          
          
        }
        
        $html_format .= $after_tags_format;
        
      }
      $html_format .= '</div>';
      
      $html_format .= $values['desc'].'<a href="#" class="delete_item button-secondary">删除</a></div>';
      
      $this->enqueue_html['ashuwp_framework_html_'.$values['id']] = $html_format;
    }
    
    $this->before_tags($values);
    
    if( !empty($values['multiple']) && $values['multiple'] === true ){
      
      $i=0;
      echo '<div class="multiple_wrap clearfix">';
      
      foreach( $values['std'] as $sub_std ){
        $i++;
        echo '<div class="multiple_item multiple_group_item '.$has_gallery.' clearfix">';
        
        echo '<div class="field_group clearfix">';
        foreach( $values['subtype'] as $sub_type ){
          $sub_values = array();
          if(!empty($sub_type['id']) && method_exists($this, $sub_type['type'])){
            $sub_values['id'] = $values['id'].'['.$i.']['.$sub_type['id'].']';
            $sub_values['type'] = $sub_type['type'];
            $sub_values['multiple'] = false;
            if(!empty( $sub_type['name'] )){
              $sub_values['name'] = $sub_type['name'];
            }else{
              $sub_values['name'] = '';
            }
            
            if(!empty( $sub_type['subtype'] )){
              $sub_values['subtype'] = $sub_type['subtype'];
            }else{
              $sub_values['subtype'] = '';
            }
            
            if(!empty( $sub_type['desc'] )){
              $sub_values['desc'] = $sub_type['desc'];
            }else{
              $sub_values['desc'] = '';
            }
              
            if(!empty( $sub_std[$sub_type['id']] )){
              if($sub_type['type']=='gallery'){
                $sub_values['std'] = explode( ',', $sub_std[$sub_type['id']] );
              }else{
                $sub_values['std'] = $sub_std[$sub_type['id']];
              }
              
            }else{
              $sub_values['std'] = '';
            }
            
            if(!empty( $sub_type['button_text'] )){
              $sub_values['button_text'] = $sub_type['button_text'];
            }else{
              $sub_values['button_text'] = '';
            }
            
            if($sub_type['type']!='group'){
                $this->{$sub_type['type']}($sub_values);
              }
            }
        }
        echo '</div>';
        
        echo '<a href="#" class="delete_item button-secondary">删除</a></div>';
      }
      
      echo '<a href="#" class="add_item button-secondary" data_name="ashuwp_framework_html_'.$values['id'].'">添加</a></div>';
      
    }else{
      if(is_array($values['subtype'])){
        echo '<div class="field_group clearfix">';
        
          foreach($values['subtype'] as $sub_type){
            $sub_values = array();
            if(!empty($sub_type['id']) && method_exists($this, $sub_type['type'])){
              if( $sub_type['type']=='tinymce'){
                $sub_values['id'] = $values['id'].'_'.$sub_type['id'];
                $sub_values['textarea_name'] = $values['id'].'['.$sub_type['id'].']';
              }else{
                $sub_values['id'] = $values['id'].'['.$sub_type['id'].']';
              }
              
              $sub_values['type'] = $sub_type['type'];
              $sub_values['multiple'] = false;
              if(!empty( $sub_type['name'] )){
                $sub_values['name'] = $sub_type['name'];
              }else{
                $sub_values['name'] = '';
              }
              
              if(!empty( $sub_type['desc'] )){
                $sub_values['desc'] = $sub_type['desc'];
              }else{
                $sub_values['desc'] = '';
              }
              
              if(!empty( $sub_type['subtype'] )){
                $sub_values['subtype'] = $sub_type['subtype'];
              }else{
                $sub_values['subtype'] = '';
              }
              
              if(!empty( $values['std'][$sub_type['id']] )){
                $sub_values['std'] = $values['std'][$sub_type['id']];
              }else{
                $sub_values['std'] = '';
              }
              $this->{$sub_type['type']}($sub_values);
              
            }
            
          }
        echo '</div>';
      }
    }
    
    $this->after_tags();
    
  }
}

require __DIR__ .'/ashuwp_options_feild.php';
require __DIR__ .'/ashuwp_postmeta_feild.php';
require __DIR__ .'/ashuwp_termmeta_feild.php';
require __DIR__ .'/ashuwp_quick_edit.php';
//require __DIR__ .'/import_export.php';