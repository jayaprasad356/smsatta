<?php include('header.php'); 

  $selectValues = mysqli_query($con, "SELECT * FROM `settings` ");
  while($row= mysqli_fetch_array($selectValues)){
      $valuesRow[$row['data_key']] = $row['data'];
  }
  $valuesRowCount = mysqli_num_rows($selectValues);
?>

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Main Settings</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="Dashboard">Home</a></li>
              <li class="breadcrumb-item active">Main Settings</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Value's Limit</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
                    
                    <p>2nd App</p>
                      <div class="form-group">
                    <label>Whatsapp</label>
                    <input type="number" name="whatsapp_app" value="<?php echo $valuesRow['whatsapp_app']; ?>" class="form-control" required />
                  </div>
                     <div class="form-group">
                    <label>Paytm UPI Address</label>
                    <input type="text" name="upi_app" value="<?php echo $valuesRow['upi_app_app']; ?>" class="form-control" required />
                  </div>
                  <div class="form-group">
                    <label>Paytm UPI MCC</label>
                    <input type="number" name="merchant_app" value="<?php echo $valuesRow['merchant_app']; ?>" class="form-control" required />
                  </div>
                  <div class="form-group">
                    <label>PhonePe UPI Address</label>
                    <input type="text" name="upi_2_app" value="<?php echo $valuesRow['upi_2_app']; ?>" class="form-control" required />
                  </div>
                  <div class="form-group">
                    <label>PhonePe UPI MCC</label>
                    <input type="number" name="merchant_2_app" value="<?php echo $valuesRow['merchant_2_app']; ?>" class="form-control" required />
                  </div>
                  <div class="form-group">
                    <label>GPAY UPI Address</label>
                    <input type="text" name="upi_3_app" value="<?php echo $valuesRow['upi_3_app']; ?>" class="form-control" required />
                  </div>
                  <div class="form-group">
                    <label>GPAY UPI MCC</label>
                    <input type="number" name="merchant_3_app" value="<?php echo $valuesRow['merchant_3_app']; ?>" class="form-control" required />
                  </div>
                  
                    
                    <p>end 2nd App</p>
                    
                  <div class="form-group">
                    <label>Minimum Deposit</label>
                    <input type="number" name="min_deposit" value="<?php echo $valuesRow['min_deposit']; ?>" class="form-control" required />
                  </div>
                  <div class="form-group">
                    <label>Minimum Withdraw</label>
                    <input type="number" name="min_withdraw" value="<?php echo $valuesRow['min_withdraw']; ?>" class="form-control" required />
                  </div>
                  <div class="form-group">
                    <label>Paytm UPI Address</label>
                    <input type="text" name="upi" value="<?php echo $valuesRow['upi']; ?>" class="form-control" required />
                  </div>
                  <div class="form-group">
                    <label>Paytm UPI MCC</label>
                    <input type="number" name="merchant" value="<?php echo $valuesRow['merchant']; ?>" class="form-control" required />
                  </div>
                  <div class="form-group">
                    <label>PhonePe UPI Address</label>
                    <input type="text" name="upi_2" value="<?php echo $valuesRow['upi_2']; ?>" class="form-control" required />
                  </div>
                  <div class="form-group">
                    <label>PhonePe UPI MCC</label>
                    <input type="number" name="merchant_2" value="<?php echo $valuesRow['merchant_2']; ?>" class="form-control" required />
                  </div>
                  <div class="form-group">
                    <label>GPAY UPI Address</label>
                    <input type="text" name="upi_3" value="<?php echo $valuesRow['upi_3']; ?>" class="form-control" required />
                  </div>
                  <div class="form-group">
                    <label>GPAY UPI MCC</label>
                    <input type="number" name="merchant_3" value="<?php echo $valuesRow['merchant_3']; ?>" class="form-control" required />
                  </div>
                  
                  <div class="form-group">
                    <label>Whatsapp Support</label>
                    <select name="whatsapp_active" class="form-control">
                        <option value="" selected disabled>Select Globel Setting</option>
                        <option value="1" <?php if($valuesRow['whatsapp_active'] == 1){ echo 'selected'; }?> >ON</option>
                        <option value="0" <?php if($valuesRow['whatsapp_active'] == 0){ echo 'selected'; }?> >OFF</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Whatsapp</label>
                    <input type="number" name="whatsapp" value="<?php echo $valuesRow['whatsapp']; ?>" class="form-control" required />
                  </div>
                  <div class="form-group">
                    <label>Withdraw Open Time</label>
                    <input type="time" name="withdrawOpenTime" value="<?php echo $valuesRow['withdrawOpenTime']; ?>" class="form-control" required />
                  </div>
                  <div class="form-group">
                    <label>Withdraw Close Time</label>
                    <input type="time" name="withdrawCloseTime" value="<?php echo $valuesRow['withdrawCloseTime']; ?>" class="form-control" required />
                  </div>
                  <div class="form-group">
                    <label>Auto verify</label>
                    <select name="auto_verify" class="form-control">
                        <option value="" selected disabled>Select Globel Setting</option>
                        <option value="1" <?php if($valuesRow['auto_verify'] == 1){ echo 'selected'; }?> >ON</option>
                        <option value="0" <?php if($valuesRow['auto_verify'] == 0){ echo 'selected'; }?> >OFF</option>
                    </select>
                  </div>
                                    
                  <div class="form-group">
                    <label>Chat Support</label>
                    <select name="chat_support" class="form-control">
                        <option value="" selected disabled>Select Globel Setting</option>
                        <option value="1" <?php if($valuesRow['chat_support'] == 1){ echo 'selected'; }?> >ON</option>
                        <option value="0" <?php if($valuesRow['chat_support'] == 0){ echo 'selected'; }?> >OFF</option>
                    </select>
                  </div>

                 
                  <div class="form-group">
                    <label>Telegram</label>
                    <select name="telegram" class="form-control">
                        <option value="" selected disabled>Select Globel Setting</option>
                        <option value="1" <?php if($valuesRow['telegram'] == 1){ echo 'selected'; }?> >ON</option>
                        <option value="0" <?php if($valuesRow['telegram'] == 0){ echo 'selected'; }?> >OFF</option>
                    </select>
                  </div>
                   <div class="form-group">
                    <label>Telegram link</label>
                    <input type="text" name="telegram_details" value="<?php echo $valuesRow['telegram_details']; ?>" class="form-control" required />
                  </div>
                  <div class="form-group">
                    <label>Chat Welcome Message</label>
                    <input type="text" name="welcome_msg" value="<?php echo $valuesRow['welcome_msg']; ?>" class="form-control" required />
                  </div>
                  
                  <div class="form-group">
                    <label>HomeScreen Marquee Text</label>
                    <input type="text" name="home_line" value="<?php echo $valuesRow['home_line']; ?>" class="form-control" required />
                  </div>
                  

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="AddValues" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <?php
              if(isset($_POST['AddValues'])){
                              
                
                extract($_REQUEST);
                mysqli_query($con,"update settings set data='$min_deposit' where data_key='min_deposit'");
                mysqli_query($con,"update settings set data='$min_withdraw' where data_key='min_withdraw'");
                mysqli_query($con,"update settings set data='$whatsapp' where data_key='whatsapp'");
                
                mysqli_query($con,"update settings set data='$upi' where data_key='upi'");
                mysqli_query($con,"update settings set data='$merchant' where data_key='merchant'");
                
                mysqli_query($con,"update settings set data='$upi_2' where data_key='upi_2'");
                mysqli_query($con,"update settings set data='$merchant_2' where data_key='merchant_2'");
                
                mysqli_query($con,"update settings set data='$upi_3' where data_key='upi_3'");
                mysqli_query($con,"update settings set data='$merchant_3' where data_key='merchant_3'");
                
                mysqli_query($con,"update settings set data='$withdrawOpenTime' where data_key='withdrawOpenTime'");
                mysqli_query($con,"update settings set data='$withdrawCloseTime' where data_key='withdrawCloseTime'");
                mysqli_query($con,"update settings set data='$auto_verify' where data_key='auto_verify'");
                
                mysqli_query($con,"update settings set data='$chat_support' where data_key='chat_support'");
                mysqli_query($con,"update settings set data='$telegram' where data_key='telegram'");
                mysqli_query($con,"update settings set data='$telegram_details' where data_key='telegram_details'");
                
                mysqli_query($con,"update settings set data='$whatsapp_active' where data_key='whatsapp_active'");
                mysqli_query($con,"update settings set data='$welcome_msg' where data_key='welcome_msg'");
                mysqli_query($con,"update settings set data='$home_line' where data_key='home_line'");
                
                
                mysqli_query($con,"update settings set data='$whatsapp_app' where data_key='whatsapp_app'");
                
                mysqli_query($con,"update settings set data='$upi_app' where data_key='upi_app'");
                mysqli_query($con,"update settings set data='$merchant_app' where data_key='merchant_app'");
                
                mysqli_query($con,"update settings set data='$upi_2_app' where data_key='upi_2_app'");
                mysqli_query($con,"update settings set data='$merchant_2_app' where data_key='merchant_2_app'");
                
                mysqli_query($con,"update settings set data='$upi_3_app' where data_key='upi_3_app'");
                mysqli_query($con,"update settings set data='$merchant_3_app' where data_key='merchant_3_app'");
                
                 echo "<script>window.location.href='main-settings.php'</script>";
              }
          ?>
          <!--/.col (left) -->
          <!-- right column -->
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


<?php include('footer.php'); ?>

<script>
    $(function () {
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    });
</script>