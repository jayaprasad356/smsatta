<?php include('config.php');
$date2 = $_REQUEST['date'];

$date = date('d/m/Y',strtotime($_REQUEST['date']));


$digit = $_REQUEST['digit'];
$panna = $_REQUEST['panna'];

$cdigit = $_REQUEST['cdigit'];
$cpanna = $_REQUEST['cpanna'];

$session = $_REQUEST['session'];
$market = $_REQUEST['market'];
$get_rates = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `rate`"));

if($session == 'open'){
  $mrk = str_replace(' ','_',$market.' OPEN');
  
  $qry = "SELECT * FROM games WHERE bazar='$mrk' AND (number='$digit' OR number='$panna') AND date='$date'";
  
} else {

  
  $chk_if_query = mysqli_query($con, "select * from manual_market_results where market='$market' AND date='$date'");
  $chk_if_updated = mysqli_fetch_array($chk_if_query);

  $open = $chk_if_updated['open'];
  $opanna = $chk_if_updated['open_panna'];

  $mrk = str_replace(' ','_',$market.' CLOSE');
  $mrk2 = str_replace(' ','_',$market.'');
  
  $jodi = $open.$digit;
  
  $half1 = $opanna.'-'.$digit;
  $half2 = $panna.'-'.$open;
  
  $full = $opanna.'-'.$panna;
  
  $qry = "SELECT * FROM games WHERE (bazar='$mrk' OR bazar='$mrk2') AND (number='$cdigit' OR number='$cpanna' OR number='$jodi' OR number='$half1' OR number='$half2' OR number='$full') AND date='$date'";
  
}

?>
<style>
  .spanblock {
   background: #e9e9e9;
    border-radius: 5px;
    padding: 10px 18px;
    margin-right: 10px; 
  }
  
</style>
 <div class="card-header">
                <h3 class="card-title" style="padding: 10px;">
                  <span class="spanblock">Total Bid Amount:<b id='totalBid'></b></span>
                  <span class="spanblock">Total Winning Amount:<b id='totalWin'></b></span>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                     <th>#</th>
                    <th>User Name</th>
                    <th>Bid Points</th>
                    <th>Winning Points</th>
                    <th>Market Name</th>
                    <th>Game Name</th>
                    <th>Bid number</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody id="tbody">
<?php
                        $winning = mysqli_query($con, $qry);
                        $i = 1;
                    $total_bid = 0;
                    $total_win = 0;
                    
                        while($row = mysqli_fetch_array($winning)){
                            $userID = $row['user'];
                            $user = mysqli_query($con, "SELECT * FROM `users` WHERE `mobile`='$userID' ");
                            $fetch = mysqli_fetch_array($user);
                          $total_bid = $total_bid+$row['amount'];   
                          $total_win = $total_win+$get_rates[$row['game']]*$row['amount'];          
                    ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $fetch['name']; ?></td>
                                <td><?php echo $row['amount']; ?></td>
                                <td><?php echo $get_rates[$row['game']]*$row['amount']; ?></td>
                                <td><?php echo $row['bazar']; ?></td>
                                <td><?php echo $row['game']; ?></td>
                                <td><?php echo $row['number']; ?></td>
                                <td><?php echo date('h:i A d-m-Y',$row['created_at']); ?></td>
                            </tr>
                    <?php
                            $i++;
                        }
                    ?>
                    <script>
                      $("#totalBid").html('<?php echo $total_bid; ?>');
                      $("#totalWin").html('<?php echo $total_win; ?>');
                    </script>
                     </tbody>
                </table>
              </div>