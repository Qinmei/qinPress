<?php get_header(); ?>  
<!-- Column 1 /Content -->
	<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
<?php  setPostViews(get_the_ID());?>

<div class="col-md-12 post-info-header"><?php the_title(); ?></div>
<div class="col-md-12 post-info-author">作者:<?php  echo the_author_meta( 'display_name' ); ?></div>

<div class="col-md-12">
		<div class="video-html5">
				<?php the_content(); ?>
		</div>
</div>
					
         
<?php else : ?>
	<?php endif; ?>


<?php  
    $current_category=get_the_category();
    $prev_post = get_previous_post($current_category,'');
    $next_post = get_next_post($current_category,'');
?>

<div class="col-md-12 post-info-footer">
    <div class="post-info-section">相关文章</div>

    <?php if (!empty( $prev_post )): ?>
        <a href="<?php echo get_permalink( $prev_post->ID ); ?>">
          <div class="post-info-section-list">
            <div class="post-info-list-img">
              <img src="<?php
                $post_ID=$prev_post->ID;
                $post_thumbnail_id = get_post_thumbnail_id( $post_ID );
                $post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id,'Full');
                echo $post_thumbnail_src[0];
              ?>" alt="">
            </div>
            <div class="post-info-list-main">
              <p><?php echo $prev_post->post_title; ?></p>
              <p><?php echo $prev_post->post_modified; ?></p>
            </div>
          </div>
        </a>
    <?php endif; ?>

    <?php if (!empty( $next_post )): ?>
        <a href="<?php echo get_permalink( $next_post->ID ); ?>">
          <div class="post-info-section-list">
            <div class="post-info-list-img">
              <img src="<?php
                $post_ID=$next_post->ID;
                $post_thumbnail_id = get_post_thumbnail_id( $post_ID );
                $post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id,'Full');
                echo $post_thumbnail_src[0];
              ?>" alt="">
            </div>
            <div class="post-info-list-main">
              <p><?php echo $next_post->post_title; ?></p>
              <p><?php echo $next_post->post_modified; ?></p>
            </div>
          </div>
        </a>
    <?php endif; ?>


    </div>
</div>

</div>

<div class="comments-container col-md-12">
  <div class="comments-flesh">
  <div class="post-info-section">评论区</div>	
<?php
$comments = get_comments('post_id='.$post->ID.'&parent=0'); 
foreach ($comments as $rc_comment) {
		?>
                <div class="comments-main col-md-12">
                  <div class="comments-img"><?php echo get_avatar($rc_comment->comment_author_email,48); ?></div>
                  <div class="comments-list">
                  <p><span style="color:green;font-weight:bold"> <?php echo $rc_comment->comment_author; ?>:</span>
                  <?php echo convert_smilies($rc_comment->comment_content); ?></p>
                  <?php 
                      $children = get_comments(array('parent' => $rc_comment->comment_ID));
                      foreach($children as $child) :
                          echo '<p style="margin-top:3px;"><span style="color:#ce669b;font-weight:bold">站长回复: </span>'.($child->comment_content).'</p>';
                      endforeach;
                      ?>
                    </div>
                  <?php  if ( current_user_can('level_10') ) {
                    $url = home_url();
                    echo '<a id="delete-'. $rc_comment->comment_ID .'" data-url="' . wp_nonce_url("$url/wp-admin/comment.php?action=deletecomment&amp;p=" . $rc_comment->comment_post_ID . '&amp;c=' . $rc_comment->comment_ID, 'delete-comment_' . $rc_comment->comment_ID) . '" style="margin-left:15px;color:green;font-size:0.8em;position:absolute;right:5px;bottom:3px;">删除</a>';
                  };?>
                </div>
		<?php
} //End foreach
?>
</div>
 </div>
<div class="col-md-12 margin-top comments-form">
<?php comment_form(
                            array(
                                'title_reply'=>'',                  
                                'fields' => array(                  
		'author' => '
    <div class="row col-xs-8 col-sm-6 col-md-4">
      <input class="form-control" id="author" name="author" type="text" value="" size="30" placeholder="昵称" aria-required="true" required="required"autocomplete="off" >
    </div>',
                                ),
                                'class_form'=> 'comment-form form-horizontal ',
                                'class_submit' => 'comments-input-submit btn btn-primary col-xs-4',
                                'comment_field' => '
                              <div class="form-group">
    <div class="col-xs-12">
      <textarea id="comment" name="comment" rows="4" maxlength="65525" class="form-control" placeholder="评论" aria-required="true" required="required"></textarea>
    </div>
  </div>')       
                        ); ?>
<?php if(is_user_logged_in() && comments_open()): ?>
<?php global $current_user;
      get_currentuserinfo();

      echo '<a class="btn btn-info disabled col-xs-4" role="button" style="margin-bottom:10px;">' . $current_user->display_name . '</a><a class="col-xs-6"></a>'; 
?>
<?php endif; ?>
</div>




<style>
.post-info-header{
  text-align: center;
  font-size: 1.6em;
  color:green;
  font-weight: bold;
  padding: 15px 0 0 0 ;
}
.post-info-author{
  margin-top: 10px;
  color:#99a2ab;
  font-size: 1.2em;
  text-align: center;
}
.post-info-section{
  font-size: 1.5em;
  margin: 15px 0;
}
#reply-title,.comment-notes{
  display:none;
}
#submit{
  float: right;
  margin: 0 0 0 15px;
}
.comments-container{
  margin-top:20px;
}
.comments-title p{
	font-size:16px;
}
.comments-img{
  position:absolute;
  left:3px;
  top:3px;
}
.comments-main{
  min-height:56px;
  margin-bottom:4px;
  border: solid 1px grey;
  border-radius:5px;
  display: flex;
  justify-content: flex-start;
  align-items: center;
  word-wrap: break-word;
  padding-left:50px;
  position:relative;
}
.comments-form{
    margin-top:20px;
  margin-bottom:60px;
}
.comments-list{
  margin-left:10px;
  padding-top:2px;
}
.post-info-footer{
  padding-top: 10px;
}
.post-info-section-list{
  width: 100%;
  height: 60px;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 20px;
}
.post-info-list-img{
  width: 100px;
  height: 60px;
  border-radius: 5px;
  overflow: hidden;
}
.post-info-list-img img{
  width:auto;
  height:100%;
}
.post-info-list-main{
  width: calc(100% - 100px);
  padding-left: 15px;
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items: flex-start;
}
.post-info-list-main p:nth-child(1){
  margin: 0;
  color: #434649;
  font-size: 1.2em;
  line-height: 1.3em;
  overflow:hidden;    
  text-overflow:ellipsis;    
  white-space: normal;    
  display:-webkit-box;    
  -webkit-box-orient:vertical;    
  -webkit-line-clamp:2;/*规定最多显示两行*/    
}  
.post-info-list-main p:nth-child(2){
  margin: 0;
  color: grey;
  margin-bottom: -5px;
}
.video-html5{
  margin-bottom: 30px;
    -moz-user-select: text; 
    -webkit-user-select: text; 
    -ms-user-select: text; 
    user-select: text; 
}
.video-html5 p{
  margin:20px 0 !important;
  font-size: 1.1em;
  line-height: 1.8em;
  text-align:left;
  word-break: break-all;
      -moz-user-select: text; 
    -webkit-user-select: text; 
    -ms-user-select: text; 
    user-select: text; 
}
.video-html5 span{
  font-weight:bold;
  color:green !important;
}

.video-html5 img{
  width: 100%;
  height: auto;
  border-radius: 5px;
  padding: 3px;
  border: solid 1px #cdcfcf;
  overflow: hidden;
}
h1,h2,h3,h4,h5,h6{
  font-weight: bold;
}
</style>
<?php get_footer(); ?>	