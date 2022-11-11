<?php
include "../connection/config.php";
extract($_REQUEST);

if(isset($_REQUEST['from_date'])){
    
   
    $from_xp = explode("/",$_REQUEST['from_date']);
    $to_xp = explode("/",$_REQUEST['to_date']);
    
    $from_date =  mktime(00, 00, 01, $from_xp[1], $from_xp[0], $from_xp[2]);
    $to_date =  mktime(23, 59, 59, $to_xp[1], $to_xp[0], $to_xp[2]);
    
    
} else {
    
    $from_date =  mktime(00, 00, 01, date('m'), date('d'), date('Y'));
    $to_date =  mktime(23, 59, 59, date('m'), date('d'), date('Y'));
    
}

$sx = query("SELECT * FROM `transactions` where user='$mobile' AND created_at > $from_date AND created_at < $to_date order by created_at desc");
while($x = fetch($sx))
{
    $x['date'] = date('d F Y H:i',$x['created_at']);
    $data['data'][] = $x;
}

echo json_encode($data);