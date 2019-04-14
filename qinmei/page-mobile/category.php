<?php get_header(); ?>
<style>
  .mobile-nav {
    border-bottom:none;
}
.mobile-info-post-list{
  display: flex;
  flex-direction:column;
  justify-content: flex-start;
  align-items: flex-start;
  border-radius:5px;
  box-shadow:0 0 5px #CFCFCF;
  margin:15px 15px 0 15px;
  font-size:1.1em;
  overflow: hidden;
}
.post-title-img{
  height: 100px;
  width: 100%;
  background-size: cover;
  background-position-x:center;
  background-position-y:center;
}
.post-list-content{
  width: 100%;
  padding: 10px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items: flex-start;
  background-color: rgba(255,255,255,1);
}
.post-list-content p:nth-child(1){
  margin: 0 0 5px 0;
  color: black;
  font-size: 1.2em;
  font-weight: 600;
  overflow:hidden;    
  text-overflow:ellipsis;    
  white-space: normal;    
  display:-webkit-box;    
  -webkit-box-orient:vertical;    
  -webkit-line-clamp:2;/*规定最多显示两行*/  
}
.post-list-content p:nth-child(2){
  margin: 0;
  color: grey;
  font-size: 0.95em;
  overflow:hidden;    
  text-overflow:ellipsis;    
  white-space: normal;    
  display:-webkit-box;    
  -webkit-box-orient:vertical;    
  -webkit-line-clamp:2;/*规定最多显示两行*/    
}  
</style>
<div class="col-md-12 col-xs-12">
 <div class="mobile-nav">
    <div class="mobile-nav-list">
      <div class="mobile-nav-list-main active"><?php single_cat_title();?></div>
    </div>
</div>
</div>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<div class="col-md-6 col-xs-12">
  <div class="row">
    <a href="<?php echo the_permalink();?>">
      <div class="mobile-info-post-list">
        <div class="post-title-img" style='background-image: url("<?php the_post_thumbnail_url(medium); ?>");'>
        </div>
        <div class="post-list-content">
            <p><?php the_title(); ?></p>
            <?php the_excerpt(); ?>
        </div>
      </div>
    </a>
  </div>
</div>
<?php endwhile;?>
<?php endif; ?>
<div class="col-md-12 display-box">
  <?php if ( function_exists('dw_pagination') ) { dw_pagination(); } ?>
</div>

<?php get_footer(); ?>