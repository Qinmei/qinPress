<?php
require("phpQuery.php");
header("Content-Type:text/html;charset=utf8"); 
header('Access-Control-Allow-Methods:POST');// 响应类型  
header('Access-Control-Allow-Headers:*'); // 响应头设置 
header("Access-Control-Allow-Origin:*");
  
$allow=array(
  'https://qinmei.org',
  'http://api.opacg.com',
  'https://api.zhaicy.com',
  'https://anime.zhaicy.com',
  'https://m.zhaicy.com',
  'http://www.opacg.com',
  'http://m.opacg.com',
  'https://qinmei.video',
  'https://m.qinmei.video',
  'https://qinvz.cn'
);
  
$origin = isset($_SERVER['HTTP_ORIGIN'])? $_SERVER['HTTP_ORIGIN'] : '';
if (in_array($origin, $allow)) {
$url = '';
$type = '';
$code = '';
$year = '';
$month = '';
$kind = '';
if(!empty($_POST['url'])){
  $url = $_POST['url'];
};

if(!empty($_POST['type'])){
  $type=$_POST['type'];
}
  
if(!empty($_POST['kind'])){
  $kind = $_POST['kind'];
}

if(!empty($_POST['code'])){
   $code = $_POST['code']; 
}
  
if(!empty($_POST['year'])){
   $year = $_POST['year']; 
}
if(!empty($_POST['month'])){
    $month = sprintf("%02d",$_POST['month'] );
}

  if($kind == 'index'){
    getindex($type,$url);
  }else if($kind == 'new'){
    getnew($code,$year,$month);
  }else if($kind == 'validate'){
    echo '';
  }

}else{
  echo 'console.log("hello")';
}

function getindex($type,$url){
  switch($type){
    case 'dilidili':
          getdilidili($url);
          break;
      case 'qq':
          getqq($url);
          break;
      case 'iqiyi':
          getiqiyi($url);
          break;
      case 'bilibili':
          getbilibili($url);
          break;
      case 'letv':
          getletv($url);
          break;
      case 'pptv':
          getpptv($url);
          break;
      case 'bgm':
          getbgm($url);
          break;
      default:
          echo "参数错误";
  }

}

function getnew($code,$year,$month){
  switch($code){
    case 'qinmei2021':
      getjson($year,$month);
      break;
    default:
      echo "参数错误";
  }
}

function getdilidili($url){
    $html     = phpQuery::newDocumentFile($url);
    $hrefList = pq("(div[class='time_con']:eq(0) a)");

    $video = array();

    foreach ($hrefList as $href) {
        $hreflink = $href->getAttribute("href");
        $hrefhtml   = phpQuery::newDocumentFile($hreflink);
        $hreftitle =   pq("(div[id='link'] h2)",$hrefhtml)->contents()->not("a")->text();
        $videotitle = substr($hreftitle,6,strlen($hreftitle));
        $hrefplay =   pq("#player_iframe",$hrefhtml)->attr("src");'<br>';
        $videolink = 'http'.explode("=http",$hrefplay)[1];
        
        $video[] = array('title'=> $videotitle,'link' => $videolink);
    }
    
    //以json格式返回html页面
    echo urldecode(json_encode($video));
}

function getqq($url){
	$html     = phpQuery::newDocumentFile($url);
    $hrefList = pq("(div[class='mod_episode'] a)");

    $video = array();
    foreach ($hrefList as $href) {
        $hreflink = $href->getAttribute("href");
        $hreftitle =  pq($href)->find("span[itemprop='episodeNumber']")->text();
        $video[] = array('title'=> $hreftitle,'link' => $hreflink);
    }
    
    //以json格式返回html页面
    echo urldecode(json_encode($video));
}

function getiqiyi($url){
  	$html     = phpQuery::newDocumentFile($url);
    $hrefList = pq(".site-piclist:eq(0) li");
    $video = array();
    foreach ($hrefList as $href) {
        $hreflink = pq($href)->find('.site-piclist_info_describe a')->attr('href');
        $hreftitle =  trim(pq($href)->find('.site-piclist_info_describe a')->text());
      	$hreftitle0 = trim(pq($href)->find('.site-piclist_info_title a')->text());
        $video[] = array('title'=> $hreftitle0.$hreftitle,'link' => $hreflink);
    }
    
    echo urldecode(json_encode($video));
}

function getbilibili($url){
  	$showdata=file_get_contents($url);
    preg_match('#"episodes"([\s\S]*?)"evaluate"#',$showdata,$match);
    $data1 = $match[0];
    $data2 = substr($data1,11);
    $data3 = trim(substr($data2,0,strlen($data2)-11));
    $data4 =  json_decode($data3,true);

    $video = array();
      foreach ($data4 as $href) {
          $hreflink = 'https://www.bilibili.com/video/av'.$href['aid'].'/';
          $hreftitle =  $href['index_title'];
          $video[] = array('title'=> $hreftitle,'link' => $hreflink);
      }

    echo urldecode(json_encode($video));
}

function getletv($url){
  	$html     = phpQuery::newDocumentFile($url);
    $hrefList = pq("#first_videolist .show_cnt  .col_4");
    $video = array();
    foreach ($hrefList as $href) {
        $hreflink = pq($href)->find('.d_tit a')->attr('href');
        $hreftitle =  trim(pq($href)->find('.d_tit a')->attr('title'));
        $video[] = array('title'=> $hreftitle,'link' => $hreflink);
    }
    
    echo urldecode(json_encode($video));
}

function getpptv($url){
  	$showdata=file_get_contents($url);
    preg_match('#"now":0,"dlist":([\s\S]*?)}]}},{"id"#',$showdata,$match);
	$data1 = $match[0];
	$data2 = substr($data1,16);
	$data3 = trim(substr($data2,0,strlen($data2)-8));
	echo $data3;
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
  	echo json_encode($data,320);
  
}


function getjson($year,$month){
  $index = 'bangumi-data/data/items/'.$year.'/'.$month.'.json';
  $indexnum = $year.$month.'000';
  $data= file_get_contents($index); 
  $animate = array(
    "num" => $indexnum,
    "qinmei2021"=> json_decode($data)
    );
  echo urldecode(json_encode($animate));
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