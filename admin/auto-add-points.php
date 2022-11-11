<?php include('header.php'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Points (Auto)</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Add Points (Auto)</li>
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
                    <button class="btn btn-primary">Add Points (Auto)</button>
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
                    <th>Payment ID</th>
                    <th>Points</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php 
                        $auto = mysqli_query($con, "SELECT * FROM `auto_deposits` ORDER BY sn DESC");
                        $i = 1;
                        
                        while($row = mysqli_fetch_array($auto)){
                            $userID = $row['mobile'];
                            $user = mysqli_query($con, "SELECT * FROM `users` WHERE `mobile`='$userID' ");
                            $uu = mysqli_fetch_array($user);
                      ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $uu['name']; ?></td>
                    <td><?php echo $uu['mobile']; ?></td>
                    <td><?php echo $row['pay_id']; ?></td>
                    <td><?php echo $row['amount']; ?></td>
                    <td><?php echo date('h:i A d-m-Y',$row['created_at']); ?></td>
                  </tr>
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