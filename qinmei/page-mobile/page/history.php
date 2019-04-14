<?php get_header(); ?>
<div class="col-md-12 margin-top">
		<div class="play-history-clearall">清除所有</div>
</div>

<div class="col-md-12 margin-top play-history-con"></div>
<style>
.play-history-clearall{
  	width:100px;
	padding:10px 20px;
  text-align:center;
  	background-color:#7B72E9;
  color:white;
  border-radius:5px;
}
.play-history-list{
  border:1px solid grey;
  height:56px;
  border-radius:5px;
  display:flex;
  align-items:center;
  justify-content:space-between;
  margin-bottom:10px;
}
.play-history-list-link{
	width: 100%;
  display:inline-block;
}
.play-history-con{
  cursor:pointer;
}
.play-history-list{
	color: black;
	display: flex;
	justify-content: space-between;
	align-items: center;
	padding: 0 10px;
}
</style>
<script>
$(function(){
    if(localStorage.record == undefined ){
      $('.play-history-con').append('<p style="text-align:center">暂无历史记录</p>');
    }else{
    var showHistory = JSON.parse(localStorage.record);
    var text1 = '<a class="play-history-list-link" href="';
    var text2 = '"><div class="play-history-list">';
		var text3 = '</div></a>';
		var span1 = '<span>';
		var span2 = '</span>';
    var node = '';
    for(var i =0;i<showHistory.length;i++){
      var s1 = showHistory[i][0];
      var s2 = showHistory[i][1];
			var s3 = showHistory[i][2];
			var s4 = showHistory[i][3];
      var textall = text1 + s1 + text2 + span1+s2+'第'+s3+'话'+span2+span1+s4+span2 + text3;
      node += textall;
    };
    $('.play-history-con').append(node);
	};
  $('.play-history-clearall').click(function(){
    localStorage.removeItem('record');
    $('.play-history-list').remove();
  });
});
</script>
<?php get_footer(); ?>
