<?php
include "../connection/config.php";
extract($_REQUEST);
$date = date('d/m/Y');

$check = query("select wallet from users where mobile='$mobile' AND wallet < '$total'");

if(rows($check) == 0)
{

    query("update users set wallet=wallet-'$total' where mobile='$mobile'");
    
    query("INSERT INTO `games`(`user`, `game`, `bazar`, `date`, `number`, `amount`, `created_at`) VALUES ('$mobile','$game','$bazar','$date','$number','$amount','$stamp')");
    
    $data['success'] = "1";

}
else
{
    $data['success'] = "0";
    $data['msg'] = "You don't have enough wallet balance";
}

echo json_encode($data);