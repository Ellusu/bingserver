<?php
    $search = $_POST['search'];
    $limit = $_POST['limit'];
    if($_POST['key']!=='{TOKEN}') die('TOKEN FAIL');
    
    $i=0;
    $url="http://www.bing.com/images/search?pq=".urlencode(strtolower($search))."&count=50&q=".urlencode($search).'&qft=+filterui:licenseType-Any&FORM=R5IR40';
    $data=file_get_contents($url);
    $rr=explode("<div class=\"item\">", $data);
    $execc="";
    unset($rr[0]);
    foreach ($rr as $elem) {
        if($i>=$limit) continue;
        $one = explode('src="',$elem);
        $two = explode('"',$one[1]);
        $img = $two[0];
        $one = explode('href="',$one[1]);
        $two = explode('"',$one[1]);
        $array[] = array(
            'thumbnail_src'=> $img,
            'link'=>$two[0]
        );
        $i++;
    }
    echo json_encode($array);
    
?>
