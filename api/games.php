<?php
include "../connection/config.php";
extract($_REQUEST);

if(isset($_REQUEST['date'])){
    
$sx = query("SELECT * FROM `games` where user='$mobile' AND date='".$_REQUEST['date']."' order by created_at desc");
} else {
    
$sx = query("SELECT * FROM `games` where user='$mobile' order by created_at desc");
}

while($x = fetch($sx))
{
    $x['date'] = date('d M Y',$x['created_at']);
    $data['data'][] = $x;
}

echo json_encode($data);