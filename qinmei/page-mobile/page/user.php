
<?php get_header(); ?>

<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
<div class="mobile-nav" style="border-bottom: solid 1px rgba(0,0,0,0.05);background-color:white;">
                      <a href="<?php bloginfo('url'); ?>/"><div class="mobile-nav-list">
                        <div class="mobile-nav-list-main active">首页</div>
                      </div></a>
                      <a href="<?php bloginfo('url'); ?>/new"><div class="mobile-nav-list">
                        <div class="mobile-nav-list-main">新番</div>
                      </div></a>
                      <a href="<?php bloginfo('url'); ?>/topic"><div class="mobile-nav-list">
                        <div class="mobile-nav-list-main">分类</div>
                      </div></a>
                    <a href="<?php bloginfo('url'); ?>/discuss"><div class="mobile-nav-list">
                        <div class="mobile-nav-list-main">动态</div>
                      </div></a>
                    
                      <a href="<?php bloginfo('url'); ?>/user"><div class="mobile-nav-list">
                        <div class="mobile-nav-list-main ">用户</div>
                      </div></a>
                </div>

<div class="wp-user-container">
<div class="wp-user-info">
  <div class="user-info-show">
    <?php if(is_user_logged_in()): ?>
  <div class="user-info-logo">
      <?php global $current_user;get_currentuserinfo();echo get_avatar( $current_user->user_email, 60); ?>
  </div>
  <div class="user-info-name">
    <span><?php global $current_user;get_currentuserinfo();echo  $current_user->display_name;?></span>
    <p>ID : <strong><?php global $current_user;get_currentuserinfo();echo  $current_user->ID;?></strong></p>
      <?php if( current_user_can( 'read' ) && !current_user_can( 'edit_posts' ) ) {
      echo "<p>等级 : <strong>Level 0</strong></p>";
    }else if( current_user_can( 'edit_posts' ) && !current_user_can( 'publish_pages' ) ) {
        echo "<p>等级 : <strong>Level 1</strong></p>";
    }else if( current_user_can( 'publish_pages' ) && !current_user_can( 'manage_options' ) ) {
            echo "<p>等级 : <strong>Level 2</strong></p>";
    }else if( current_user_can( 'manage_options' ) ) {
            echo "<p>等级 : <strong>Level 3</strong></p>";
    };?>
    </div>
  </div>
  <div class="user-info-setting">
      <a href="<?php
      if( current_user_can( 'manage_options' ) ) {
        echo bloginfo('url')."/wp-admin";
      }else{
        echo bloginfo('url').'/account';
      };?>
        "><span><i class="fa fa-cog" aria-hidden="true"></i> 账号管理</span></a>
  </div>
    <?php else: ?>
  <div class="user-info-logo" style="font-size:60px;line-height:60px;color:white;">
      <i class="fa fa-empire" aria-hidden="true"></i>
  </div>
  <div class="user-info-name">
    <span>尚未登录的游客</span>
  </div>
    <div class="user-info-link">
      <a href="<?php bloginfo('url'); ?>/login"><div class="user-info-login">登录</div></a>
      <a href="<?php bloginfo('url'); ?>/register"><div class="user-info-register">注册</div></a>
    </div>
  </div>
  <?php endif; ?>
</div>
</div>



<div class="wp-user-container">
    <div class="wp-user-benefit-header">
      <span><strong>本站服务</strong></span>
    </div>
    <div class="wp-user-benefit-main">
      <a href="<?php bloginfo('url'); ?>/history"><div class="wp-user-benefit-main-list">
      <span><i class="fa fa-youtube-play" aria-hidden="true"></i></span>
      <p>播放记录</p>
    </div></a>
      <a href="<?php bloginfo('url'); ?>/info"><div class="wp-user-benefit-main-list">
      <span><i class="fa fa-user-secret" aria-hidden="true"></i></span>
      <p>关于我们</p>
    </div></a>
    <a href="#" class="wp-user-weixin"><div class="wp-user-benefit-main-list">
      <span><i class="fa fa-weixin" aria-hidden="true"></i></span>
      <p>微信公众号</p>
    </div></a>
      <a href="<?php $general_options = get_option('ashuwp_general');echo $general_options['tab9_qq_link'];?>"><div class="wp-user-benefit-main-list">
      <span><i class="fa fa-qq" aria-hidden="true"></i></span>
      <p>QQ官方群</p>
    </div></a>
      <div style="clear:both"></div>
    </div>
</div>

<div class="wp-user-container">
    <div class="wp-user-benefit-header">
      <span><strong>设置头像</strong></span>
    </div>
    <div class="wp-user-benefit-main">
      <div class="col-md-12">
          <div class="new-con-user-info">
            <h4>图片文件需小于1M:</h4>
            <?php echo do_shortcode("[avatar_upload]"); ?>
          </div>
          <?php if ( $user_ID )  { ?>
          <a href="<?php echo wp_logout_url( home_url() ); ?>" title="Logout" class="btn btn-primary">登出</a>
          <?php } ?>
      </div>
    </div>
</div>


<div class="grey-bg-weixin">
 <div class="bg-pic">
    <image src="<?php bloginfo('template_url'); ?>/images/weixin.jpg" />
    <p>扫码关注</p>
  </div>
  <div class="grey-bg"></div>
</div>



<style>
.new-con-user-info h4{
  margin-bottom: 15px;
  margin-top: 15px;
  font-weight: bold;
}
.new-con-user-info h3,.new-con-user-info .submit,.new-con-user-info .updated,.new-con-user-info .description,.new-con-user-info #wpua-thumbnail-existing,.new-con-user-info #wpua-remove-button-existing,.new-con-user-info #wpua-undo-button-existing{
  display: none;
}
.new-con-user-info #wpua-upload-button-existing button{
  padding: 3px 15px;
  background-color: rgba(0, 0, 0, 0.8);
  color: rgba(255,255,255,0.8);
  border: none;
  border-radius: 3px;
  margin-top: 15px;
}
.new-con-user-info p{
  margin-bottom: 15px;
}
.new-con-user-info img{
  width: 150px;
}
.grey-bg-weixin{
  display:none;
}
.grey-bg{
    position:fixed;
  width:100%;
  height:100%;
  left:0;
  top:0;
  background-color:rgba(0,0,0,0.5);
  z-index: 5;
}
.bg-pic{
  width:280px;
  height:320px;
  border-radius:10px;
  position:fixed;
  top:50%;
  left:50%;
  transform:translate(-50%,-60%);
  background-color:white;
  z-index: 6;
}
.bg-pic img{
  width:240px;
  height:240px;
  margin:20px;
}
.bg-pic p{
  text-align:center;
      font-size: 1.2em;
    font-weight: bold;
  color:rgba(0,0,0,0.6);
}
    body{
  background-color:#ebebeb;
  }
  .wp-user-container{
    background-color:white;
    width:100%;
    padding:10px;
    margin-bottom:10px;
  }
  .wp-user-info{
    background-image: linear-gradient(to left, #7B72E9 0%, #667eea 100%);
    height: 110px;
    border-radius: 5px;
    box-shadow:0 0 5px rgba(123, 114, 233, 0.8);
      display: flex;
    justify-content: space-between;
    align-items: center;
        position:relative;
      overflow:hidden;
  }
  .user-info-show{
    padding-left: 15px;
    height: 100px;
    width: 80%;
    overflow:hidden;
    display: flex;
    justify-content: flex-start;
    align-items: center;
  }

  .user-info-logo{
    width: 60px;
    height: 60px;
    border-radius: 50%;
        overflow:hidden;
  }
    .user-info-name{
    margin-left: 15px;
    color: white;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
  }
  .user-info-name span{
    font-size: 1.2em;
  }
  .user-info-name strong{
      color:#667eea;
      padding:3px 10px 1px 10px;
      background-color:rgba(255,255,255,0.5);
      border-radius:20px;
  }
  .user-info-name p{
    font-size: 1em;
    opacity: 0.7;
  }
  .user-info-setting{
    position:absolute;
    top:10px;
    right:10px;
    font-size:1em;
    opacity:0.4;
  }
  .user-info-setting a{
    color:black;
  }
  .user-info-upgrade {
    opacity:0.8;
    position:absolute;
    border-radius:3px;
    background-color:#333333;
    box-shadow: 0 0 10px #747474;
    bottom:-15px;
    right:-10px;
    width:70px;
    height:50px;
    font-size:0.7em;
    color:#7B72E9;
    padding:3px;
    transform:rotate(12deg);
    -ms-transform:rotate(12deg);  /* IE 9 */
    -moz-transform:rotate(12deg);   /* Firefox */
    -webkit-transform:rotate(12deg); /* Safari 和 Chrome */
    -o-transform:rotate(12deg);   /* Opera */
  }
  .user-info-upgrade-border{
    font-size:0.9em;
    padding:3px 5px 1px 5px;
    background-color:rgba(123,114,233,0.4);
    border-radius:30px;
    display:inline-block;
    color:white;
  }
  .wp-user-benefit-header span{
  font-size:1.5em;
  }
  .wp-user-benefit-header a{
    font-size:1.2em;
    float:right;
    color:#4285f4;
    line-height:1.8em;
    display: flex;
  justify-content: center;
  align-items: center;
  }
  .wp-user-benefit-header a strong{
    color:#4285f4;
    font-size:1.5em;
    margin-left:10px;
  }
  .wp-user-benefit{
    margin:10px -10px 0px -10px;
    height:100px;
    width:100vw;
    overflow:hidden;
    position:relative;
  }
  .wp-user-benefit-con{
    width:400vw;
    height:100%;
    position:absolute;
    top:0;
    left:0;
  }
  .usr-benefit-list{
    float:left;
    margin:0 5px 0 10px;
    width:calc(100vw - 40px);
    max-width:360px;
    height:100%;
    border-radius:5px;
    box-shadow:0 0 5px #ababab;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:20px;
  }
  .usr-benefit-list:nth-child(1){
    background-color:#4097de;
    color:#4097de;
  }
  .usr-benefit-list:nth-child(2){
    background-color:#C33E51;
    color:#C33E51;
  }
  .usr-benefit-list:nth-child(3){
    background-color:#51B467;
    color:#51B467;
  }
  .usr-benefit-list:nth-child(4){
    background-color:#50525E;
    color:#50525E;
  }
  .benefit-list-icon{
    width:45px;
    height:45px;
    border-radius:50%;
    font-size:25px;
    background-color:rgba(255,255,255,0.5);
    text-align:center;
    line-height:48px;
  }
  .benefit-list-context{
    color:rgba(255,255,255,0.6);
  }
  .benefit-list-context{
    margin:0 10px;
    max-width:150px;
  }
  .benefit-list-context span{
    font-size:1.4em;
    font-weight:bold;
  }
  .benefit-list-context p{
  margin-top:5px;
  }
  .benefit-list-status{
    background-color:rgba(255,255,255,0.7);
    border-radius:100px;
    padding:5px 10px 3px 10px;
  }
  .usr-benefit-list-last .benefit-list-icon,.usr-benefit-list-last .benefit-list-status{
    background-color:white;
  }
  .usr-benefit-list-last .benefit-list-context{
    color:white;
  }
  .usr-benefit-list-dot{
    width:100%;
    text-align:center;
    padding-top:15px;
    padding-bottom:5px;
    display:flex;
  justify-content:center;
    align-items:center;
  }
  .usr-benefit-list-dot ul li{
    list-style:none;
    width:10px;
    height:1px;
    margin-right:8px;
    background-color:grey;
    float:left;
    opacity:0.6;
  }
  .usr-benefit-list-dot ul .active{
    background-color:black;
  }
  .wp-user-benefit-main{
    width:100%;
  }
  .wp-user-benefit-main-list{
    float:left;
    width:25%;
    height:60px;
    margin:10px 0;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    align-items:center;
  }
  .wp-user-benefit-main a:nth-child(1) span{color:#ED5756}
  .wp-user-benefit-main a:nth-child(2) span{color:#02A9F5}
  .wp-user-benefit-main a:nth-child(3) span{color:#5560DE}
  .wp-user-benefit-main a:nth-child(4) span{color:#1375F4}
  .wp-user-benefit-main a:nth-child(5) span{color:#FFB600}
  .wp-user-benefit-main a:nth-child(6) span{color:#13C79E}
  .wp-user-benefit-main a:nth-child(7) span{color:#19CBE2}
  .wp-user-benefit-main a:nth-child(8) span{color:#14C69D}
  .wp-user-benefit-main-list span{
      font-size:1.75em;
  }
  .wp-user-benefit-main-list p{
    color:#4A4A4A;
  }
  .user-info-link {
    position:absolute;
    height:80px;
    width:60px;
    top:15px;
    right:15px;
    display:flex;
    flex-direction:column;
    justify-content:space-around;
    align-items:center;
  }
  .user-info-login,.user-info-register{
    text-align:center;
    border-radius:50px;
    width:60px;
    padding:4px 15px;
    background-color:rgba(255,255,255,0.6);
    color:#7B72E9;
  }
  .wp-user-other-link{
    width:100%;
    margin-top:10px;
  }
  .other-link-list{
    float:left;
    width:50%;
    font-size:1.1em;
    text-align: center;
  }
  .other-link-list a{
    display:inline-block;
    width:100%;
    padding:10px 0 10px 0;
    color:#4A4A4A;
  }
  .other-link-list a span{
    display:inline-block;
    float:right;
    width:2px;
    height:1.1em;
    background-color:grey;
  }
</style>
<script>
$(function(){
    $(".wp-user-weixin").click(function(){
      $(".grey-bg-weixin").show();
      });
    $(".grey-bg").click(function(){
      $(".grey-bg-weixin").hide();
      });
});
</script>
<?php else : ?>
  <?php endif; ?>
<?php get_footer(); ?>
