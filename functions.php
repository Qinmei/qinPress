<?php
$general_options = get_option('ashuwp_general');
header("Content-Type:text/html;charset=utf8"); 
header('Access-Control-Allow-Methods:POST');// 响应类型  
header('Access-Control-Allow-Headers:*'); // 响应头设置 

  $allow=array(
      $general_options["qinmei_allow_site_web"],
      $general_options["qinmei_allow_site_mobile"],
      'https://nginx.qinvz.cn',
      'https://qinvz.cn',
  );
  
  $origin = isset($_SERVER['HTTP_ORIGIN'])? $_SERVER['HTTP_ORIGIN'] : '';
  if (in_array($origin, $allow)) {
    header("Access-Control-Allow-Origin:".$origin);
    require get_template_directory() . '/qinmei/animate.php';
    require get_template_directory() . '/qinmei/longpost.php';
    require get_template_directory() . '/qinmei/comment.php';
    require get_template_directory() . '/qinmei/user.php';
    require get_template_directory() . '/qinmei/setting.php';
    require get_template_directory() . '/qinmei/others.php';
  }

require get_template_directory() . '/qinmei/function.php';
add_theme_support( 'post-thumbnails' );

add_action( 'admin_action_qinmei_update', 'qinmei_update' );
add_action( 'admin_action_qinmei_create_animate', 'qinmei_create_animate' );

add_filter('comment_form_default_fields', 'mytheme_remove_url');

function mytheme_remove_url($fields) {
    $fields =  array(
    'author' => '<p class="comment-form-author">' . '<label for="author">' . __( '昵称' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',

    );
    return $fields;
}



function  new_excerpt_length($length) {

  return  100;

}

add_filter("excerpt_length", "new_excerpt_length");

function wpdocs_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );




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
    if ( ! current_user_can( 'delete_pages' )  && $_SERVER['PHP_SELF'] != '/wp-admin/admin-ajax.php' ) {
        wp_redirect( $general_options["qinmei_allow_site_web"] );
    }
}
add_action( 'admin_init', 'wizhi_restrict_admin', 1 );

add_action('login_enqueue_scripts','login_protection');

function login_protection(){
  wp_redirect(site_url());
}



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


function my_taxonomies_website() {
  $labels = array(
    'name'              => _x( '网站', 'taxonomy 名称' ),
    'singular_name'     => _x( '网站', 'taxonomy 单数名称' ),
    'search_items'      => __( '搜索网站' ),
    'all_items'         => __( '所有网站' ),
    'edit_item'         => __( '编辑网站' ),
    'update_item'       => __( '更新网站' ),
    'add_new_item'      => __( '添加新的网站' ),
    'new_item_name'     => __( '新网站' ),
    'menu_name'         => __( '网站' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
    'show_in_rest' => true
  );
  register_taxonomy( 'animateweb', 'animate', $args );
}
add_action( 'init', 'my_taxonomies_website', 0 );




function be_custom_post_columns($defaults) {
    $defaults['animatecat'] = '分类';
    $defaults['animatetag'] = '标签';
    $defaults['animateyear'] = '年份';
    $defaults['animatearea'] = '地区';
    $defaults['animatekind'] = '类型';
    $defaults['animateweb'] = '网站';
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
  $taxonomies = array( 'animatecat', 'animatetag', 'animateyear','animatearea', 'animatekind', 'animateweb' );
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
    $columns['animateweb'] = '网站';
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
  $taxonomies = array( 'animatecat', 'animatetag', 'animateyear','animatearea','animatekind','animateweb' );
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


add_action('restrict_manage_posts','restrict_listings_by_animateweb');
function restrict_listings_by_animateweb() {
    global $typenow;
    global $wp_query;
    if ($typenow=='animate') {
    $taxonomy = 'animateweb';
    $term = isset($wp_query->query['animateweb']) ? $wp_query->query['animateweb'] :'';
    $animateweb_taxonomy = get_taxonomy($taxonomy);
        wp_dropdown_categories(array(
            'show_option_all' =>  __("所有站点"),
            'taxonomy'        =>  $taxonomy,
            'name'            =>  'animateweb',
            'orderby'         =>  'name',
            'selected'        =>  $term,
            'hierarchical'    =>  true,
            'depth'           =>  3,
            'show_count'      =>  true, // Show # listings in parens
            'hide_empty'      =>  true, // Don't show animatewebes w/o listings
        ));
    }
}
add_filter('parse_query','convert_animateweb_id_to_taxonomy_term_in_query');
function convert_animateweb_id_to_taxonomy_term_in_query($query) {
    global $pagenow;
    $qv =& $query->query_vars;
    if ($pagenow=='edit.php' && isset($qv['animateweb']) && is_numeric($qv['animateweb'])) {
        $term = get_term_by('id',$qv['animateweb'],'animateweb');
        $qv['animateweb'] = ($term ? $term->slug : '');
    }
}



show_admin_bar(false);



