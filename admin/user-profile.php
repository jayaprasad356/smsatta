<?php include('header.php'); 

$user_id = $_GET['userID'];
$select = mysqli_query($con, "SELECT * FROM `users` WHERE `mobile`='$user_id' ");
$row = mysqli_fetch_array($select);
?>

<style>
    .user-img{
        margin-left: auto;
        margin-right: auto;
    }
    .personalInfo > tbody > tr > th {
        font-weight:bold;
    }
    
    .paymentInfo > tbody > tr > th {
        font-weight:bold;
    }
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                    <!-- <button class="btn btn-primary">Un-approved Users List</button> -->
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title m-b-0 text-center">USER DETAILS</h4>
                                <hr>
                                <!--<div class="row bg-dark">-->
                                <!--    <img src="dist/img/user3-128x128.jpg" alt="user" width="80" class="rounded-circle user-img">-->
                                <!--</div>-->
                            </div>
                            <div class="comment-widgets scrollable">
                                <!-- Comment Row -->
                                
                                <div class="d-flex flex-row">
                                    <table class="table">
                                        <tr>
                                            <th>User Status</th>
                                            <td class="text-center">
                                                <?php
                                                    if($row['active'] == 0){
                                                ?>
                                                    <a href="user-profile.php?UserActive=<?php echo $row['mobile']; ?>"><span class="badge badge-danger">No</span></a>
                                                <?php
                                                    }else{
                                                ?>
                                                    <a href="user-profile.php?UserDeactive=<?php echo $row['mobile']; ?>"><span class="badge badge-success">Yes</span></a>
                                                <?php
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr >
                                            <th>Betting Status</th>
                                            <td class="text-center">
                                                <?php
                                                    if($row['verify'] == 0){
                                                ?>
                                                <a href="user-profile.php?BettingActive=<?php echo $row['mobile']; ?>"><span class="badge badge-danger">No</span></a>
                                                <?php
                                                    }else{
                                                ?>
                                                <a href="user-profile.php?BettingDeactive=<?php echo $row['mobile']; ?>"><span class="badge badge-success">Yes</span></a>
                                                <?php
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        
                                    </table>
                                </div>
                                <div class=" text-center">
                                        <h2 style="color:#999">Wallet Balance</h2>
                                        <h3>
                                            <?php
                                                
                                                echo $row['wallet']
                                            ?>
                                            <b style="color:green; font-size:15px;">Points</b>
                                        </h3>
                                        
                                        <div class="comment-footer">
                                            <a href="#addPoint" data-toggle="modal" class="btn btn-success btn-md">Add Points</a>
                                            <a href="#withdrowPoints" data-toggle="modal" class="btn btn-danger btn-md">Withdraw Points</a>
                                        </div>
                                </div>
                                
                            </div>
                        </div>
                        <?php
                            // Active Betting Status
                                                if(isset($_GET['BettingActive'])){
                                                    $id = $_GET['BettingActive'];
                                                    $registrationDate = date("Y-m-d H:i:s");
                                                    
                                                    $updateUser = mysqli_query($con, "UPDATE `users` SET `verify`='1' WHERE `mobile`='$id' AND `verify`='0'");
                                                    if($updateUser){
                                                        echo "<script>window.location.href='user-manage.php';</script>";
                                                    }
                                                    
                                                }
                                                
                                                // Deactive Betting Status
                                                if(isset($_GET['BettingDeactive'])){
                                                    $id = $_GET['BettingDeactive'];
                                                    $registrationDate = date("Y-m-d H:i:s");
                                                    
                                                    $updateUser = mysqli_query($con, "UPDATE `users` SET `verify`='0' WHERE `mobile`='$id' AND `verify`='1'");
                                                    if($updateUser){
                                                        echo "<script>window.location.href='user-manage.php';</script>";
                                                    }
                                                    
                                                }
                                                
                                                
                                                // Active User Status
                                                if(isset($_GET['UserActive'])){
                                                    $id = $_GET['UserActive'];
                                                    $registrationDate = date("Y-m-d H:i:s");
                                                    
                                                    $updateUser = mysqli_query($con, "UPDATE `users` SET `active`='1'  WHERE `mobile`='$id' AND `active`='0'");
                                                    if($updateUser){
                                                        echo "<script>window.location.href='user-manage.php';</script>";
                                                    }
                                                    
                                                }
                                                
                                                // Deactive User Status
                                                if(isset($_GET['UserDeactive'])){
                                                    $id = $_GET['UserDeactive'];
                                                    $registrationDate = date("Y-m-d H:i:s");
                                                    
                                                    $updateUser = mysqli_query($con, "UPDATE `users` SET `active`='0' WHERE `mobile`='$id' AND `active`='1'");
                                                    if($updateUser){
                                                        echo "<script>window.location.href='user-manage.php';</script>";
                                                    }
                                                    
                                                }
                        ?>
                        
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title m-b-0">Personal Information</h5>
                            </div>
                            <table class="table personalInfo">
                                <tbody>
                                    <tr>
                                        <th>Full Name</th>
                                        <td><?php echo $row['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?php echo $row['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Mobile Number</th>
                                        <td><?php echo $row['mobile']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Password</th>
                                        <td><?php echo $row['password']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Registration Date</th>
                                        <td><?php echo date('d-m-Y',$row['created_at']); ?></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                            <div class="text-center mb-4 mt-4">
                                <div class="comment-footer pt-3">
                                    <a href="https://api.whatsapp.com/send?phone=91<?php echo $row['mobile']; ?>" target="_blank" class="btn btn-success btn-md">WhatsApp</a>
                                    <a href="tel:+91 <?php echo $row['mobile']; ?>" target="_blank" class="btn btn-danger btn-md">Call</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!--Payment Information-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title m-b-0">Payment Information</h5>
                            </div>
                            <table class="table paymentInfo">
                                <?php
                                    $bank_details = mysqli_query($con, "SELECT * FROM `withdraw_details` WHERE `user`='$user_id'");
                                    $bank = mysqli_fetch_array($bank_details);
                                    
                                ?>
                                <tbody>
                                    <tr>
                                        <th>Account Holder Name</th>
                                        <td><?php echo $bank['name']; ?></td>
                                        <th>Account Number</th>
                                        <td><?php echo $bank['acno']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>IFSC Code</th>
                                        <td><?php echo $bank['ifsc']; ?></td>
                                        
                                      
                                    </tr>
                                    <tr>
                                        <th>UPI</th>
                                        <td><?php echo $bank['upi']; ?></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                

                <!--Withdwaw Points Request-->
                <div class='row'>
                    <div class="card w-100">
                        <div class="card-body">
                            <h5 class="card-title m-b-0">Withdwaw Points Requests</h5>
                            <hr>
                            <div class="table-responsive">
                                    <table id="withdraw_table" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Points</th>
                                                <th>Request No.</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>View</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $select = mysqli_query($con, "SELECT * FROM `withdraw_requests` where user='$user_id' ORDER BY sn DESC");
                                                $i = 1;
                                                while($row1 = mysqli_fetch_array($select)){
                                                    
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                
                                                <td><?php echo $row1['amount']; ?></td>
                                                <td><?php echo $row1['sn']; ?></td>
                                                <td><?php echo date('d-m-Y',$row1['created_at']); ?></td>
                                                <td>
                                                    <?php
                                                        if($row1['status'] == 1){
                                                          echo "<span class='badge badge-success'>Accepted</span>";  
                                                        }elseif($row1['status'] == 0){
                                                            echo "<span class='badge badge-warning'>Pending</span>"; 
                                                        }else{
                                                            echo "<span class='badge badge-danger'>Rejected</span>";    
                                                        }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="#ViewRequest<?php echo $i; ?>" data-toggle="modal" style="font-size:20px;"><i class="fas fa-eye"></i></a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="#RequestApproved<?php echo $i; ?>" data-toggle="modal" class="btn btn-success">Approved</a>
                                                    <a href="#RequestRejected<?php echo $i; ?>" data-toggle="modal" class="btn btn-danger">Rejected</a>
                                                </td>
                                            </tr>
                                            
                                            
                                            <!--View Withdraw Request-->
                                            <div class="modal fade" id="ViewRequest<?php echo $i; ?>">
                                                <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Withdraw Request Details</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-sm-3 border"><b>User Name</b></div>
                                                            <div class="col-sm-3 border">
                                                                <?php echo $row['name']; ?> </a>
                                                            </div>
                                                            <div class="col-sm-3 border"><b>Request Points</b></div>
                                                            <div class="col-sm-3 border"><?php echo $row1['amount']; ?></div>
                                                            <div class="col-sm-3 border"><b>Request Number</b></div>
                                                            <div class="col-sm-3 border">#<?php echo $row1['sn']; ?></div>
                                                            <div class="col-sm-3 border"><b>Payment Method</b></div>
                                                            <div class="col-sm-3 border"><span class="badge badge-success"><?php echo $row1['mode']; ?></span></div>
                                                            <div class="col-sm-3 border"><b>Request Date</b></div>
                                                            <div class="col-sm-3 border"><?php echo date('d-m-Y',$row1['created_at']); ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                          
                                            <!--Request Rejected-->
                                            <div class="modal fade" id="RequestRejected<?php echo $i; ?>">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                  
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                      <h4 class="modal-title">Request Approved</h4>
                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <form method="post" autocomplete="off" enctype="multipart/form-data">
                                                            <input type="hidden" name="id" value="<?php echo $row1['sn']; ?>" required/>
                                                            <input type="hidden" name="txn_id" value="<?php echo $row1['sn']; ?>" required/>
                                                          
                                                            
                                                            <div class="form-group">
                                                                <!-- Modal footer -->
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-success" type="submit" name="requestRejected">Rejected</button>
                                                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            
                                            
                                            <!--Request Approved-->
                                            <div class="modal fade" id="RequestApproved<?php echo $i; ?>">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                  
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                      <h4 class="modal-title">Request Approved</h4>
                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    
                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <form method="post" autocomplete="off" enctype="multipart/form-data">
                                                            <input type="hidden" name="id" value="<?php echo $row1['sn']; ?>" required/>
                                                          
                                                            
                                                            <div class="form-group">
                                                                <!-- Modal footer -->
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-success" type="submit" name="requestApproved">Approved</button>
                                                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            <?php
                                                $i++;
                                                }
                                            ?>
                                            
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <!--Bid History-->
                <!--<div class='row'>-->
                <!--    <div class="card w-100">-->
                <!--        <div class="card-body">-->
                <!--            <h5 class="card-title m-b-0">Bid History</h5>-->
                <!--            <hr>-->
                <!--            <div class="table-responsive">-->
                <!--                <table id="withdraw_table" class="table table-striped table-bordered">-->
                <!--                        <thead>-->
                <!--                            <tr>-->
                <!--                                <th>S. No.</th>-->
                <!--                                <th>Game Name</th>-->
                <!--                                <th>Game Type</th>-->
                <!--                                <th>Session</th>-->
                <!--                                <th>Digits</th>-->
                <!--                                <th>Close Digits</th>-->
                <!--                                <th>Points</th>-->
                <!--                                <th>Date</th>-->
                <!--                            </tr>-->
                <!--                        </thead>-->
                <!--                        <tbody>-->
                                        
                <!--                            <tr>-->
                <!--                                <td></td>-->
                <!--                                <td></td>-->
                <!--                                <td></td>-->
                <!--                                <td></td>-->
                <!--                                <td></td>-->
                <!--                                <td></td>-->
                <!--                                <td></td>-->
                <!--                                <td class="text-center"></td>-->
                <!--                            </tr>-->
                                            
                <!--                        </tbody>-->
                <!--                    </table>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                
                <!--Wallet Transation History-->
                <div class="row">
                    <div class="card w-100">
                            <div class="card-body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#walletAll" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">All</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#walletCredit" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Credit</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#walletDebit" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Debit</span></a> </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                    <div class="tab-pane active" id="walletAll" role="tabpanel">
                                        <table id="walletAllTable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>S. No.</th>
                                                    <th>Points</th>
                                                    <th>Transaction Note</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $allWallet = mysqli_query($con, "SELECT * FROM `transactions` WHERE `user`='$user_id' ORDER BY sn DESC");
                                                    $i = 1;
                                                    while($row = mysqli_fetch_array($allWallet)){
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td>
                                                        <?php 
                                                            if($row['type'] == '1'){
                                                                echo "<span class='badge badge-success'> +".$row['amount']."</span>";
                                                            }else{
                                                                echo "<span class='badge badge-danger'>-".$row['amount']."</span>";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $row['remark']; ?></td>
                                                    <td><?php echo date('h:i A d-m-Y',$row['created_at']); ?></td>
                                                </tr>
                                                <?php
                                                    $i++;
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane  p-20" id="walletCredit" role="tabpanel">
                                        <table id="walletCreditTable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>S. No.</th>
                                                    <th>Points</th>
                                                    <th>Transaction Note</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $allWallet = mysqli_query($con, "SELECT * FROM `transactions` WHERE `user`='$user_id' AND `type`='1' ORDER BY sn DESC");
                                                    $i = 1;
                                                    while($row = mysqli_fetch_array($allWallet)){
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td>
                                                        <?php 
                                                            if($row['type'] == '1'){
                                                                echo "<span class='badge badge-success'> +".$row['amount']."</span>";
                                                            }else{
                                                                echo "<span class='badge badge-danger'>-".$row['amount']."</span>";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $row['remark']; ?></td>
                                                    <td><?php echo date('h:i A d-m-Y',$row['created_at']); ?></td>
                                                </tr>
                                                <?php
                                                    $i++;
                                                    }
                                                ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane p-20" id="walletDebit" role="tabpanel">
                                        <table id="walletDebitTable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>S. No.</th>
                                                    <th>Points</th>
                                                    <th>Transaction Note</th>
                                                    <th>Date</th>
                                                    <th>TXN ID</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $allWallet = mysqli_query($con, "SELECT * FROM `transactions` WHERE `user`='$user_id' AND `type`='0' ORDER BY sn DESC");
                                                    $i = 1;
                                                    while($row = mysqli_fetch_array($allWallet)){
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td>
                                                        <?php 
                                                            if($row['type'] == '1'){
                                                                echo "<span class='badge badge-success'> +".$row['amount']."</span>";
                                                            }else{
                                                                echo "<span class='badge badge-danger'>-".$row['amount']."</span>";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $row['remark']; ?></td>
                                                    <td><?php echo date('h:i A d-m-Y',$row['created_at']); ?></td>
                                                </tr>
                                                <?php
                                                    $i++;
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

<!--Withdrawal Points-->
<div class="modal fade" id="withdrowPoints">
        <div class="modal-dialog">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Withdraw Points</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" autocomplete="off">
                    <div class="form-group">
                        <label>Withdraw Points</label>
                        <input type="number" name="pointsWithdwaw" value="" class="form-control" placeholder="Enter Points Here" required/>
                    </div>
                    
                    <div class="form-group">
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button class="btn btn-success" type="submit" name="WithdwawPoints">Submit</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
                <?php
                    if(isset($_POST['WithdwawPoints'])){
                        $pointsAdd = $_POST['pointsWithdwaw'];
                        $createDate = date("Y-m-d H:i:s");
                        $dateString = date('Ymd');
                        $fourRandomDigit = rand(1000,9999);
                        $TXN = 'TXN'.$dateString.$fourRandomDigit;
                        
                        $stamp = time();
                        
                        $walletAdd = mysqli_query($con,"update users set wallet=wallet-'$pointsAdd' where mobile='$user_id'");
                        mysqli_query($con,"INSERT INTO `transactions`(`user`, `amount`, `type`, `remark`, `created_at`,`owner`) VALUES ('$user_id','$pointsAdd','0','Points Withdraw By Admin','$stamp','admin@gmail.com')");
         
                        
                        // $walletAdd = mysqli_query($con, "INSERT INTO `wallet`(`user_id`, `balance`, `operator`, `transactionID`, `description`, `created_at`) 
                        //                                     VALUES ('$user_id','$pointsAdd','-','$TXN', 'Points Withdraw By Admin', '$createDate')");
            
                            if($walletAdd){
                                echo "<script>window.location.href= '';</script>";
                            }
                    }
                ?>
            </div>
          </div>
        </div>
      </div>

<!--Add Points-->
    <div class="modal fade" id="addPoint">
        <div class="modal-dialog">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Add Points</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" autocomplete="off">
                    <div class="form-group">
                        <label>Add Points</label>
                        <input type="number" name="pointsAdd" value="" class="form-control" placeholder="Enter Points Here" required />
                    </div>
                    
                    <div class="form-group">
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button class="btn btn-success" type="submit" name="AddPoints">Submit</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
                <?php
                    if(isset($_POST['AddPoints'])){
                        $pointsAdd = $_POST['pointsAdd'];
                        $createDate = date("Y-m-d H:i:s");
                        $dateString = date('Ymd');
                        $fourRandomDigit = rand(1000,9999);
                        $TXN = 'TXN'.$dateString.$fourRandomDigit;
                        
                        
                        $stamp = time();
                        
                       $walletAdd = mysqli_query($con,"update users set wallet=wallet+'$pointsAdd' where mobile='$user_id'");
                        mysqli_query($con,"INSERT INTO `transactions`(`user`, `amount`, `type`, `remark`, `created_at`,`owner`) VALUES ('$user_id','$pointsAdd','1','Points Added By Admin','$stamp','admin@gmail.com')");
         
                        
                        // $walletAdd = mysqli_query($con, "INSERT INTO `wallet`(`user_id`, `balance`, `operator`, `transactionID`, `description`, `created_at`) 
                        //                                     VALUES ('$user_id','$pointsAdd','+','$TXN', 'Points Added By Admin', '$createDate')");
            
                            if($walletAdd){
                                echo "<script>window.location.href= '';</script>";
                            }
                    }
                ?>
            </div>
          </div>
        </div>
      </div>
      

  
<!--Change M-Pin-->
  <div class="modal fade" id="ChangeMpin">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Change M-Pin</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <form method="post" autocomplete="off">
                <div class="form-group">
                    <label>M-Pin</label>
                    <input type="text" name="mPin" value="<?php echo $row['mPin']; ?>" pattern="[0-9]{4}" class="form-control" placeholder="Enter M-Pin Here" required/>
                </div>
                
                <div class="form-group">
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit" name="ChangeMpin">Submit</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

<?php 
    if(isset($_POST['requestRejected'])){
        $id = $_POST['id'];
        $remark = $_POST['remark'];
        $createDate = date("Y-m-d H:i:s");
        $txn_id = $_POST['txn_id'];
        
        
        mysqli_query($con,"update withdraw_requests set status='2' where sn='$id'");
        
        $info = mysqli_fetch_array(mysqli_query($con,"select user, amount from withdraw_requests where sn='$id'"));
        $mobile = $info['user'];
        $amount = $info['amount'];
        
        mysqli_query($con,"UPDATE users set wallet=wallet+$amount where mobile='$mobile'");
    
        $withdrawUpdate = mysqli_query($con,"INSERT INTO `transactions`(`user`, `amount`, `type`, `remark`, `owner`, `created_at`, `game_id`, `batch_id`) VALUES ('$mobile','$amount','1','Withdraw cancelled by our team','user','$stamp','0','0')");
  
        
        //$withdrawUpdate = mysqli_query($con, "UPDATE `withdraw_point_request` SET `remark`='$remark',`accept_date`='$createDate',`payment_receipt`='',`status`='2' WHERE `id`='$id'");
                                                    
        if($withdrawUpdate){
            //$walletRowDelete = mysqli_query($con, "DELETE FROM `wallet` WHERE `user_id`='$user_id' AND `transactionID`='$txn_id'");
             echo "<script>window.location.href= '';</script>";
            // if($walletRowDelete){
            //     echo "<script>window.location.href= '';</script>";
            // }
        }
    }



    // Approved request
    if(isset($_POST['requestApproved'])){
        $id = $_POST['id'];
        $remark = $_POST['remark'];
        $createDate = date("Y-m-d H:i:s");
                                                   
        
        // $target_dir = "images/";
        // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        
        // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        // if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            
        // }
        
        
          $withdrawUpdate=  mysqli_query($con,"update withdraw_requests set status='1' where sn='$id'");
                                                                
       // $withdrawUpdate = mysqli_query($con, "UPDATE `withdraw_point_request` SET `remark`='$remark',`accept_date`='$createDate',`payment_receipt`='$target_file',`status`='1' WHERE `id`='$id'");
                                                    
        if($withdrawUpdate){
            echo "<script>window.location.href= '';</script>";
        }
    }


    if(isset($_POST['ChangeMpin'])){
        $mPin = $_POST['mPin'];
        $updateDate = date("Y-m-d H:i:s");
        
        $changePinM = mysqli_query($con, "UPDATE `users` SET `mPin`='$mPin', `updated_at`='$updateDate' WHERE `user_id`='$user_id'");
        if($changePinM){
            echo "<script>window.location.href= '';</script>";
        }
    }


include('footer.php'); 
?>