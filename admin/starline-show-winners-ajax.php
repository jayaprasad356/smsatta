<?php
     $date = date('d/m/Y',strtotime($_REQUEST['date']));
     $gameID = explode("_",$_REQUEST['gameID']);
     $market = $gameID[1];
     $timing = $gameID[2];
    $digit = $_REQUEST['digit'];
    $panna = $_REQUEST['panna'];

    include('config.php');
    
        $select = mysqli_query($con, "SELECT * FROM `starline_games` WHERE `date`= '$date' AND `bazar`='$market' AND timing_sn='$timing' AND (number='$digit' OR number='$panna') ");  
         //  echo "SELECT * FROM `starline_games` WHERE `date`= '$date' AND `bazar`='$market' AND timing_sn='$timing' AND (number='$digit' OR number='$panna') ";

    
    $i = 1;
    while($row = mysqli_fetch_array($select)){
        // user data
        $userID = $row['user'];
        $user = mysqli_query($con, "SELECT * FROM `users` WHERE `mobile`='$userID' ");
        $fetch = mysqli_fetch_array($user);
        
?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php if($fetch['name'] != ''){ echo $fetch['name'];}else{ echo 'N/A'; } ?></td>
        <td><?php if($row['amount'] != ''){echo $row['amount'];}else{ echo 'N/A'; } ?></td>
        <td><?php if($row['amount'] != ''){echo $row['amount'];}else{ echo 'N/A'; } ?></td>
        <td><?php if($row['bazar'] != ''){echo $row['bazar'].' '.$row['timing_sn'];}else{ echo 'N/A'; } ?></td>
        <td style="text-transform: capitalize;"><?php if($row['game'] != ''){echo $row['game'];}else{ echo 'N/A'; } ?></td>
        <td><?php if($row['number'] != ''){echo $row['number'];}else{ echo 'N/A'; } ?></td>
                                <td><?php echo date('h:i A d-m-Y',$row['created_at']); ?></td>
      
      
    </tr>    
    

<?php
$i++;
    }
?>