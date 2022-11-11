<?php 
     $date = date('d/m/Y',strtotime($_POST['date']));
    $gameID = $_POST['gameID'];
    
    include('config.php');
    
    
     
    $market = str_replace(" ","_",$gameID);
    $market_1 = str_replace(" ","_",$gameID.' OPEN');
    $market_2 = str_replace(" ","_",$gameID.' CLOSE');
    
    $select = mysqli_query($con, "SELECT * FROM `games` WHERE `date`='$date' AND (`bazar`='$market' OR `bazar`='$market_1' OR `bazar`='$market_2' ) ");
    
    $i = 1;
    
    while($row = mysqli_fetch_array($select)){
        $userID = $row['user'];
        $users = mysqli_query($con, "SELECT * FROM `users` WHERE `mobile`='$userID' ");
        $userFetch = mysqli_fetch_array($users);
        

?>

<tr>
    <td><?php echo $i; ?></td>
    <td><?php echo $userFetch['name']; ?></td>
    <td><?php echo $userFetch['mobile']; ?></td>
    <td><?php echo $row['amount']; ?></td>
    <td><?php echo $row['number']; ?></td>
</tr>

<?php
$i++;
}
?>