<?php
include "../connection/config.php";
extract($_REQUEST);

if(rows(query("select sn from withdraw_details where user='$mobile'")) == 0){
    
    query("INSERT INTO `withdraw_details`(`user`, `prefered`, `upi`, `acno`, `name`, `ifsc`) VALUES ('$mobile','','$upi','$acno','$name','$ifsc')");

} else {
    
    query("update withdraw_details set acno='$acno', name='$name', ifsc='$ifsc', upi='$upi' where user='$mobile'");
    
}

$data['success'] = "1";
$data['msg'] = "Bank details updated";

echo json_encode($data);