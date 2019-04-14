<?php


add_theme_support( 'post-thumbnails' );


add_filter('comment_form_default_fields', 'mytheme_remove_url');

function mytheme_remove_url($fields) {
    $fields =  array(
    'author' => '<p class="comment-form-author">' . '<label for="author">' . __( '昵称' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',

    );
    return $fields;
}

function dw_pagination() {
    global $wp_query;
    $big = 999999999;
     $paginate_links = paginate_links( array(
        'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'mid_size' => 1
    ) );
     if ( $paginate_links ) {
        echo '<div class="pagination">';
        echo $paginate_links;
        echo '</div><!--// end .pagination -->';
    }
}


function
new_excerpt_length($length) {

return
100;

}

add_filter("excerpt_length", "new_excerpt_length");

function wpdocs_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );




function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        add_post_meta($postID, $count_key, '1');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        return 1;
    }
    return $count;
}

add_filter('manage_posts_columns', 'posts_column_words_count_views', 10, 2);
add_action('manage_posts_custom_column', 'posts_words_count_views',10,2);

function posts_column_words_count_views($defaults){
    $defaults['words_count'] = __('浏览数', 'wizhi');
    return $defaults;
}
function posts_words_count_views($column_name, $id){
    if($column_name === 'words_count'){
        echo get_post_meta(get_the_ID(), 'post_views_count', true);
    }
}



add_action('user_register', 'log_ip');
function log_ip($user_id){
  $ip = $_SERVER['REMOTE_ADDR'];
  update_user_meta($user_id, 'signup_ip', $ip);
}
// 创建新字段存储用户登录时间和登录IP
add_action( 'wp_login', 'insert_last_login' );
function insert_last_login( $login ) {
  global $user_id;
  $user = get_userdatabylogin( $login );
  update_user_meta( $user->ID, 'last_login', current_time( 'mysql' ) );
  $last_login_ip = $_SERVER['REMOTE_ADDR'];
  update_user_meta( $user->ID, 'last_login_ip', $last_login_ip);
}
// 添加额外的栏目
add_filter('manage_users_columns', 'add_user_additional_column');
function add_user_additional_column($columns) {
  $columns['user_nickname'] = '昵称';
  $columns['user_url'] = '网站';
  $columns['reg_time'] = '注册时间';
  $columns['last_login'] = '上次登录';
  // 打算将注册IP和注册时间、登录IP和登录时间合并显示，所以我注销下面两行
  /*$columns['signup_ip'] = '注册IP';
  $columns['last_login_ip'] = '登录IP';*/
  unset($columns['name']);//移除“姓名”这一栏，如果你需要保留，删除这行即可
  return $columns;
}
//显示栏目的内容
add_action('manage_users_custom_column',  'show_user_additional_column_content', 10, 3);
function show_user_additional_column_content($value, $column_name, $user_id) {
  $user = get_userdata( $user_id );
  // 输出“昵称”
  if ( 'user_nickname' == $column_name )
    return $user->nickname;
  // 输出用户的网站
  if ( 'user_url' == $column_name )
    return '<a href="'.$user->user_url.'" target="_blank">'.$user->user_url.'</a>';
  // 输出注册时间和注册IP
  if('reg_time' == $column_name ){
    return get_date_from_gmt($user->user_registered) .'<br />'.get_user_meta( $user->ID, 'signup_ip', true);
  }
  // 输出最近登录时间和登录IP
  if ( 'last_login' == $column_name && $user->last_login ){
    return get_user_meta( $user->ID, 'last_login', ture ).'<br />'.get_user_meta( $user->ID, 'last_login_ip', ture );
  }
  return $value;
}
// 默认按照注册时间排序
add_filter( "manage_users_sortable_columns", 'cmhello_users_sortable_columns' );
function cmhello_users_sortable_columns($sortable_columns){
  $sortable_columns['reg_time'] = 'reg_time';
  return $sortable_columns;
}
add_action( 'pre_user_query', 'cmhello_users_search_order' );
function cmhello_users_search_order($obj){
  if(!isset($_REQUEST['orderby']) || $_REQUEST['orderby']=='reg_time' ){
    if( !in_array($_REQUEST['order'],array('asc','desc')) ){
      $_REQUEST['order'] = 'desc';
    }
    $obj->query_orderby = "ORDER BY user_registered ".$_REQUEST['order']."";
  }
}



function wizhi_restrict_admin() {
    if ( ! current_user_can( 'publish_pages' )  && $_SERVER['PHP_SELF'] != '/wp-admin/admin-ajax.php' ) { //判断是否为管理员
        wp_redirect( '/user' ); //跳转到/uc/界面
    }
}
add_action( 'admin_init', 'wizhi_restrict_admin', 1 );


/*-----------------------------------------------------------------------------------*/
# 实现评论的点赞功能
/*-----------------------------------------------------------------------------------*/
//lulinux_note：这里的wp_ajax_nopriv_pinglun_zan和wp_ajax_pinglun_zan的后缀都要跟pinglun_zan保持一致，不要写成wp_ajax_nopriv_specs_zan和wp_ajax_nopriv_specs_zan或者其他的
add_action('wp_ajax_nopriv_pinglun_zan', 'pinglun_zan');
add_action('wp_ajax_pinglun_zan', 'pinglun_zan');
function pinglun_zan(){//从提交的表单里获取id值
$id = $_POST["um_id"];
//从提交的表单里获取action值
$action = $_POST["um_action"];
//如果action为ding
if ($action == 'ding'){//从数据库中获取specs_raters数值
$specs_raters = get_comment_meta($id, 'pinglun_zan', true);
//设置cookie的过期时间，单位是秒，99999999秒相当于3年
$expire = time() + 99999999;
// make cookies work with localhost
$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
//lulinux_note这里的pinglun_zan后面一定不要掉了下划线！
setcookie('pinglun_zan_' . $id, $id, $expire, '/', $domain, false);
//如果$specs_raters不存在或者不是数字，那么设置pinglun_zan为1，否则加１
if (!$specs_raters || !is_numeric($specs_raters)){            update_comment_meta($id, 'pinglun_zan', 1);
}else {            update_comment_meta($id, 'pinglun_zan', ($specs_raters + 1));
}//返回pinglun_zan的值
echo get_comment_meta($id, 'pinglun_zan', true);
}die;
}


function add_comment_meta_values($comment_id) {

    if(isset($_POST['commentimg'])) {
        $position = wp_filter_nohtml_kses($_POST['commentimg']);
        add_comment_meta($comment_id, 'commentimg', $position, false);
    }

}
add_action ('comment_post', 'add_comment_meta_values', 1);

function add_comment_meta_values_video($comment_id) {

    if(isset($_POST['commentvideo'])) {
        $position = wp_filter_nohtml_kses($_POST['commentvideo']);
        add_comment_meta($comment_id, 'commentvideo', $position, false);
    }

}
add_action ('comment_post', 'add_comment_meta_values_video', 1);



require get_template_directory() . '/ashuwp_framework/ashuwp_framework_core.php'; //加载ashuwp_framework框架
require get_template_directory() . '/ashuwp_framework/config-example.php'; //加载配置数据，config-example.php为配置范例。



function my_custom_post_movie() {
  $labels = array(
    'name'               => _x( '动漫', 'post type 名称' ),
    'singular_name'      => _x( '动漫', 'post type 单个 item 时的名称，因为英文有复数' ),
    'add_new'            => _x( '新建动漫', '添加新内容的链接名称' ),
    'add_new_item'       => __( '新建一个动漫' ),
    'edit_item'          => __( '编辑动漫' ),
    'new_item'           => __( '新的动漫' ),
    'all_items'          => __( '所有动漫' ),
    'view_item'          => __( '查看动漫' ),
    'search_items'       => __( '搜索动漫' ),
    'not_found'          => __( '没有找到有关动漫' ),
    'not_found_in_trash' => __( '回收站里面没有相关动漫' ),
    'parent_item_colon'  => '',
    'menu_name'          => '动漫'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => '我们网站的动漫信息',
    'public'        => true,
    'menu_position' => 5,
    'menu_icon'     => 'dashicons-video-alt',
    'show_in_rest' => true,
    'rest_controller_class' => 'WP_REST_Posts_Controller',
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments'),
    'has_archive'   => true
  );
  register_post_type( 'animate', $args );
}
add_action( 'init', 'my_custom_post_movie' );


function filter_animate_json( $data, $post, $context ) {
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
  $data->data['baseinfo_simg_link'] = esc_html(get_the_post_thumbnail_url($post->ID));
  $data->data['baseinfo_dplayer_id'] = esc_html( get_post_meta( $post->ID, 'baseinfo_dplayer_id', true ) );
   $data->data['baseinfo_episode_con'] =  get_post_meta( $post->ID, 'baseinfo_episode_con', true );

  return $data;
}
add_filter( 'rest_prepare_animate', 'filter_animate_json', 10, 3 );


function dw_rest_prepare_post( $data, $post, $request ) {

 	$data->data['img'] = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full')[0];
	return $data;

}

add_filter( 'rest_prepare_post', 'dw_rest_prepare_post', 10, 3 );


function my_taxonomies_movie() {
  $labels = array(
    'name'              => _x( '分类', 'taxonomy 名称' ),
    'singular_name'     => _x( '分类', 'taxonomy 单数名称' ),
    'search_items'      => __( '搜索分类' ),
    'all_items'         => __( '所有分类' ),
    'parent_item'       => __( '该分类的上级分类' ),
    'parent_item_colon' => __( '该分类的上级分类：' ),
    'edit_item'         => __( '编辑分类' ),
    'update_item'       => __( '更新分类' ),
    'add_new_item'      => __( '添加新的分类' ),
    'new_item_name'     => __( '新分类' ),
    'menu_name'         => __( '分类' )

  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
    'show_in_rest' => true
  );
  register_taxonomy( 'animatecat', 'animate', $args );
}
add_action( 'init', 'my_taxonomies_movie', 0 );

function my_taxonomies_year() {
  $labels = array(
    'name'              => _x( '年份', 'taxonomy 名称' ),
    'singular_name'     => _x( '年份', 'taxonomy 单数名称' ),
    'search_items'      => __( '搜索年份' ),
    'all_items'         => __( '所有年份' ),
    'parent_item'       => __( '该年份的上级分类' ),
    'parent_item_colon' => __( '该年份的上级分类：' ),
    'edit_item'         => __( '编辑年份' ),
    'update_item'       => __( '更新年份' ),
    'add_new_item'      => __( '添加新的年份' ),
    'new_item_name'     => __( '新年份' ),
    'menu_name'         => __( '年份' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
    'show_in_rest' => true
  );
  register_taxonomy( 'animateyear', 'animate', $args );
}
add_action( 'init', 'my_taxonomies_year', 0 );

function my_taxonomies_area() {
  $labels = array(
    'name'              => _x( '地区', 'taxonomy 名称' ),
    'singular_name'     => _x( '地区', 'taxonomy 单数名称' ),
    'search_items'      => __( '搜索地区' ),
    'all_items'         => __( '所有地区' ),
    'parent_item'       => __( '该地区的上级分类' ),
    'parent_item_colon' => __( '该地区的上级分类：' ),
    'edit_item'         => __( '编辑地区' ),
    'update_item'       => __( '更新地区' ),
    'add_new_item'      => __( '添加新的地区' ),
    'new_item_name'     => __( '新地区' ),
    'menu_name'         => __( '地区' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
    'show_in_rest' => true
  );
  register_taxonomy( 'animatearea', 'animate', $args );
}
add_action( 'init', 'my_taxonomies_area', 0 );


function my_taxonomies_kind() {
  $labels = array(
    'name'              => _x( '类型', 'taxonomy 名称' ),
    'singular_name'     => _x( '类型', 'taxonomy 单数名称' ),
    'search_items'      => __( '搜索类型' ),
    'all_items'         => __( '所有类型' ),
    'edit_item'         => __( '编辑类型' ),
    'update_item'       => __( '更新类型' ),
    'add_new_item'      => __( '添加新的类型' ),
    'new_item_name'     => __( '新类型' ),
    'menu_name'         => __( '类型' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
    'show_in_rest' => true
  );
  register_taxonomy( 'animatekind', 'animate', $args );
}
add_action( 'init', 'my_taxonomies_kind', 0 );

function my_taxonomies_freetag() {
  $labels = array(
    'name'              => _x( '标签', 'taxonomy 名称' ),
    'singular_name'     => _x( '标签', 'taxonomy 单数名称' ),
    'search_items'      => __( '搜索标签' ),
    'all_items'         => __( '所有标签' ),
    'edit_item'         => __( '编辑标签' ),
    'update_item'       => __( '更新标签' ),
    'add_new_item'      => __( '添加新的标签' ),
    'new_item_name'     => __( '新标签' ),
    'menu_name'         => __( '标签' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => false,
    'show_in_rest' => true
  );
  register_taxonomy( 'animatetag', 'animate', $args );
}
add_action( 'init', 'my_taxonomies_freetag', 0 );




function be_custom_post_columns($defaults) {
    $defaults['animatecat'] = '分类';
    $defaults['animatetag'] = '标签';
    $defaults['animateyear'] = '年份';
    $defaults['animatearea'] = '地区';
    $defaults['animatekind'] = '类型';
    unset( $defaults['tags'] );
    return $defaults;
}
add_filter( 'manage_edit-animate_columns', 'be_custom_post_columns' );
/**
 * Custom Post Columns Data
 *
 * @param string $column_name
 * @param int $post_id
 * @return null
 */
function be_custom_post_columns_data( $column_name, $post_id ) {
  $taxonomies = array( 'animatecat', 'animatetag', 'animateyear','animatearea','animatekind' );
  $post_type = 'animate';
  foreach( $taxonomies as $taxonomy ) {
    if( $column_name == $taxonomy ) {
      $terms = get_the_terms( $post_id, $taxonomy );
      if ( !empty( $terms ) ) {
        $output = array();
        foreach ( $terms as $term )
          $output[] = '<a href="' . admin_url( 'edit.php?' . $taxonomy . '='.  $term->slug . '&post_type=' . $post_type ) . '">' . $term->name . '</a>';
        echo join( ', ', $output );
      }
      else {
        _e('Uncategorized');
      }

    }
  }
}
add_action( 'manage_posts_custom_column', 'be_custom_post_columns_data', 10, 2 );
/**
 * Make Custom Columns Sortable
 *
 * @param array $columns
 * @return array
 */
function be_custom_post_columns_sortable( $columns ) {
    $columns['animatecat'] = '分类';
    $columns['animatetag'] = '标签';
    $columns['animateyear'] = '年份';
    $columns['animatearea'] = '地区';
    $columns['animatekind'] = '类型';

  return $columns;
}
add_filter( 'manage_edit-animate_sortable_columns', 'be_custom_post_columns_sortable' );
/**
 * Custom Post Columns Orderby
 *
 * @param array $args
 * @return array
 */
function be_custom_post_columns_orderby( $args ) {
  $taxonomies = array( 'animatecat', 'animatetag', 'animateyear','animatearea','animatekind' );
  if ( isset( $args['orderby'] ) && in_array( $args['orderby'], $taxonomies ) ) {
    $taxonomy = $args['orderby'];
    $tax_terms = get_terms( $taxonomy, array( 'fields' => 'ids' ) );
    $args = array_merge( $args, array(
      'orderby' => 'title',
      'order' => 'ASC',
      'tax_query' => array(
        array(
          'taxonomy' => $taxonomy,
          'field' => 'id',
          'terms' => $tax_terms,
        )
      )
    ) );
  }

  return $args;
}
add_filter( 'request', 'be_custom_post_columns_orderby' );


add_action('restrict_manage_posts','restrict_listings_by_animatecat');
function restrict_listings_by_animatecat() {
    global $typenow;
    global $wp_query;
    if ($typenow=='animate') {
    $taxonomy = 'animatecat';
    $term = isset($wp_query->query['animatecat']) ? $wp_query->query['animatecat'] :'';
    $animatecat_taxonomy = get_taxonomy($taxonomy);
        wp_dropdown_categories(array(
            'show_option_all' =>  __("所有分类"),
            'taxonomy'        =>  $taxonomy,
            'name'            =>  'animatecat',
            'orderby'         =>  'name',
            'selected'        =>  $term,
            'hierarchical'    =>  true,
            'depth'           =>  3,
            'show_count'      =>  true, // Show # listings in parens
            'hide_empty'      =>  true, // Don't show animatecates w/o listings
        ));
    }
}
add_filter('parse_query','convert_animatecat_id_to_taxonomy_term_in_query');
function convert_animatecat_id_to_taxonomy_term_in_query($query) {
    global $pagenow;
    $qv =& $query->query_vars;
    if ($pagenow=='edit.php' && isset($qv['animatecat']) && is_numeric($qv['animatecat'])) {
        $term = get_term_by('id',$qv['animatecat'],'animatecat');
        $qv['animatecat'] = ($term ? $term->slug : '');
    }
}

add_action('restrict_manage_posts','restrict_listings_by_animatetag');
function restrict_listings_by_animatetag() {
    global $typenow;
    global $wp_query;
    if ($typenow=='animate') {
    $taxonomy = 'animatetag';
    $term = isset($wp_query->query['animatetag']) ? $wp_query->query['animatetag'] :'';
    $animatetag_taxonomy = get_taxonomy($taxonomy);
        wp_dropdown_categories(array(
            'show_option_all' =>  __("所有标签"),
            'taxonomy'        =>  $taxonomy,
            'name'            =>  'animatetag',
            'orderby'         =>  'name',
            'selected'        =>  $term,
            'hierarchical'    =>  true,
            'depth'           =>  3,
            'show_count'      =>  true, // Show # listings in parens
            'hide_empty'      =>  true, // Don't show animatetages w/o listings
        ));
    }
}
add_filter('parse_query','convert_animatetag_id_to_taxonomy_term_in_query');
function convert_animatetag_id_to_taxonomy_term_in_query($query) {
    global $pagenow;
    $qv =& $query->query_vars;
    if ($pagenow=='edit.php' && isset($qv['animatetag']) && is_numeric($qv['animatetag'])) {
        $term = get_term_by('id',$qv['animatetag'],'animatetag');
        $qv['animatetag'] = ($term ? $term->slug : '');
    }
}

add_action('restrict_manage_posts','restrict_listings_by_animateyear');
function restrict_listings_by_animateyear() {
    global $typenow;
    global $wp_query;
    if ($typenow=='animate') {
    $taxonomy = 'animateyear';
    $term = isset($wp_query->query['animateyear']) ? $wp_query->query['animateyear'] :'';
    $animateyear_taxonomy = get_taxonomy($taxonomy);
        wp_dropdown_categories(array(
            'show_option_all' =>  __("所有年份"),
            'taxonomy'        =>  $taxonomy,
            'name'            =>  'animateyear',
            'orderby'         =>  'name',
            'selected'        =>  $term,
            'hierarchical'    =>  true,
            'depth'           =>  3,
            'show_count'      =>  true, // Show # listings in parens
            'hide_empty'      =>  true, // Don't show animateyeares w/o listings
        ));
    }
}
add_filter('parse_query','convert_animateyear_id_to_taxonomy_term_in_query');
function convert_animateyear_id_to_taxonomy_term_in_query($query) {
    global $pagenow;
    $qv =& $query->query_vars;
    if ($pagenow=='edit.php' && isset($qv['animateyear']) && is_numeric($qv['animateyear'])) {
        $term = get_term_by('id',$qv['animateyear'],'animateyear');
        $qv['animateyear'] = ($term ? $term->slug : '');
    }
}

add_action('restrict_manage_posts','restrict_listings_by_animatearea');
function restrict_listings_by_animatearea() {
    global $typenow;
    global $wp_query;
    if ($typenow=='animate') {
    $taxonomy = 'animatearea';
    $term = isset($wp_query->query['animatearea']) ? $wp_query->query['animatearea'] :'';
    $animatearea_taxonomy = get_taxonomy($taxonomy);
        wp_dropdown_categories(array(
            'show_option_all' =>  __("所有地区"),
            'taxonomy'        =>  $taxonomy,
            'name'            =>  'animatearea',
            'orderby'         =>  'name',
            'selected'        =>  $term,
            'hierarchical'    =>  true,
            'depth'           =>  3,
            'show_count'      =>  true, // Show # listings in parens
            'hide_empty'      =>  true, // Don't show animateareaes w/o listings
        ));
    }
}
add_filter('parse_query','convert_animatearea_id_to_taxonomy_term_in_query');
function convert_animatearea_id_to_taxonomy_term_in_query($query) {
    global $pagenow;
    $qv =& $query->query_vars;
    if ($pagenow=='edit.php' && isset($qv['animatearea']) && is_numeric($qv['animatearea'])) {
        $term = get_term_by('id',$qv['animatearea'],'animatearea');
        $qv['animatearea'] = ($term ? $term->slug : '');
    }
}

add_action('restrict_manage_posts','restrict_listings_by_animatekind');
function restrict_listings_by_animatekind() {
    global $typenow;
    global $wp_query;
    if ($typenow=='animate') {
    $taxonomy = 'animatekind';
    $term = isset($wp_query->query['animatekind']) ? $wp_query->query['animatekind'] :'';
    $animatekind_taxonomy = get_taxonomy($taxonomy);
        wp_dropdown_categories(array(
            'show_option_all' =>  __("所有类型"),
            'taxonomy'        =>  $taxonomy,
            'name'            =>  'animatekind',
            'orderby'         =>  'name',
            'selected'        =>  $term,
            'hierarchical'    =>  true,
            'depth'           =>  3,
            'show_count'      =>  true, // Show # listings in parens
            'hide_empty'      =>  true, // Don't show animatekindes w/o listings
        ));
    }
}
add_filter('parse_query','convert_animatekind_id_to_taxonomy_term_in_query');
function convert_animatekind_id_to_taxonomy_term_in_query($query) {
    global $pagenow;
    $qv =& $query->query_vars;
    if ($pagenow=='edit.php' && isset($qv['animatekind']) && is_numeric($qv['animatekind'])) {
        $term = get_term_by('id',$qv['animatekind'],'animatekind');
        $qv['animatekind'] = ($term ? $term->slug : '');
    }
}


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



show_admin_bar(false);


function qinmei_init(){

  $pagecreate = array(
      array('name'=>'all','title' =>'所有番剧'),
      array('name'=>'arrival','title' =>'最新上架'),
      array('name'=>'discuss','title' =>'动态讨论'),
      array('name'=>'history','title' =>'历史纪录'),
      array('name'=>'info','title' =>'关于我们'),
      array('name'=>'new','title' =>'新番'),
      array('name'=>'rate','title' =>'评分排行'),
      array('name'=>'recommend','title' =>'推荐番剧'),
      array('name'=>'topic','title' =>'分类页面'),
      array('name'=>'user','title' =>'用户面板'),
      array('name'=>'error','title' =>'视频报错'),
      array('name'=>'error2','title' =>'上架请求'),
      array('name'=>'play','title' =>'播放页面')
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


