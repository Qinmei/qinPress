<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php if ( is_home() ) {
    bloginfo('name'); echo " - "; bloginfo('description');
  } elseif ( is_category() ) {
    single_cat_title(); echo " - "; bloginfo('name');
  } elseif (is_single() ) {
      single_post_title();echo " - "; bloginfo('name');
  } elseif (is_search() ) {
    echo "搜索结果"; echo " - "; bloginfo('name');
  } elseif (is_404() ) {
    echo '页面未找到!';
    } elseif (is_page() ) {
      single_post_title();echo " - "; bloginfo('name');
  } else {
    wp_title('',true);
  } ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/bootstrap.css">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/font/fontawesome/css/font-awesome.min.css" rel="stylesheet">
  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-1.12.0.min.js"></script>
  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/main001.js"></script>
  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "<?php 
  $general_options = get_option('ashuwp_general');
  echo $general_options['tab9_tongji_link'];?>";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
<style>
.main-section{
  margin-top:40px;
  }
.mobile-fixed{
  background-color: white;
    width:100%;
    position:fixed;
    top:0;
    left:0;
    z-index:30;
}
.mobile-nav-bar{
  height:40px;
  padding:0 10px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  box-shadow: 0 0 5px rgba(0,0,0,0.3)
}
.nav-bar-user,.nav-bar-search{
  color: black;
  width:40px;
  height:40px;
  line-height:40px;
  text-align:center;
}
.nav-bar-user i,.nav-bar-search i{
  font-size:1.4em;
}
.nav-bar-logo{
  height:40px;
  width: calc(100% - 90px);
  line-height: 40px;
  position: relative;
}
.nav-bar-logo i{
  font-size: 0.8em;
  color: rgba(0,0,0,0.7);
}
.nav-bar-user a{
  width: 40px;
  height: 40px;
  display: flex;
  justify-content: center;
  align-items: center;
}
.nav-bar-user img{
   vertical-align: unset;
   border-radius: 50%;
   overflow: hidden;
 }
  .container{
  width:100%;
  }

  .mobile-nav {
    height: 40px;
    width:100%;
}
.mobile-nav-list{
  float: left;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100%;
  min-width: 20vw;

}
.mobile-nav-list-main{
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  padding: 0 8px;
  height: 100%;
  color: black;
  box-sizing: border-box;
  border-top: 2px solid transparent;
  border-bottom: 2px solid transparent;
  position:relative;
}
.mobile-nav-list-main.active{
  border-bottom: 2px solid black;
}
.main-pic-container{
  margin-top: 10px;
}
#searchform{
  display: none;
}
  .index-search{
    display:none;
    position:fixed;
    z-index:50;
    width:100vw;
    height:100vh;
    top:40px;
    left:0;
    background-color:white;
  }
  .index-search-bg{
    
    width:100%;
    height:100%;
  }
  .index-search-bar{
    background-color:#4285f4;
    position:relative;
    height: 40px;
  }
  .index-search-bar-do{
    position:absolute;
    font-size:1.5em;
    width:1.6em;
    height:1.6em;
    line-height:1.7em;
    text-align:center;
    color:white;
  }
  .index-search-tips-hot{
    margin:10px;
    color:black;
  }
  .index-search-tips-hot p{
    font-size: 1.1em;
  }
  .index-search-tips-hot a{
    margin:6px 6px 0 0;
    padding:5px 15px 5px 15px;
    border-radius:3px;
    color:black;
    display:inline-block;
    float:left;
    background-color: #f5f5f5;
  }
  .index-search-tips-hot .bg{
    font-size: 0.9em;
  }
  .index-search-tips-history{
    margin-top:10px;
    padding-top: 10px;
    overflow-y: scroll;
    overflow-x: hidden;
    border-top:1px solid #e7ebee;
  }
  .index-search-tips-history a{
  color:black;}1}
  .index-search-tips-history .clearBoth{
    text-align:center;
    font-weight:bold;
    color:grey;
    padding:0;
  }
  ::-webkit-input-placeholder { /* WebKit browsers */
    color:    white;
}
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
    color:    white;
}
::-moz-placeholder { /* Mozilla Firefox 19+ */
    color:    white;
}
:-ms-input-placeholder { /* Internet Explorer 10+ */
    color:    white;
}
 #commentload,#commenterror{
    display: none;
    position: fixed;
    bottom: 55px;
    left: 50%;
    max-width: 100vw;
    overflow: hidden;
    word-wrap: break-word;
    height: 2.6em;
    line-height: 2.7em;
    transform: translateX(-50%);
    padding: 0px 1.5em;
    background-color: #029588;
    border-radius: 100px;
    color: white;

  }
  .search-kuang{
    border:solid 1px rgba(0,0,0,0.1);
    height: 34px;
    margin-top: 3px;
    padding:0 10px;
    color: black;
    width: 0;
    float:right;
  }
</style>
</head>
<body>
  <div class="container">
    <div class="row">
            <div class="mobile-fixed">
              <div class="mobile-nav-bar">
                <div class="nav-bar-logo">
                  <a href="/" 
                  style="color:
                  <?php 
                  $general_options = get_option('ashuwp_general');
                  if(!empty( $general_options['qinmei_base_color'])){
                    echo  $general_options['qinmei_base_color'];
                  }else{echo  'rgba(0,0,0,0.8)'; };?>
                  ;font-size:2em;" class="icon-qinmei"><?php echo $general_options['web-title'];?></a>
                  <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
                    <input class="search-kuang" type="text" placeholder="搜索" name="s" autocomplete="off" required="required">
                  </form>
                </div>
                <div class="nav-bar-search"><i class="fa fa-search" aria-hidden="true"></i></div>
                <div class="nav-bar-user">
                  <?php if(is_user_logged_in()): ?>
                    <a href="/user"><?php global $current_user;get_currentuserinfo();echo get_avatar( $current_user->user_email, 26); ?></a>
                  <?php else: ?>
                    <i class="fa fa-user-circle"  onClick="location.href='/login'"></i>
                  <?php endif; ?>
                </div>
              </div>
            </div >
            <div class="col-md-12 main-section">
              <div class="row">