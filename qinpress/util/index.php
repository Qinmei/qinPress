<?php
require get_template_directory() . '/util/phpQuery.php';

add_action( 'rest_api_init', function () {
	register_rest_route('wp/v2/', 'qinmei/getwebinfo', array(
		'methods' => 'POST',
		'callback' => 'aniamte_getinfo',
	));
});

function aniamte_getinfo($request = null) {

	$url = '';

	if(!empty($_POST['url'])){
	  $url = $_POST['url'];
	};

  return getbgm($url);

}


function getbgm($url){
    $url1 = 'https://bangumi.tv/subject/'.$url;
    $html     = phpQuery::newDocumentFile($url1);
    $hrefList = pq(".subject_tag_section .inner  a");
    $videotag = '';
    foreach ($hrefList as $href) {
       $videotag = $videotag.(pq($href)->find("span")->text()).',';
    }
    $videotag = substr($videotag,0,strlen($videotag)-1);
  
  	$url2 = request('https://api.bgm.tv/subject/'.$url.'?responseGroup=large',array('aaa'=>'aaa'));
	$data = json_decode($url2,true);
  	$data['tag'] = $videotag;
  	return $data;
  
}

function request($url,$posts)
{
      if(is_array($posts) && !empty($posts))
      {
            foreach($posts as $key=>$value)
            {
                $post[] = $key.'='.urlencode($value);
            }
            $posts = implode('&',$post);
       }

      $curl = curl_init();

      $options = array(
                     CURLOPT_URL=>$url,
                     CURLOPT_CONNECTTIMEOUT => 2,
                     CURLOPT_TIMEOUT => 10,
                     CURLOPT_RETURNTRANSFER => true,
                     CURLOPT_POST => 1,
                     CURLOPT_POSTFIELDS=>$posts,
                     CURLOPT_USERAGENT=>'Mozilla/5.0 (Windows NT 5.1; rv:5.0) Gecko/20100101 Firefox/5.0'
                    );

    curl_setopt_array($curl,$options);

    $retval = curl_exec($curl);

    return $retval;
}

?>