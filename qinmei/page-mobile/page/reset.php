<?php 
get_header(); 
wp_head();
?>
<style>
  .text-link {
    text-align: center;
    margin-top: 20px;
    color: #bbb;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .text-link a {
    display: block;
    width: 80px;
    font-size: 1.1em;
    margin: 0 10px;
    color: rgba(0,0,0,0.75);
  }
  .text-link a:nth-child(1) {
    text-align: right;
  }
  .text-link a:nth-child(2) {
    text-align: left;
  }
  .xh-regbox .xh-title {
    font-size: 200%;
  }
</style>
<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
<div class="mobile-nav" style="border-bottom: solid 1px rgba(0,0,0,0.05);">
       <a href="<?php bloginfo('url'); ?>/"><div class="mobile-nav-list">
         <div class="mobile-nav-list-main">首页</div>
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
         <div class="mobile-nav-list-main active">用户</div>
       </div></a>
 </div>
<div class="col-md-12">
  <div class="row">
    <?php the_content();?>
    <div class="text-link">
       <a class="login-show" href="/register">注册</a>｜<a class="register-show" href="/login">登录</a>
    </div>
  </div>
</div>


<?php else : ?>
	<?php endif; ?>
  <script src="https://cdn.bootcss.com/jquery.touchswipe/1.6.18/jquery.touchSwipe.min.js"></script>
<?php 
wp_footer();
get_footer(); ?>