$(function(){																					//啟用 jQ
var i = 0, got = -1, len = document.getElementsByTagName('script').length;//讀取網頁找 script 數量
while ( i <= len && got == -1){
	var js_url = document.getElementsByTagName('script')[i].src,		//判斷哪一個 script 是 comments-ajax.js
			got = js_url.indexOf('comments-ajax.js'); i++ ;							//找到 comments-ajax.js 文件路徑
}
var	ajax_php_url = js_url.replace('-ajax.js','-ajax.php'),				//將 -ajax.js 替換為 -ajax.php, 找到 comments-ajax.php 路徑
		wp_url = js_url.substr(0,js_url.indexOf('/wp-content/')),			//找到 WP 安裝路徑							//--------------- 以下是過程所用的 html 字段, 儘量不去動它.
		txt3 = '<div id="commentload">正在提交</div>',
		txt4 = '<div id="commenterror">提交错误</div>',
		txtb, num = 0, $new_comm;
				$('#submit').attr("disabled",false); 											//確定提交按鈕功能沒取消
				$('#submit').after( txt3 + txt4 );												//添加提交和錯誤提示, 在#comment 或 #submit 後添加, 視模板設計而定
				
$('#commentform').submit(function(){															//id='commentform' submit時的動作
				$('#submit').attr("disabled",true).fadeTo('slow', 0.2);		//防範再次按提交按鈕
				var text31 = $('#comment-show').val();

					if(player.currentTime() == 0){
	  				var playtime = Math.floor(player.currentTime() + 1);
	                }else{
	                  var playtime = Math.floor(player.currentTime());
	                };
	  				var text32 = playtime + ':'+text31;
					 $('#comment').val(text32);
  				
	$.ajax({																						//啟用 Ajax
				url: ajax_php_url,																				//comments-ajax.php 位址
				data: $('#commentform').serialize(),											//發送的數據 id='commentform'
				type: 'POST',																							//請求類型為 POST

		beforeSend: function(){																	//提交時的動作
				$('#commenterror').hide();																//隱藏:錯誤提示
				$('#commentload').slideDown();														//拉下顯示:正在提交
				},

		error: function(request){																//錯誤時的動作
				$('#commentload').slideUp();															//推上隱藏:正在提交
				$('#commenterror').show('slow').html(request.responseText);//顯示:錯誤提示
				setTimeout(function(){$('#submit').attr('disabled',false).fadeTo('slow', 1);$('#commenterror').slideUp();}, 3000);//恢復: 提交按鈕
				},

		success: function(data){
          		var randomNum = Math.floor(Math.random()*60) +'%'; 
          		var newData = '<div class = "danmuText" style="position:absolute;left:100%;top:'+randomNum+';">'+$('#comment-show').val()+'</div>';
         		$('.danmu-coner').append(newData);
          		
          		$('#comment-show').each(function(){this.value=''});	
				$('#comment').each(function(){this.value=''});						//清空: textarea 《使用 $('#comment').val(''); 也可以, 但有些模板不動作》
         var randomNum = Math.floor(Math.random()*100) +'%'; 
		 $('.danmuText').animate({right:'100%',left:'-10%'},15000,function(){
           $(this).remove();
         });	
          $('#commentload').hide();																	//隱藏:正在提交
		var t = addComment, cancel = t.I('cancel-comment-reply-link'),//評論框 & 取消回覆鏈接定義
				temp = t.I('wp-temp-form-div'), respond = t.I(t.respondId),//評論框的臨時節點定義
				post = t.I('comment_post_ID').value, parent = t.I('comment_parent').value,//傳回父層值
		 		num_text = num.toString();																//數字轉文字, 給編號
				
				new_htm = "<li><span style='color:green'>我:</span>" + $(data).html().split(':')[1] + "</li>";								//加:提交成功
				$('#comments ul li:nth-child(1)').before(new_htm);

		var $new_comm = $('#new_comm_' + num_text);										//定義新評論的 div
				$new_comm.append(data).fadeIn(4000);											//將新評論內容傳入$new_comm, 以淡入效果顯示新評論, (4000)表示4秒
				countdown();																							//(倒計時函式在最下面)
				num++ ;																										//編號累進, 目的是不讓 id 重覆

		cancel.style.display = 'none';																//隱藏:取消回覆	-------------- 評論框回底層
		cancel.onclick = null;																				//清空:回覆鏈接
		t.I('comment_parent').value = '0';														//回底層
if ( temp && respond ){																						//如果有節點和回覆框
		temp.parentNode.insertBefore(respond, temp);									//temp 節點前加評論框
		temp.parentNode.removeChild(temp)}														//刪除 temp 節點	------------------- end --
				}
			});																										//結束Ajax
  return false;																				//終止submit動作
	});

addComment = {																		//回覆時的動作, 以下參考 wp-includes\js\comment-reply.dev.js
	moveForm : function(commId, parentId, respondId, postId) {
		var t = this, div, comm = t.I(commId), respond = t.I(respondId), cancel = t.I('cancel-comment-reply-link'), parent = t.I('comment_parent'), post = t.I('comment_post_ID');

		$('#commenterror').hide();																		//隱藏:錯誤提示

		t.respondId = respondId;
		postId = postId || false;

		if ( ! t.I('wp-temp-form-div') ) {
			div = document.createElement('div');
			div.id = 'wp-temp-form-div';
			div.style.display = 'none';
			respond.parentNode.insertBefore(div, respond)
		}

		if ( post && postId && comm )
			comm.parentNode.insertBefore(respond, comm.nextSibling);
			post.value = postId;
			parent.value = parentId;
			cancel.style.display = '';

		cancel.onclick = function() {														//取消回覆時的動作
			var t = addComment, temp = t.I('wp-temp-form-div'), respond = t.I(t.respondId);

			$('#commenterror').hide();																	//隱藏:錯誤提示

			this.style.display = 'none';
			this.onclick = null;
			t.I('comment_parent').value = '0';
		if ( temp && respond ){
			temp.parentNode.insertBefore(respond, temp);
			temp.parentNode.removeChild(temp)}
			return false;
		};
		try { t.I('comment').focus(); }
		catch(e) {}
		return false;
	},
	I : function(e) {
		return document.getElementById(e)
	}
};		//結束addComment

var wait = 15, submit_val = $('#submit').val();										//時間設15秒, 暫存:按鈕上的字
function countdown(){																							//倒計時函式
	if ( wait == 0 ){																								//如果時間到
		$('#submit').val(submit_val).attr('disabled',false).fadeTo('slow', 1);//恢復:提交按鈕
		wait = 15;																										//重置時間
	} else {
		$('#submit').val(wait); wait--; setTimeout(countdown,1000);		//顯示:秒數, 秒數遞減, 1秒延遲
  }
};
})																										//結束jQuery