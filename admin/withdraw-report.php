<?php include('header.php'); ?>

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Withdraw Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="Dashboard">Home</a></li>
              <li class="breadcrumb-item active">Withdraw Report</li>
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
                    <button class="btn btn-primary">Withdraw Report</button>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Mobile Number</th>
                    <th>Points</th>
                    <th>Request No.</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>View</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                        $select = mysqli_query($con, "SELECT * FROM `withdraw_requests` WHERE `status`='1' ORDER BY sn DESC");
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
                                  
                                  <?php $get_withdraw_details = mysqli_query($con,"select * from withdraw_details where user='".$row['user']."'");
                          if(mysqli_num_rows($get_withdraw_details) > 0) {
                           $withdraw_details = mysqli_fetch_array($get_withdraw_details); 
                            $prefered = $withdraw_details['prefered'];
                            $upi = $withdraw_details['upi'];
                            $acno = $withdraw_details['acno'];
                            $name = $withdraw_details['name'];
                            $ifsc = $withdraw_details['ifsc'];
                          } else {
                            
                            $prefered = $withdraw_details['prefered'];
                            $upi = "Not set";
                            $acno = "Not set";
                            $name = "Not set";
                            $ifsc = "Not set";
                          }
                          
                          ?>
                                                
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
                                            <div class="col-sm-3 border"><span class="badge badge-success"><?php echo $prefered; ?></span></div>
                                            <div class="col-sm-3 border"><b>UPI</b></div>
                                            <div class="col-sm-3 border"><span class="badge badge-success"><?php echo $upi; ?></span></div>
                                            <div class="col-sm-3 border"><b>A/C no</b></div>
                                            <div class="col-sm-3 border"><span class="badge badge-success"><?php echo $acno; ?></span></div>
                                            <div class="col-sm-3 border"><b>A/C Holder Name</b></div>
                                            <div class="col-sm-3 border"><span class="badge badge-success"><?php echo $name; ?></span></div>
                                            <div class="col-sm-3 border"><b>IFSC</b></div>
                                            <div class="col-sm-3 border"><span class="badge badge-success"><?php echo $ifsc; ?></span></div>
                                            <div class="col-sm-3 border"><b>Request Date</b></div>
                                            <div class="col-sm-3 border"><?php echo date('h:i A d-m-Y',$row['created_at']); ?></div>
                                        </div>
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

<?php include('footer.php'); ?>