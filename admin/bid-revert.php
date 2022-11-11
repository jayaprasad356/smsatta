<?php include('header.php'); ?>

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Bid Revert</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="Dashboard">Home</a></li>
              <li class="breadcrumb-item active">Bid Revert</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<!-- 
Date Filter 
-->


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
                            <div class="form-group">
                            <label>Game</label>
                            <select id="game_id" class="form-control select2bs4" style="width: 100%;">
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
                        <div class="col-md-4">
                            <div class="form-group mt-2">
                                <button class="btn btn-primary mt-4" id="go">SAVE</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.card -->

            <!-- After Save results show buttons Show Winners & Declare Results -->
            <div class="card card-default">
                <!-- /.card-header -->
                <div class="card-body center" style="display:none;">
                    <button type="button" id="clearRefund" class="btn btn-success">Clear & Refund All</button>
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
                    <button class="btn btn-primary">History</button>
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
                    <th>Bid Points</th>
                    <th>Bid Number</th>
                  </tr>
                  </thead>
                  <tbody id="tbody">
                      
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


<!-- BID SCRIPT REVERT -->

<?php include('footer.php'); ?>
<script>
$('#go').click(function(){
    var date = $('#date').val();
    var gameID = $('#game_id').val();
    
    if(date != '' && gameID != ''){
        $.ajax({    //create an ajax request to display.php
            type: "POST",
            url: "bid-revert-ajax.php",             
            data:{date:date, gameID:gameID},   //expect html to be returned                
            success: function(response){ 
                $('.center').show();
                $("#tbody").html(response); 
            }
        });
    }
});

$('#clearRefund').click(function(){
    var date = $('#date').val();
    var gameID = $('#game_id').val();
    
    if(date != '' && gameID != ''){
        $.ajax({    //create an ajax request to display.php
            type: "POST",
            url: "bid-revert-refund.php",             
            data:{date:date, gameID:gameID},   //expect html to be returned                
            success: function(response){ 
                if(response == 1){
                    location.reload();
                }else{
                    alert('Error!');
                }
            }
        });
    }
    
});


    $(function () {
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    });
</script>