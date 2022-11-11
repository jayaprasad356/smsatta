<?php
include "../connection/config.php";
extract($_REQUEST);

require_once "../scrap/data/support/web_browser.php";
require_once "../scrap/data/support/tag_filter.php";

$htmloptions = TagFilter::GetHTMLOptions();

	$get_provider = fetch(query("select data from settings where data_key='provider'"));
	if($get_provider['data'] == "dpboss"){
	    
	    
	   $url = "https://dpboss.net/";
	 
    	} else {
    	
    	   
    $url = "https://spboss.net/index.php";
    	
    	}
    	
$web = new WebBrowser();
$result = $web->Process($url);

if (!$result["success"])
{
	echo "Error retrieving URL.  " . $result["error"] . "\n";
	exit();
}

if ($result["response"]["code"] != 200)
{
	echo "Error retrieving URL.  Server returned:  " . $result["response"]["code"] . " " . $result["response"]["meaning"] . "\n";
	exit();
}

$baseurl = $result["url"];

$html = TagFilter::Explode($result["body"], $htmloptions);

$root = $html->Get();

$rows = $root->Find("a[href]");

foreach ($rows as $row)
{
    $temp_h4[$row->href] = $row->GetInnerHTML();
    $temp[] = $row->href;
}

$get = query("select * from gametime_new");
while($xc = fetch($get))
{
    
    
    $check_ar = preg_grep('/^'.strtolower($xc['market']).'.*/', array_map('strtolower',$temp_h4));
    if(count($check_ar) > 0)
    {
      //  $time = array_search($xc['market'], $temp_h4);
      
      $keys = array_keys($check_ar);
        
        for($i = 0; $i < count($check_ar); $i++){
            $rr = $check_ar[$i];
            
            $chts['market'] = $check_ar[$keys[$i]];
            $chts['result'] = $keys[$i];
            
            $data['data'][] = $chts;
        }
      
    }
	
}


$get = query("select * from gametime_manual");
while($xc = fetch($get))
{
    
    
   $chts['market'] = $xc['market'];
    $chts['result'] = "manual://getChart.php?market=".$xc['market'];
            
            $data['data'][] = $chts;
	
}







echo json_encode($data);
