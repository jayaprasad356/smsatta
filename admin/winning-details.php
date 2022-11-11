<?php include('header.php'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Winning History</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Win History</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Filters</h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" id="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" />
                            </div>
                        </div>
                       
                        <div class="col-md-4">
                            <div class="form-group mt-2">
                                <button id="go" class="btn btn-primary mt-4">SAVE</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.card -->

        </div>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                    Details
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
                  <tbody>
                    <?php
                        if(isset($_REQUEST['date'])) { 
                            $sel_date = $_REQUEST['date'];
                        } else {
                            $sel_date = date('m/d/Y');
                        }
                        
                        $sdate = strtotime($sel_date.' 00:00:00');
                        
                        $edate = strtotime($sel_date.' 23:59:59');
                        
                        $winning = mysqli_query($con, "SELECT * FROM `transactions` where remark like '%winning%' AND `created_at`>$sdate AND `created_at`<$edate ORDER BY sn DESC");
                        $i = 1;
                        while($row = mysqli_fetch_array($winning)){
                            $userID = $row['user'];
                            $user = mysqli_query($con, "SELECT * FROM `users` WHERE `mobile`='$userID' ");
                            $fetch = mysqli_fetch_array($user);
                                                    
                            $gameID = $row['game_id'];
                            $game = mysqli_query($con, "SELECT * FROM `games` WHERE `sn`='$gameID' ");
                            $g = mysqli_fetch_array($game);
                    ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $fetch['name']; ?></td>
                                <td><?php echo $g['amount']; ?></td>
                                <td><?php echo $row['amount']; ?></td>
                                <td><?php echo $g['bazar']; ?></td>
                                <td><?php echo $g['game']; ?></td>
                                <td><?php echo $g['number']; ?></td>
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

    <script>
// fetch sell report
$('#go').click(function(){
    var date = $('#date').val();
    
    if(date != ''){
            window.location.href = 'winning-details.php?date='+date;
        }
    });

    $(function () {
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    });
</script>