<?php get_header(); ?>
<style>
  main{
    background-color: rgba(0,0,0,0.1);
  }
  .video-sidebar{

  }
  .video-sidebar-top{
    width: 100%;
  }
  .video-sidebar-con{
    margin: 0px 5px 0 15px;
    color: grey;
    overflow: auto;
    height: calc(100% - 72px);
  }
  .video-sidebar-list{
    width: 100%;
    height: 55px;
    background-color: grey;
    margin-top: 15px;
    color: white;
    border-radius: 5px;
    padding:0 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .video-sidebar-list:hover{
    background-color: rgba(0,0,0,0.8);
  }
  .video-sidebar-list.active{
    background-color: rgba(0,0,0,0.8);
  }
  .video-sidebar-list strong,.video-sidebar-list i{
    margin: 0 5px;
  }
  .video-content-main::-webkit-scrollbar {
    height: 5px;
  }
  .foot-comment-right{
    width: 280px;
    background-color: transparent;
    border-radius: 0;
    padding: 0;
  }
  .foot-comment-left{
    width: calc(100% - 295px);
  }
  .video-html5-wrap{
    margin-bottom: 12px;
    margin: 15px;
  }
  .foot-comment-con{
    min-height: 100px;
  }
  .comments-con{
    margin-top: 15px;
  }
  .foot-comment-left{
    padding:15px;
  }
  .comments-pc-list-text{
    padding-left: 45px;
  }
  .pc-commments-list{
    margin-top: 0;
    border-radius: 0;
    border-bottom: solid 1px rgba(0,0,0,0.08);
    padding:10px  0;
  }
  .pc-discuss-con-main .comments-content{
    padding-left: 45px;
  }
/* 滚动槽 */
  .video-content-main::-webkit-scrollbar-track {
    border-radius:10px;
  }
/* 滚动条滑块 */
  .video-content-main::-webkit-scrollbar-thumb {
    border-radius:10px;
    background:rgba(0,0,0,0.4);
  }
  .video-content-main::-webkit-scrollbar-thumb:window-inactive {
    background:rgba(0,0,0,0.1);
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
  .ias-noneleft{
    font-weight: bold;
    width: 100%;
    margin: 15px 0 0;
    background-color: white;
    border-radius: 5px;
    text-align: center;
    padding: 10px;
    color: rgba(0,0,0,0.4);
  }
  .pc-discuss-login{
    float: right;
    margin-top: 10px;
    margin-right: 10px;
    padding: 8px 15px;
    background-color: rgba(0,0,0,0.8);
    color: rgba(255,255,255,0.8);
    border-radius: 5px
  }
  .pc-discuss-nav-head a{
    color: white;
  }
  .pc-discuss-con-main .comments-foot{
    padding-left: 45px;
    height: 20px;
    margin-top: 10px;
  }
  .pc-discuss-con-main{
    padding-top: 0;
  }
  .pc-discuss-con-main .comments-foot.comments-child-foot{
    padding-left: 10px;
  }
  .pc-discuss-con-main .comments-foot-list{
    height: 20px;
  }
  .pc-discuss-con-main .comments-children {
    margin: 10px 30px;
    width: auto;
  }
  .dplayer-controller .dplayer-icons.dplayer-comment-box .dplayer-comment-setting-box .dplayer-comment-setting-type span{
    width: auto;
  }
  .page-video-top{
    background-color: white;
  }
  .video-middle-main{
    margin-right: 15px;
    height: 120px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .video-middle-con{
    width: calc(100% - 220px);
    display: flex;
    justify-content: flex-end;
  }

  .video-middle-btn{
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    width: 250px;
    margin-right: -5px;
  }
  .video-middle-title{
    font-size: 1.6em;
    color: black;
  }
  .video-middle-title a{
    color: black;
  }
  .videp-middle-icon{
    font-size: 1.2em;
    color: grey;
  }
  .videp-middle-icon span{
    margin-right: 20px;
  }
  .videp-middle-icon i{
    margin-right: 5px;
  }
  .video-sidebar-con::-webkit-scrollbar {
  width: 6px;
  background: rgba(118,176,243,.3);
  border-radius: 5px;
}
.video-sidebar-con::-webkit-scrollbar-button {
    display: none;
}
.video-sidebar-con::-webkit-scrollbar-thumb {
    width: 8px;
    min-height: 15px;
    background: rgba(0,0,0,.2);
    border-radius: 5px;
}
.video-sidebar-con::-webkit-scrollbar-thumb:hover {
    background: rgba(0,0,0,.6);
}
.video-sidebar-con::-webkit-scrollbar-track {
    background-color: #fff;
}
.post-error-report{
  width: 118px;
  height: 40px;
  border-radius: 100px;
  color: rgba(0,0,0,0.8);
  background-color: rgba(255,255,255,0.4);
  text-align: center;
  line-height: 40px;
  letter-spacing: 3px;
  overflow: hidden;
}
.post-error-report p{
  cursor: pointer;
}
.post-error-report p:hover{
  background-color: rgba(255,255,255,0.6);
  color: rgba(0,0,0,0.8);
}
.message-post-con{
  display: none;
}
.message-post-panel{
  width: 600px;
  height: 300px;
  background-color: white;
  border-radius: 5px;
  position: fixed;
  top: 40%;
  left: 50%;
  transform: translate(-50%,-50%);
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
  width: 120px;
  height: 40px;
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
.foot-panel-show-list {
    cursor: pointer;
    padding: 5px 10px;
    font-size: 0.85em;
    line-height: 1.5em;
    text-align: center;
    overflow: hidden;
    color:white;
}
.foot-panel-show-list.active{
  background-color: rgba(0,0,0,0.8);
}
.page-main-foot-panel{
  margin-top: 15px;
}
.danmu-top-bar{
    height: 40px;
    display:  flex;
    justify-content: space-between;
    padding: 0 15px;
    align-items:  center;
    color: grey;
    font-size: 0.9em;
}
.danmu-bar-setting{
  font-size: 1.8em;
}
.danmu-top-tab{
  height: 32px;
  width: 100%;
  padding: 0 15px;
  display: flex;
  justify-content: space-around;
  border-top: 1px solid rgba(0,0,0,0.1);
}
.danmu-top-tab-time{
  width: 45px;
  height: 32px;
  line-height: 32px;
  font-size: 0.85em;
  cursor: pointer;
}
.danmu-top-tab-text{
  width: calc(100% - 45px);
  height: 32px;
  line-height: 32px;
  font-size: 0.85em;
  cursor: pointer;
  overflow: hidden;
  text-overflow: ellipsis;
}
.video-sidebar-con ul li{
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 24px;
}
.video-sidebar-con ul li .danmu-top-tab-time,
.video-sidebar-con ul li .danmu-top-tab-text{
  height: 24px;
  line-height: 24px;
}
.page-main-count{
  width: 100%;
  display: flex;
  justify-content: flex-start;
  color: rgba(255,255,255,0.9);
  align-items: center;
  height: 60px;
  margin: 10px 0;
}
.page-main-count-list{
  height: 45px;
  line-height: 20px;
}
.page-main-count-list span{
  display: inline-block;
  margin-top: 8px;
  }
.page-main-count-line{
  width: 2px;
  height: 40px;
  background-color: rgba(255,255,255,0.8);
  border-radius: 5px;
  margin: 0 20px;
}
.page-main-title{
  margin-bottom: 0;
  font-weight: bold;
  display: flex;
  justify-content: flex-start;
  align-items: center;
}
.page-main-title span{
  font-size: 12px;
    display: inline-block;
    vertical-align: middle;
    margin-left: 15px;
    height: 20px;
    padding: 0 4px;
    line-height: 18px;
    color: #fff;
    border: 1px solid #fff;
    border-radius: 3px;
}
.page-main-info{
  font-size: 0.9em;
}
.page-top{
  height: 400px;
}
.page-main-playinfo{
  color: rgba(255,255,255,0.8);
  height: 35px;
}
.page-main-playinfo span{
  margin-right: 30px;
}
.page-action-button{
  height: 48px;
  min-width: 128px;
  background-color: #f36392;
  border-radius: 5px;
  color: rgba(255,255,255,0.95);
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 20px;
  cursor: pointer;
  float: left;
  margin-right: 20px;
  padding: 0 15px;
}
.page-action-button:hover{
  background-color: #ff85ad;
}
.page-action-button i{
  margin-right: 10px;
  font-size: 24px;
}
.page-main-rate{
  height: 60px;
  font-size: 3em;
  color: #ffa726;
}
.page-main-rate span{
  margin-left: 10px;
  font-size: 0.2em;
  color: rgba(255,255,255,0.8)
}
.right-list{
  border-radius: 5px;
  overflow: hidden;
  margin-bottom: 15px;
}
.all-top-con{
  padding: 5px 15px;
}
.all-top-con-list{
  line-height: 30px;
}
.iframe-player{
    margin: 0 15px;
    margin-top: 15px;
    position: relative;
}
#iframe-player-con{
  width: 100%;
  height: 80vh;
  display:block;
}
.iframe-jiexi{
  position: absolute;
  top: 0;
  left: -60px;
  width: 60px;
  background-color: rgba(255,255,255,0.7);
  border-radius: 5px;
  overflow: hidden;
}
.iframe-jiexi-list{
  text-align:center;
  height: 35px;
  line-height: 35px;
  cursor: pointer;
}
.iframe-jiexi-list:hover,.iframe-jiexi-list.active{
  background-color: #00a1d6;
  color: white;
}
.foot-panel-show-list{
  background-color: <?php
  $general_options = get_option("ashuwp_general");
  echo $general_options['qinmei_base_color'];?>
}
</style>
<?php if (have_posts()) : the_post(); update_post_caches($posts);
setPostViews(get_the_ID());
?>

<div class="page-top">
  <div class="page-top-bg" >
    <div class="page-top-bg-rgb"></div>
    <div class="page-top-blurbg" style="background-image: url(<?php echo get_post_meta($post->ID,"baseinfo_img_link",true); ?>);"></div>
  </div>
  <div class="container page-con" );>
    <div class="page-main-img">
      <img src="<?php echo get_post_meta($post->ID,"baseinfo_img_link",true);?>" alt="">
    </div>
    <div class="page-main-content">
      <div class="page-main-con-top">
      <div class="page-main-title">
        <strong><?php the_title(); ?></strong>

        <?php $animatetags = wp_get_object_terms( $post->ID,  'animatetag' );
            $tagcount = 0;
            foreach ( $animatetags as $tag ) {
                $tagcount++;
                if($tagcount < 8){
                    echo '<span>'.$tag->name.'</span>';
                }
            }
        ?>
      </div>
      <div class="page-main-count">
        <div class="page-main-count-list">总播放<br/><span><?php if(get_post_meta($post->ID,"post_views_count",true)){
                        echo get_post_meta($post->ID,"post_views_count",true);
                      }else{ echo '0'; };?></span></div>
        <div class="page-main-count-line"></div>
        <div class="page-main-count-list">追番数<br/><span>100</span></div>
        <div class="page-main-count-line"></div>
        <div class="page-main-count-list">评论数<br/><span><?php $id=$post->ID; echo get_post($id)->comment_count;?></span></div>
        <div class="video-middle-con">
          <div class="page-main-rate">
            <?php echo get_post_meta($post->ID,"baseinfo_rate",true);?><span><?php echo get_post_meta($post->ID,"baseinfo_rate_num",true);?> 人评分</span>
          </div>
        </div>
      </div>
      <div class="page-main-playinfo">
        <span><?php echo get_post_meta($post->ID,"baseinfo_first_play",true);?> 开播</span>
        <span>全 <?php echo get_post_meta($post->ID,"baseinfo_episode_num",true);?> 话</span>
      </div>
      <div class="page-main-info">
        <span>简介：</span><?php echo get_post_meta($post->ID,"baseinfo_introduce",true);?>
      </div>
      </div>
      <div class="page-main-con-bottom">
        <div class="page-main-bottom-left">
          <div class="page-action-button">
              <i class="fa fa-heart" aria-hidden="true"></i>追番
          </div>
          <?php if(!empty(get_post_meta($post->ID,"baseinfo_download_link",true))){;?>
          <a href="<?php echo get_post_meta($post->ID,"baseinfo_download_link",true);?>"><div class="page-action-button" style="background-color: #8040BF">
              <i class="fa fa-cloud-download" aria-hidden="true"></i><?php echo get_post_meta($post->ID,"baseinfo_download_title",true);?>
          </div></a>
          <?php }?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="add-area" style="position: relative;width: 100%;">
<?php $html = $general_options['qinmei_ad_pc_13'];echo html_entity_decode($html, ENT_QUOTES);?>
</div>


<div class="container">
<?php $html = $general_options['qinmei_ad_pc_14'];echo html_entity_decode($html, ENT_QUOTES);?>
    <div class="page-main-foot-con">
      <div class="page-main-foot-nav">
          <div class="page-main-foot-nav-list active"><span>选集</span></div>
      </div>

      <div class="page-main-foot-panel">
        <div class="page-main-foot-panel-show">
          <?php $general_options = get_option('ashuwp_general');
          $count = 1;
              $meta_value = get_post_meta($post->ID,'baseinfo_episode_con',true);
              foreach($meta_value as $pagelist) { ?>
                <a href="<?php echo site_url().'/play?l='.$post->ID.'&n='.$count;?>"  class="page-change-link-btn">
                  <div class="foot-panel-show-list "><?php echo $pagelist["baseinfo_episode_sort"].' '?><?php echo $pagelist["baseinfo_episode_title"]?></div>
                </a>
            <?php $count++;}; ?>
          <div style="clear: both;"></div>
        </div>
      </div>
    </div>

<?php $html = $general_options['qinmei_ad_pc_15'];echo html_entity_decode($html, ENT_QUOTES);?>

        <div class="foot-comment-con">
      <div class="foot-comment-left">
        <div class="pc-discuss-con-nav">
          <div class="pc-discuss-nav-head">
            <div class="discuss-nav-list">评论区</div>
            <?php if(is_user_logged_in()): ?>
            <div class="pc-discuss-writting">发布评论</div>
            <?php else : ?>
            <a href="/login"><div class="pc-discuss-login">登录注册</div></a>
            <?php endif; ?>
          </div>
          <div class="pc-discuss-nav-main">
            <?php comment_form(
              array(
                'title_reply'=>'',
                'label_submit' => __( '发布评论' ),
                'fields' => array(
                'author' => '
                  <div class="page-comments-author">
                    <input id="author" name="author" type="text" value="" size="30" placeholder="昵称" aria-required="true" required="required" autocomplete="off" >
                  </div>',
                                            ),
                'class_form'=> 'comment-form form-horizontal ',
                'class_submit' => 'page-input-textarea',
                'comment_field' => '
                    <div class="page-comments-text">
                      <textarea id="comment" class="form-control-page" name="comment" rows="4" maxlength="65525"  placeholder="评论" aria-required="true" required="required"></textarea>
                    </div>')
              ); ?>
          </div>
        </div>
        <div class="pc-discuss-con-main">
          <div class="discuss-con-panel">
              <?php
              $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
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
              $comments = $comments_query->query( $args );

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
                        <div class="comments-foot">
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

                          <div class="comments-foot-list">
                            <a href="javascript:;" data-action="ding" data-id="<?php comment_ID(); ?>" class="pinglunZan <?php
                        if (isset($_COOKIE['pinglun_zan_' . $comment->comment_ID]))echo 'done';
                        ?>" style="color: rgba(0,0,0,0.5)"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><span class="count">
                                <?php
                        $comment_id = $comment->comment_ID;
                        if (get_comment_meta($comment_id, 'pinglun_zan', true)){echo get_comment_meta($comment_id, 'pinglun_zan', true);
                        }else {echo '0';
                        }?></span></a>
                          </div>

                          <div class="comments-foot-list comments-children-switch" nowid="<?php echo ($comment->comment_ID);?>">
                            <i class="fa fa-comment" aria-hidden="true"></i>
                            <span><?php echo count($children)?></span>
                          </div>

                      <div class="comments-foot-list">
                            <?php if ( current_user_can('level_10') ) {
                        $url = home_url();
                        echo '<span id="delete-'. $comment->comment_ID .'" data-url="' . wp_nonce_url("$url/wp-admin/comment.php?action=deletecomment&amp;p=" . $comment->comment_post_ID . '&amp;c=' . $comment->comment_ID, 'delete-comment_' . $comment->comment_ID) . '" style="margin-right:5px;">&nbsp;删除</span>';
                        } ?>
                          </div>
                        </div>


                    <div class="comments-children" id="<?php echo $comment->comment_ID;?>">
                      <div id="comments-children-<?php echo $comment->comment_ID;?>">
                      <div class="comments-children-header">
                        <strong><?php echo count($children)?></strong>条评论
                      </div>
                      <?php foreach ( $children as $child) { ?>
                        <div class="pc-comments-child-list">
                          <div class="comments-child-head">
                                <div class="comments-child-info">
                              <div class="comments-child-logo">
                                <?php echo get_avatar($child ->comment_author_email,28); ?>
                              </div>
                              <div class="comments-child-name">
                                <?php echo $child ->comment_author; ?>
                              </div>
                              <?php if(($comment->user_id) === ($child->user_id)){
                                  echo '<div class="comments-child-parent">楼主</div>';
                              }?>
                            </div>
                          </div>
                          <div class="pc-comments-child-content">
                            <?php echo convert_smilies($child->comment_content); ?>
                          </div>
                          <div class="comments-foot comments-child-foot">
                                <div class="comments-foot-list">
                                  <a href="javascript:;" data-action="ding" data-id="<?php comment_ID(); ?>" class="pinglunZan <?php
                            if (isset($_COOKIE['pinglun_zan_' . $child->comment_ID]))echo 'done';
                            ?>" style="color: rgba(0,0,0,0.5)"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><span class="count">
                                    <?php
                            $comment_id = $child->comment_ID;
                            if (get_comment_meta($comment_id, 'pinglun_zan', true)){echo get_comment_meta($comment_id, 'pinglun_zan', true);
                            }else {echo '0';
                            }?></span></a>
                                </div>

                                <div class="comments-foot-list comments-child-foot-reply">
                                  <i class="fa fa-reply" aria-hidden="true"></i>回复
                                </div>

                                <div class="comments-foot-list">
                                  <?php if ( current_user_can('level_10') ) {
                              $url = home_url();
                              echo '<span id="child-delete-'. $child->comment_ID .'" data-url="' . wp_nonce_url("$url/wp-admin/comment.php?action=deletecomment&amp;p=" . $child->comment_post_ID . '&amp;c=' . $child->comment_ID, 'delete-comment_' . $child->comment_ID) . '" style="margin-right:5px;">&nbsp;删除</span>';
                              } ?>
                                </div>



                              </div>
                        </div>
                      <?php };?>
                      <?php if(is_user_logged_in()): ?>

                      <div class="comments-children-footer">
                          <?php comment_form(
                          array(
                            'title_reply'=>'',
                            'label_submit' => __( '回复' ),
                            'fields' => array(
                            ),
                            'class_form'=> 'comment-form form-horizontal pc-discuss-comment-form',
                            'class_submit' => 'page-input-textarea pc-small-button',
                            'comment_field' => '
                                <div class="page-comments-text pc-discuss-location">
                                  <textarea id="comment" class="form-control-page" name="comment" rows="1" maxlength="65525"  placeholder="评论" aria-required="true" required="required"></textarea>
                                </div>')
                      ); ?>
                          </div>
                      <?php endif; ?>
                    </div>
                    </div>
                    <?php wp_reset_postdata(); ?>
                  </div>
                <?php }} else {echo '<div style="padding-left:15px">暂无评论</div>';}?>
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
      <div class="foot-comment-right">
       <div class="right-list">
          <div class="pc-discuss-con-nav">
            <div class="pc-discuss-nav-head">
              <div class="discuss-nav-list">制作人员</div>
              <div class="all-top-con">
                <?php $worker = get_post_meta($post->ID,"baseinfo_director",true);
                  $arr = explode("/", $worker);
                  foreach($arr as $arrlist){
                    echo "<div class='all-top-con-list'>".$arrlist."</div>";
                  }
                ?>
              </div>
            </div>
          </div>
        </div>

        <div class="right-list">
          <div class="pc-discuss-con-nav">
            <div class="pc-discuss-nav-head">
              <div class="discuss-nav-list">声优</div>
              <div class="all-top-con">
                <?php $worker2 = get_post_meta($post->ID,"baseinfo_actor",true);
                  $arr2 = explode("/", $worker2);
                  foreach($arr2 as $arrlist2){
                    echo "<div class='all-top-con-list'>".$arrlist2."</div>";
                  }
                ?>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
</div>


<?php else : ?>
<?php endif; ?>

<script>

$(function () {
  $(".pc-discuss-writting").click(function(){
    $(this).hide();
    $(".pc-discuss-nav-main").show();
  });
  $(document).on("click",".comments-children-switch", function() {
    if($(this).parent().next(".comments-children").is(":hidden")){
      $(".comments-children").fadeOut();
      var id = $(this).attr("nowid");
      $(this).parent().next(".comments-children").find("#comment_parent").val(id);
      $(this).parent().next(".comments-children").fadeIn();
      $(this).children('span').html("收起评论");
    }else{
      var text = $(this).parent().next(".comments-children").find(".comments-children-header strong").html();
      $(this).children('span').html(text);
      $(this).parent().next(".comments-children").fadeOut();
    }
  });
  $(document).on("click",".comments-child-foot-reply", function() {
    var author = $(this).parents(".pc-comments-child-list").find(".comments-child-name").html();
    author = "回复@" + author.trim() + " : ";
    var num = $(this).parents(".pc-comments-child-list");
    $('.form-control-page').each(function(){this.value=''});
    if( num.next().hasClass("comments-children-footer")){
      $(".children-reply-bar").remove();
      num.next().find("#comment").val(author);
      num.next().find("#comment").focus();
    }else{
      $(".children-reply-bar").remove();
      var reply = $(this).parents(".comments-children").find(".comments-children-footer").clone(true);
      reply.addClass("children-reply-bar");
      reply.find("#comment").val(author);
      $(this).parents('.pc-comments-child-list').after(reply);
      reply.find("#comment").focus();
    }
  });

  $(document).on("click","span[id^='child-delete-']", function() {
      var link = $(this).data('url');
      var thatlist = $(this).parents(".pc-comments-child-list");
       $.ajax({
              type:"GET",
              cache:false,
              url:link,
              success: function(data){
                  thatlist.remove();
              }
          });
    });
  $(document).on("click","span[id^='delete-']", function() {
      var link = $(this).data('url');
      var thatlist2 = $(this).parents(".pc-commments-list");
      console.log(thatlist2);
       $.ajax({
              type:"GET",
              cache:false,
              url:link,
              success: function(data){
                  thatlist2.remove();
              }
          });
  });
});



</script>
<?php get_footer(); ?>
