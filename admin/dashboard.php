<?php include('header.php'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>
                    <?php 
                        $approverUsers = mysqli_query($con, "SELECT * FROM `users` WHERE `verify`='1' ");
                        echo $count = mysqli_num_rows($approverUsers);
                    ?>
                </h3>

                <p>Approved Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="users.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>
                    <?php 
                        $approverUsers = mysqli_query($con, "SELECT * FROM `users` WHERE `verify`='0' ");
                        echo $count = mysqli_num_rows($approverUsers);
                    ?>
                </h3>

                <p>Un-Approved Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="users.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                    <?php
                        $date = date('d/m/Y');
                        $TotalBidAmt = mysqli_query($con, "SELECT SUM(amount) AS TotalPoints FROM `games` WHERE `date`='$date' ");
                        $fetchTotalPoints = mysqli_fetch_array($TotalBidAmt);
                        
                        $TotalBidAmt2 = mysqli_query($con, "SELECT SUM(amount) AS TotalPoints FROM `starline_games` WHERE `date`='$date' ");
                        $fetchTotalPoints2 = mysqli_fetch_array($TotalBidAmt2);
                        
                        if($fetchTotalPoints['TotalPoints'] != ''){
                            echo $fetchTotalPoints['TotalPoints']+$fetchTotalPoints2['TotalPoints'];
                        }else{
                            echo 0+$fetchTotalPoints2['TotalPoints'];
                        }
                    ?>
                    <sup style="font-size: 20px">₹</sup>
                </h3>

                <p>Total Bid Amount</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="bid-history.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>
                    <?php
                        $date = date('d/m/Y');
                        $NoOfBid = mysqli_query($con, "SELECT * FROM `games` WHERE `date`='$date' ");
                        $NoOfBid2 = mysqli_query($con, "SELECT * FROM `starline_games` WHERE `date`='$date' ");
                        echo $NofB = mysqli_num_rows($NoOfBid)+mysqli_num_rows($NoOfBid2)+0;
                    ?>
                </h3>

                <p>Number Of Bids</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="bid-history.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            
            <div class="card bg-gradient-warning">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  Market Bid Details
                </h3>
                <!-- card tools -->
                <div class="card-tools">
                  <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                    <i class="far fa-calendar-alt"></i>
                  </button>
                  <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                    <div class="form-group">
                        <label>Game Name</label>
                        <select id="gameID" class="form-control">
                            <option value="" selected disabled>Select Game</option>
                            <option value="0">All Games</option>
                            <?php 
                                $gameList = mysqli_query($con, "SELECT * FROM `gametime_new` WHERE `active`='1' ORDER BY sn DESC");
                                while($row = mysqli_fetch_array($gameList)){
                            ?>
                            <option value="<?php echo $row['market']; ?>"><?php echo $row['market']; ?></option>
                            <?php
                                }
                            ?>
                             <?php 
                                $gameList = mysqli_query($con, "SELECT * FROM `gametime_manual` WHERE `active`='1' ORDER BY sn DESC");
                                while($row = mysqli_fetch_array($gameList)){
                            ?>
                            <option value="<?php echo $row['market']; ?>"><?php echo $row['market']; ?></option>
                            <?php
                                }
                            ?>
                            
                           
                        </select>
                        <br>
                        <h4 class="text-center"><span class="badge badge-primary" id="bidAmount">0</span></h4>
                        <h5 class="text-center">Market Amount</h5>
                    </div>
              </div>
              <!-- /.card-body-->
            </div>
            
            
            
            <!--Single Ank Bids-->
            <div class="card bg-gradient-success">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  Total Bids On Single Ank Of Date <?php echo date('d-M-Y'); ?>
                </h3>
                <!-- card tools -->
                <div class="card-tools">
                  <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Game Name</label>
                                                    <select id="game_id" class="form-control">
                                                        <option value="" selected disabled>Select Game</option>
                                                         <?php 
                                                            $gameList = mysqli_query($con, "SELECT * FROM `gametime_new` WHERE `active`='1' ORDER BY sn DESC");
                                                            while($row = mysqli_fetch_array($gameList)){
                                                        ?>
                                                        <option value="<?php echo $row['market']; ?>"><?php echo $row['market']; ?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                         <?php 
                                                            $gameList = mysqli_query($con, "SELECT * FROM `gametime_manual` WHERE `active`='1' ORDER BY sn DESC");
                                                            while($row = mysqli_fetch_array($gameList)){
                                                        ?>
                                                        <option value="<?php echo $row['market']; ?>"><?php echo $row['market']; ?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                      
                                                    </select>
                                                </div>
                                            </div>
                                            
                    <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Session</label>
                                                    <select id="session" class="form-control">
                                                        <option value="" selected disabled>Select Session</option>
                                                        <option value="open">Open Market</option>
                                                        <option value="close">Close Market</option>
                                                    </select>
                                                </div>
                                            </div>
                    <div class="col-sm-4">
                        <br>
                        <div class="form-group">
                            
                            <button class="btn btn-primary btn-block" id="getDetails">Get Details</button>
                        </div>
                    </div>
                </div>
              </div>
              <!-- /.card-body-->
            </div>
            
            <div class="row" id="singleAnks">
                    
            </div>
    
          </section>
          <!-- /.Left col -->
         
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

<?php include('footer.php'); ?>
<script>
    $('#gameID').change(function(){
        var gameID = $('#gameID').val();
        
        if(gameID != ''){
            $.ajax({    //create an ajax request to 
                type: "POST",
                url: "calculate-bid-amount-ajax.php",             
                data:{gameID:gameID},  //expect html to be returned                
                success: function(data){
                    $('#bidAmount').text(data);
                }
            });
        }else{
            alert('Please Select Game!');
        }
    });
    
    
// game Details Single Ank
    $('#getDetails').click(function(){
        var game_id = $('#game_id').val();
        var session = $('#session').val();
        
        if(game_id != '' && session != ''){
            $.ajax({    //create an ajax request to 
                type: "POST",
                url: "calculate-single-ank-bid.php",             
                data:{gameID:game_id, session:session},  //expect html to be returned                
                success: function(data){
                    $('#singleAnks').html(data);
                }
            });
        }else{
            alert('Please Select Game & Session!');
        }
        
    });
</script>