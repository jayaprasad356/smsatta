<?php include('header.php'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Withdraw Points Request</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Withdraw Request</li>
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
                    <button class="btn btn-primary">Withdraw Points</button>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>User Mobile</th>
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
                        $select = mysqli_query($con, "SELECT * FROM `withdraw_requests` ORDER BY sn DESC");
                        $i = 1;
                        while($row = mysqli_fetch_array($select)){
                            $user_id = $row['user'];
                                                    
                            $user = mysqli_query($con, "SELECT * FROM `users` WHERE `mobile`='$user_id' ");
                            $fetch = mysqli_fetch_array($user);
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $fetch['name']; ?> <a href="user-profile.php?userID=<?php echo $user_id; ?>"><i class="mdi mdi-link"></i></a></td>
                                                
                            <td>
                                <?php echo $fetch['mobile']; ?>
                            </td>               
                            <td><?php echo $row['amount']; ?></td>
                            <td><?php echo $row['sn']; ?></td>
                            <td><?php echo date('h:i A d-m-Y',$row['created_at']); ?></td>
                            <td>
                                <?php
                                    if($row['status'] == 1){
                                        echo "<span class='badge badge-success'>Accepted</span>";  
                                    }elseif($row['status'] == 0){
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
                                <a href="#RequestApproved<?php echo $i; ?>" data-toggle="modal" class="btn btn-success mb-4">Approved</a>
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
                                                <?php echo $fetch['name']; ?> <a href="user-profile.php?userID=<?php echo $user_id; ?>"><i class="mdi mdi-link"></i></a>
                                            </div>
                                            <div class="col-sm-3 border"><b>Request Points</b></div>
                                            <div class="col-sm-3 border"><?php echo $row['amount']; ?></div>
                                            <div class="col-sm-3 border"><b>Request Number</b></div>
                                            <div class="col-sm-3 border">#<?php echo $row['sn']; ?></div>
                                            <div class="col-sm-3 border"><b>Payment Method</b></div>
                                            <div class="col-sm-3 border"><span class="badge badge-success"><?php echo $row['mode']; ?></span></div>
                                            <div class="col-sm-3 border"><b>Request Date</b></div>
                                            <div class="col-sm-3 border"><?php echo date('h:i A d-m-Y',$row['created_at']); ?></div>
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
                                                            <input type="hidden" name="id" value="<?php echo $row['sn']; ?>" required/>
                                                            <input type="hidden" name="txn_id" value="<?php echo $row['sn']; ?>" required/>
                                                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" required/>
                                                           
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
                                                            <input type="hidden" name="id" value="<?php echo $row['sn']; ?>" required/>
                                                            
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
    
<?php

    if(isset($_POST['requestRejected'])){
        $id = $_POST['id'];
        $remark = $_POST['remark'];
        $createDate = date("Y-m-d H:i:s");
        $txnID = $_POST['txn_id'];
        $userID = $_POST['user_id'];
        
        mysqli_query($con,"update withdraw_requests set status='2' where sn='$id'");
        
        $info = mysqli_fetch_array(mysqli_query($con,"select user, amount from withdraw_requests where sn='$id'"));
        $mobile = $info['user'];
        $amount = $info['amount'];
        
        mysqli_query($con,"UPDATE users set wallet=wallet+$amount where mobile='$mobile'");
    
        $withdrawUpdate = mysqli_query($con,"INSERT INTO `transactions`(`user`, `amount`, `type`, `remark`, `owner`, `created_at`, `game_id`, `batch_id`) VALUES ('$mobile','$amount','1','Withdraw cancelled by our team','user','$stamp','0','0')");
  
       
                                                    
        if($withdrawUpdate){
             echo "<script>window.location.href= 'withdraw-points-request.php';</script>";
            // $walletRowDelete = mysqli_query($con, "DELETE FROM `wallet` WHERE `user_id`='$userID' AND `transactionID`='$txnID'");
            // if($walletRowDelete){
            //     echo "<script>window.location.href= 'withdraw-points-request.php';</script>";
            // }
        }
    }



    // Approved request
    if(isset($_POST['requestApproved'])){
        $id = $_POST['id'];
        $remark = $_POST['remark'];
        $createDate = date("Y-m-d H:i:s");
                                                   
        
          $withdrawUpdate=  mysqli_query($con,"update withdraw_requests set status='1' where sn='$id'");
          
        // $target_dir = "images/";
        // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        
        // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        // if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            
        // }
                                                                
        // $withdrawUpdate = mysqli_query($con, "UPDATE `withdraw_point_request` SET `remark`='$remark',`accept_date`='$createDate',`payment_receipt`='$target_file',`status`='1' WHERE `id`='$id'");
                                                    
        if($withdrawUpdate){
            echo "<script>window.location.href= 'withdraw-points-request.php';</script>";
        }
    }
?>

<?php include('footer.php'); ?>