<?php get_header(); ?>
<style>
  .main-section{
    margin-top: 0;
  }
  .mobile-fixed{
    background-color: transparent;
  }
  .video-bottom-main{
    width:100%;
  }
  .video-bottom-main-list-info{
    overflow: hidden;
    display: flex;
    justify-content: flex-start;
    flex-direction: row;
    flex-wrap: wrap;
    margin-right: -10px;
    display: none;
    padding-bottom: 10px;
  }
  .video-bottom-main-list-info a{
    color:grey;
     width:calc((100% - 46px)/6);
     display: inline-block;
     margin: 4px 4px 4px 0;
  }

  .video-bottom-main-list-sec-list{
    width: 100%;
    height: 32px;
    border-radius:5px;
    text-align: center;
    line-height: 32px;
    background-color:white;
    font-size:0.9em;
    border: solid 1px grey;
  }
  .video-bottom-main-list-sec-list strong{
    font-weight: normal;
    margin: 0 3px;
  }
  .video-bottom-main-list-sec-list.active{
    background-color: rgba(0,0,0,0.6);
    background-color: <?php $general_options = get_option('ashuwp_general');echo  $general_options['qinmei_base_color'];?>;
    color: white;
    border: none;
  }
  .video-bottom-list-head{
    margin-top:15px;
    font-size:1.3em;
    color:grey;
  }
  .video-bottom-list-head span{
    font-size:0.9em;
  }
  .index-table-list{
    opacity:0.8;
  }
  .video-bottom-info-content p{
    margin-bottom:10px;
  }

  .dplayer-controller .dplayer-icons.dplayer-comment-box .dplayer-comment-setting-box .dplayer-comment-setting-type span{
    width: auto;
  }
  .foot-comment-con{
    margin: 0 -5px;
  }
  .comments-children .form-submit{
    display: flex;
  }
  .pc-discuss-location{
    position: relative;
  }
  .pc-discuss-commentload{
    display: none;
  position: absolute;
    right: 0;
    line-height: 33px;
    height: 33px;
    top: 0;
    padding: 0 15px;
    background-color: rgba(0,0,0,0.2);
    border-radius: 5px;

  }
  .page-input-textarea {
    padding: 5px 15px;
    border-radius: 5px;
    background-color: rgba(0,0,0,0.8);
    color: rgba(255,255,255,0.8);
    cursor: pointer;
    border: none;
    width: 85px;
}
  .form-control-page {
    display: block;
    width: 100%;
    border-radius: 5px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-image: none;
    border: 1px solid #ccc;
}
  .pc-discuss-commenterror{
    display: none;
  position: absolute;
    right: 0;
    line-height: 33px;
    height: 33px;
    top: 0;
    padding: 0 15px;
    background-color: rgba(0,0,0,0.2);
    border-radius: 5px;
  }
  .pc-commments-list{
    width: 100%;
    margin-top: 10px;
    min-height: 80px;
    background-color: white;
    border-bottom: solid 1px rgba(0,0,0,0.05);
  }
  .pc-commments-list:nth-child(1){
    margin-top: 0;
  }
  .pc-discuss-con-main .comments-head{
    width: 100%;
    height: 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

 .pc-discuss-con-main .comments-head .comments-head-option{
  width: 36px;
  height: 36px;
  text-align: right;
  line-height: 36px;
  font-size: 0.8em;
  position: relative;
 }
 .head-option-con{
  position: absolute;
  display: none;
  right: 0;
  bottom: 0;
z-index: 6}
  .pc-discuss-con-main .user-info{
    width: calc(100% - 36px);
    display: flex;
    justify-content: flex-start;
    align-items: center;
  }
  .pc-discuss-con-main .user-info-logo{
    width: 32px;
    height: 32px;
    border-radius: 50%;
    overflow: hidden;
  }
  .pc-discuss-con-main .user-info-name{
    width: calc(100% - 80px);
    margin-left: 15px;
    color: rgba(0,0,0,0.8);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: flex-start;
    color: rgba(0,0,0,0.6);
    font-weight: bold;
  }
  .pc-discuss-con-main .user-info-name span{
    font-size: 0.8em;
    font-weight: normal;
    color: rgba(0,0,0,0.4);
  }
  .pc-discuss-con-main .comments-content{
    padding: 5px 0 5px 47px;
    color: #1a1a1a;
    line-height: 1.6;
  }
  .pc-discuss-con-main .comments-foot{
    height: 30px;
    width: 100%;
    display: flex;
    justify-content: flex-start;
    align-items: center;
  }
  .pc-discuss-con-main .comments-foot-list{
    min-width: 40px;
    height: 30px;
    color: rgba(0,0,0,0.5);
    display: flex;
    justify-content: flex-start;
    align-items: center;
    cursor: pointer;
    margin-right: 30px;
  }
  .pc-discuss-con-main .comments-foot-list:hover{
    color: rgba(0,0,0,0.8);
  }
  .pc-discuss-con-main .comments-foot-list i{
    margin-right: 8px;
  }
  .pc-discuss-con-main .comments-children{
    margin: 5px 0 5px 47px;
    background-color: rgba(0,0,0,0.03);
  }
  .pc-discuss-con-main .pc-comments-child-list{
    padding: 5px;
  }
  .comments-child-parent{
    font-size: 10px;
    line-height: 10px;
    background-color: rgba(0,0,0,0.6);
    color: white;
    border-radius: 3px;
    padding: 2px 3px 1px 3px;
    position: relative;
    top: -2px;
  }

  .video-bottom-head{
    width: 100%;
    height: 40px;
    display: flex;
    justify-content: flex-start;
    align-items: center;
    padding: 10px 0;
  }
  .bottom-head-line{
    width: 4px;
    height: 1.2em;
    border-radius: 10px;
    background-color: rgba(0,0,0,0.8);
    background-color: <?php $general_options = get_option('ashuwp_general');echo  $general_options['qinmei_base_color'];?>
  }
  .bottom-head-title{
    font-size: 1.1em;
    font-weight: bold;
    line-height: 20px;
    height: 20px;
    margin-left: 8px;
    color: rgba(0,0,0,0.8);
    width: calc(100% - 60px);
  }
  .bottom-head-right-title,.bottom-head-right-extent{
    width: 56px;
    text-align: right;
    font-weight: bold;
  }
  .video-middle-title a{
    color: black;
  }
  .bottom-head-right-title{
    float: right;
  }
  .video-middle-title-text{
    font-size: 0.92em;
    color: grey;
  }
  .video-middle-btn{
    width: 100%;
    height: 40px;
    display: flex;
    margin-top: 10px;
    justify-content: space-between;
  }
  .post-error-report{
  width: calc((100% - 15px)/2);
  height: 32px;
  border-radius: 100px;
  color: rgba(0,0,0,0.8);
  border: solid 1px rgba(0,0,0,0.8);
  text-align: center;
  line-height: 32px;
  letter-spacing: 3px;
  overflow: hidden;
}
.post-error-report p{
  cursor: pointer;
}
.post-error-report p:hover{
  background-color: rgba(0,0,0,0.8);
  color: rgba(255,255,255,0.8);
}
.message-post-con{
  display: none;
}
.message-post-panel{
  width: 95vw;
  height: 270px;
  background-color: white;
  border-radius: 5px;
  position: fixed;
  top: 60px;
  left: 2.5vw;
  z-index: 9;
  padding: 15px;
}
.grey-bg{
  background-color: rgba(0,0,0,0.5);
  width: 100vw;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 8;
}
.message-post-panel-title{
  color: black;
  font-size: 1.5em;
}
.post-error-form-option{
  margin: 15px 0;
}
.post-error-submit-btn{
  width: calc((100% - 80px)/2);
  height: 32px;
  border-radius: 5px;
  background-color: rgba(0,0,0,0.8);
  color: rgba(255,255,255,0.8);
  border: none;
  overflow: hidden;
  text-align: center;
  cursor: pointer;
}
.post-error-submit-btn:nth-child(1){
  background-color: rgba(0,0,0,0.4);
}
.post-error-submit-btn:focus{
  border: none;
  outline: none;
}
.form-submit-btn{
  margin-top: 15px;
  width: 100%;
  display: flex;
  justify-content: space-between;
}
.comments-form{
  position:fixed;
  z-index:39;
  bottom:0;
  left:0;
  width:100vw;
  height:100px;
  background-color:white;
}
.discuss-form-top{
  width: 100%;
  padding-right:15px;
  height: 40px;
  border-bottom: solid 1px rgba(0,0,0,0.05);
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.discuss-top-close{
  height: 40px;
  text-align: center;
  line-height: 40px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.discuss-top-close i{
  font-size: 1.35em;
  width: 40px;
  margin-right: 10px;
}
.discuss-top-close span{
  font-size: 1.2em;
}
.discuss-submit-bottom{
  height: 35px;
  background-color: white;
  border-top: solid 1px rgba(0,0,0,0.04);
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  padding: 0 10px;
}
.discuss-submit-bottom  i{
  font-size: 1.5em;
}
.discuss-submit-bottom span{
    width: 35px;
    height: 35px;
    display: inline-block;
    text-align: center;
    line-height: 35px;
}
.discuss-submit-item.item-link{
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  width: 85vw;
  height: 220px;
  border-radius: 3px;
  background-color: white;
  box-shadow: 0 0 5px rgba(0,0,0,0.4);
  padding: 20px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items: center;
}
.user-comment-input{
    width:100%;
  }
  .user-comment-input textarea{
    width: 100%;
    padding: 10px;
    border: none;
    outline: none;
    appearance: none;
  }
  .comment-respond{
    line-height: 20px;
    height: 60px;
    overflow: hidden;
  }
  .user-comment-input textarea:focus {
     border: 0px solid green;
     outline: none;
  }
  .user-comment-input textarea::-webkit-input-placeholder {
    color: black;
    }

    .user-comment-input textarea:-moz-placeholder { /* Firefox 18- */
    color: black;
    }

    .user-comment-input textarea::-moz-placeholder {  /* Firefox 19+ */
    color: black;
    }

    .user-comment-input textarea:-ms-input-placeholder {
    color: black;
    }
  .comments-discuss-sec .form-submit{
    display: none;
  }
  .head-option-panel{
    width: 120px;
    background-color: white;
    border-radius: 3px;
    z-index: 6;
    padding: 0 10px;
    text-align: left;
  }
  .head-option-panel-list{
    height: 35px;
    padding-left:15px;
    font-size: 1.3em;
    display: flex;
    justify-content: flex-start;
    align-items: center;
  }
  .comments-discuss-sec-foot{
    width: 100vw;
    height: 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .comments-discuss-sec-foot span{
    display: inline-block;
    width: 40px;
    height: 40px;
    text-align: center;
    line-height: 40px;
  }
  .comments-discuss-sec-foot span i{
    font-size: 1.5em;
  }
  .page-download-button{
    color: rgba(0,0,0,0.8);
    border: solid 1px rgba(0,0,0,0.8);
    text-align: center;
    line-height: 32px;
    letter-spacing: 3px;
    overflow: hidden;
    border-radius: 30px;
  }
  .info-top{
    height: 200px;
    position: relative;
    padding: 0 15px;
    padding-top: 40px;
    margin-bottom: 30px;
  }
  .info-top-bg{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -2;
    overflow: hidden;
  }
  .info-top-bg-rgb {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 2;
  }
  .info-top-blurbg {
    width: 100%;
    height: 100%;
    background-size: cover;
    filter: blur(15px);
    transform: scale(1.2);
    background-position-x: center;
    background-position-y: center;
  }
  .info-top-con{
    display: flex;
    justify-content: space-between;
  }
  .info-top-con-left{
    width: 105px;
    height: 140px;
    background-color: white;
    padding: 2px;
    border-radius: 3px;
    box-shadow: 0 0 5px rgba(0,0,0,0.4);
  }
  .info-top-con-left img{
    width: 100%;
    height: 100%;
    border-radius: 2px;
  }
  .info-top-title{
    color: white;
    height: 40px;
    line-height: 46px;
    font-size: 1.2em;
    text-align: center;
  }
  .info-top-con-right{
    width: calc(100% - 120px);
    height: 120px;
    overflow:hidden;
    display: flex;
    justify-content: space-between;
  }
  .info-right-text{
    height: 120px;
    padding: 10px 0;
    width:calc(100% - 90px);
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    color: white;
    font-size: 0.9em;
  }

  .info-right-rate{
    height: 100px;
    padding: 10px 0;
    width:80px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.8em;
  }
  .info-right-rate span:nth-child(1){
    color: #ffa726;
    font-size: 3em;
    margin-bottom: 10px;
  }
  .video-info-context{
    font-size: 0.95em;
    color: #524c42;
    padding-bottom: 10px;
  }
  .small-line{
    margin: 0 -15px;
    height: 6px;
    background-color: rgba(0,0,0,0.05);
  }
  .video-eposide-toggle{
    cursor: pointer;
  }
</style>
<!-- Column 1 /Content -->
<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>
<?php  setPostViews(get_the_ID());?>


<div class="animate-info">
  <div class="info-top">
    <div class="info-top-bg" >
      <div class="info-top-bg-rgb"></div>
      <div class="info-top-blurbg" style="background-image: url(<?php echo get_post_meta($post->ID,"baseinfo_img_link",true); ?>);"></div>
    </div>
    <div class="info-top-title"><?php the_title();?></div>
    <div class="info-top-con">
        <div class="info-top-con-left">
            <img src="<?php echo get_post_meta($post->ID,"baseinfo_img_link",true);?>" alt="">
        </div>
        <div class="info-top-con-right">
          <div class="info-right-text">
            <span>番剧 | <?php echo get_post_meta($post->ID,"baseinfo_area",true);?></span>
            <span>首播：<?php echo get_post_meta($post->ID,"baseinfo_first_play",true);?></span>
            <span>集数：<?php echo get_post_meta($post->ID,"baseinfo_episode_num",true);?></span>
            <span>标签：<?php $animatetags = wp_get_object_terms( $post->ID,  'animatecat' );
                foreach ( $animatetags as $tag ) { echo $tag->name.' ';}?>
            </span>
          </div>
          <div class="info-right-rate">
            <span><?php echo get_post_meta($post->ID,"baseinfo_rate",true);?></span>
            <span><?php echo get_post_meta($post->ID,"baseinfo_rate_num",true);?>人</span>
          </div>
        </div>
    </div>
  </div>
</div>


<div class="video-bottom-main">
  <div class="col-md-12 video-bottom-main-list">
    <div class="video-bottom-main">
      <div class="video-introduce">
        <div class="video-info-text">
          <div class="video-info-context">
            <?php echo trim(get_post_meta($post->ID,"baseinfo_introduce",true));?>
          </div>
        </div>
      </div>
    </div>
    <div class="small-line"></div>
<?php $html = $general_options['qinmei_ad_pc_22'];echo html_entity_decode($html, ENT_QUOTES);?>
    <div class="video-bottom-head video-eposide-toggle">
      <div class="bottom-head-line"></div>
      <div class="bottom-head-title">选集(<span><?php echo get_post_meta($post->ID,"baseinfo_episode_num",true);?></span>)</div>
      <div class="bottom-head-right-extent" column-id="<?php echo $count;?>">展开</div>
    </div>
	  <div class="video-bottom-main-list-info">
        <?php $general_options = get_option('ashuwp_general');
          $count = 1;
              $meta_value = get_post_meta($post->ID,'baseinfo_episode_con',true);
              foreach($meta_value as $pagelist) { ?>
                <a href="<?php echo site_url().'/play?l='.$post->ID.'&n='.$count;?>">
                  <div class="video-bottom-main-list-sec-list">
                    <strong><?php echo $pagelist["baseinfo_episode_sort"]; ?></strong></div>
                </a>
        <?php $count++;}; ?>
    </div>
    <?php $html = $general_options['qinmei_ad_pc_23'];echo html_entity_decode($html, ENT_QUOTES);?>
    <div class="small-line"></div>
     <?php if(empty(get_post_meta($post->ID,"baseinfo_download_link",true))){}else{;?>
     <div class="video-bottom-head">
        <div class="bottom-head-line"></div>
        <div class="bottom-head-title">视频下载</div>
      </div>
    <div class="video-bottom-main">
          <a href="<?php echo get_post_meta($post->ID,"baseinfo_download_link",true);?>"><div class="page-download-button" style="">
              <i class="fa fa-cloud-download" aria-hidden="true"></i><?php echo get_post_meta($post->ID,"baseinfo_download_title",true);?>
          </div></a>
    <?php }?>

  <?php $html = $general_options['qinmei_ad_pc_24'];echo html_entity_decode($html, ENT_QUOTES);?>

    <?php  $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $number =100;
            $offset = ( $paged - 1 ) * $number;
            $args = array(
                'status' => 'approve',
                'post_id' => get_the_ID(),
                'parent'  => '0',
                'number' => $number,
                'offset' => $offset,
                'paged' => $paged
            );

            $comments_query = new WP_Comment_Query;
            $comments = $comments_query->query( $args );?>
    <div class="video-bottom-head">
      <div class="bottom-head-line"></div>
      <div class="bottom-head-title">
        评论(<?php echo count($comments);?>)
      </div>
      <div class="bottom-head-right-title">写评论</div>
    </div>

      <div class="pc-discuss-con-main">
        <div class="discuss-con-panel">
            <?php
            if ( $comments ) {
                foreach ( $comments as $comment ) {?>
                    <div class="pc-commments-list">
                      <div class="comments-head">
                        <div class="user-info">
                          <div class="user-info-logo">
                            <?php echo get_avatar($comment ->comment_author_email,32); ?>
                          </div>
                          <div class="user-info-name">
                            <?php if(!empty($comment->comment_author)){echo $comment->comment_author;}else{echo "游客";}; ?>

                            <span><?php echo $comment ->comment_date; ?></span>

                          </div>
                          <div class="user-info-zan">
                            <span class="count" ><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                <?php
                              $comment_id = $comment->comment_ID;
                              if (get_comment_meta($comment_id, 'pinglun_zan', true)){echo get_comment_meta($comment_id, 'pinglun_zan', true);
                              }else {echo '0';
                              }?></span>
                          </div>
                        </div>
                        <div class="comments-head-option" id="<?php echo $comment->comment_ID;?>">
                          <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                          <div class="head-option-con">
                            <div class="head-option-panel">
                              <div class="head-option-panel-list"><a href="javascript:;" data-action="ding" data-id="<?php comment_ID(); ?>" class="pinglunZan <?php
                                if (isset($_COOKIE['pinglun_zan_' . $comment->comment_ID]))echo 'done';
                                ?>" style="color: black">点赞</a></div>
                              <div class="head-option-panel-list head-option-panel-list-reply">回复</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="comments-content">
                        <?php
                        $child_maintext = explode(':',$comment->comment_content);
                        if(!empty($child_maintext[1])){
                          echo convert_smilies($child_maintext[1]);
                        }else{
                          echo convert_smilies($child_maintext[0]);
                        }?>
                      </div>
                    <?php
                      $args = array(
                          'status' => 'approve',
                          'post_id' => get_the_ID(),
                          'parent'  => $comment->comment_ID,
                          'orderby'=>'time',
                          'order'=>'ASC'
                      );

                      $children_query = new WP_Comment_Query;
                      $children = $children_query->query( $args );?>


                  <div class="comments-children" id="<?php echo $comment->comment_ID;?>">
                    <div id="comments-children-<?php echo $comment->comment_ID;?>">
                    <?php	foreach ( $children as $child) { ?>
                      <div class="pc-comments-child-list">
                            <span class="comments-child-name" style="color: green;">
                              <?php echo $child ->comment_author; ?></span>
                            <?php if(($comment->user_id) === ($child->user_id)){
                                echo '<span class="comments-child-parent">楼主</span>';
                            }?>:
                        <span><?php echo convert_smilies($child->comment_content); ?></span>
                      </div>
                    <?php };?>
                  </div>
                  </div>
                  <?php wp_reset_postdata(); ?>
                </div>
              <?php }} else {echo '<div style="padding-left:15px;font-size:0.9em;">暂无评论,赶紧抢个沙发吧</div>';}?>
        </div>
        <div class="pagination" style="display:none">
          <?php $tot_returned_comments = count($comments);
              $num = $paged + 1;
              if ($number == $tot_returned_comments) {
                  echo '<a href="/'.(the_slug()).'/page/' . $num . '">Next</a>';
              }?>
        </div>
      </div>
    </div>
    <?php wp_reset_postdata(); ?>
    </div>
  </div>
</div>

<?php if(is_user_logged_in()): ?>
<div class="comments-discuss-con" style="display:none;">
<div class="comments-form comments-discuss-sec">
  <?php comment_form(
        array(
          'title_reply'=>'',
          'label_submit' => __( '发布评论' ),
          'class_form'=> 'comment-form form-horizontal ',
          'class_submit' => 'page-input-textarea',
          'comment_field' => '
            <div class="user-comment-input">
                <textarea id="comment" name="comment" rows="4" maxlength="65525" placeholder="请输入评论内容" aria-required="true" required="required"></textarea>
            </div>')
  ); ?>
  <div class="comments-discuss-sec-foot">
    <span></span>
    <span class="discuss-submit-btn"><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
  </div>
</div>
<div class="comments-discuss-con-bg" style="width: 100vw;height: 100vh;background-color: rgba(0,0,0,0.6);position: fixed;top: 0;left: 0;"></div>
</div>
<?php endif; ?>
<div class="comments-head-option-bg" style="width: 100vw;height: 100vh;background-color: rgba(0,0,0,0.6);position: fixed;top: 0;left: 0;display: none;z-index: 5;"></div>
<?php else : ?>
	<?php endif; ?>
<script>


$(document).on("click",".bottom-head-right-title", function(){
  history.pushState({username: "serch"}, "search");
    $(".form-submit #comment_parent").val('0');
    $(".user-comment-input #comment").val('');
  $('.form-control-page').each(function(){this.value=''});
  $('.comments-discuss-con').slideDown();
  $('.comments-discuss-sec').show();
  $(".user-comment-input #comment").focus();
});

$(document).on("click",".comments-discuss-con-bg", function(){
  $('.comments-discuss-con').hide();
});

$(document).on("click",".discuss-submit-btn", function(){

  $("#commentform").submit();
});


$(document).on("click",".comments-head-option", function(){
  history.pushState({username: "serch"}, "search");
  $(this).children(".head-option-con").show();
  $(".comments-head-option-bg").show();
});

$(document).on("click",".comments-head-option-bg", function(){
  $(this).hide();
  $(".head-option-con").hide();
});

$(document).on("click",".head-option-panel-list", function(e){
  $(".comments-head-option-bg").hide();
  $(".head-option-con").hide();
   e.stopPropagation();
});



$(document).on("click",".pc-comments-child-list", function() {
  history.pushState({username: "serch"}, "search");
  $('.comments-discuss-con').slideDown();
  $('.form-control-page').each(function(){this.value=''});
  var author = $(this).find(".comments-child-name").html();
     author = "回复" + author.trim() + ":";
  var commentsId = $(this).parents(".comments-children").attr("id");
  $(".form-submit #comment_parent").val(commentsId);
  $(".user-comment-input #comment").val(author);
  $(".user-comment-input #comment").focus();

});

$(document).on("click",".head-option-panel-list-reply", function() {
  history.pushState({username: "serch"}, "search");
  $('.comments-discuss-con').slideDown();
  $('.form-control-page').each(function(){this.value=''});
  var commentsId = $(this).parents(".comments-head-option").attr("id");
  $(".form-submit #comment_parent").val(commentsId);
  $(".user-comment-input #comment").focus();

});


$(document).on("click",".video-eposide-toggle", function() {
  if($(this).hasClass("active")){
    $(this).removeClass("active");
    $('.bottom-head-right-extent').html("展开");
    $(".video-bottom-main-list-info").toggle();
  }else{
    $(this).addClass("active");
    $('.bottom-head-right-extent').html("收起");
    $(".video-bottom-main-list-info").toggle();
  }
});

</script>
<?php get_footer(); ?>
