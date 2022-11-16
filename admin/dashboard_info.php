<?php

include('header.php'); 
// $user_id = $_GET['userID'];
// $select = mysqli_query($con, "SELECT * FROM `users` WHERE `mobile`='$user_id' ");
// $row = mysqli_fetch_array($select);



$num_results_on_page = 10;  
if (isset($_GET["page"])) {
	$page  = $_GET["page"]; 
	} 
	else{ 
	$page=1;
	};  
$start_from = ($page-1) * $num_results_on_page;  

$search_url_add = "";

if(isset($_GET['query'])){
    
    $search = $_GET['query'];
    
    $search = "title LIKE '%$search%' OR description LIKE '%$search%'";
    
    $result = mysqli_query($con,"select * from dashboard_info WHERE $search order by sn desc LIMIT $start_from, $num_results_on_page");
    
    $result_db = mysqli_query($con,"select COUNT(sn) from dashboard_info AS history where $search"); 
    
    $search_url_add = "&query=".$_REQUEST['query'];
    
} else {
    
    $result = mysqli_query($con,"select * from dashboard_info order by sn desc LIMIT $start_from, $num_results_on_page");
    
    
    $result_db = mysqli_query($con,"SELECT COUNT(sn) FROM dashboard_info"); 
    
}

$action_url = "&page=".$page.$search_url_add;


$row_db = mysqli_fetch_row($result_db);  
$total_pages = $row_db[0];  

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;



?>

<style>
    .preloader {
        width: 100vw;
    }
</style>


<!-- Modal New User -->
<div class="modal fade" id="addInfo">
        <div class="modal-dialog">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Add New Dashboard Info</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" autocomplete="off">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" value="" class="form-control" placeholder="Enter title" required/>
                    </div>
                    
                    <div class="form-group">
                        <label>Description</label>
                        <textarea  rows="3" type="text" name="description" value="" class="form-control" placeholder="Enter description" required></textarea>
                    </div>
                    
                    
                    <div class="form-group">
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button class="btn btn-success" type="submit" name="AddInfo">Submit</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
                
                <?php
                    if(isset($_POST['AddInfo'])){
                       
                       extract($_REQUEST);
                       
                       $code = rand(10000,999999);
                       
                       $walletAdd = mysqli_query($con,"INSERT INTO `dashboard_info`(`title`, `description`) VALUES
                       ('$title','$description')
                       ");
            
                            if($walletAdd){
                                echo "<script>window.location.href= '';</script>";
                            }
                    }
                ?>
                
              
            </div>
          </div>
        </div>
      </div>




<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard Info</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard Info</li>
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
                    <a href="#addInfo" data-toggle="modal" class="btn btn-primary">Add New Info</a>
                </h3>
                
                <br>
                <br>
                
                <form class="forms-sample" method="get" enctype="multipart/form-data" autocomplete="off">
                                  
                  <p>Search with Title,Description</p>
                    
                   <div class="row">
                       <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" name="query" value="<?php if(isset($_REQUEST['query'])){ echo $_REQUEST['query']; } ?>" placeholder="Enter Keyword" required>
                            </div>
                       </div>
                       <div class="col-sm-4">
                           <button type="submit" class="btn btn-primary mr-2 mt-4" style="width: 100%;margin-top: 0 !important;">Search</button>
                       </div>
                   </div>
                    
                    
                </form>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th>Description</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i = (($page-1)*10)+1; while ($row = fetch($result)) { 
                                            
                                            
                                            ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $row['title']; ?></td>
                      <td>
                      <?php echo $row['description']; ?><br>
                        <!--<a href="https://api.whatsapp.com/send?phone=91<?php echo $row['mobile']; ?>" target="_blank"><i class="fab fa-whatsapp" style="color:green;font-size:20px;"></i></a>
                        &nbsp;&nbsp;
                        <a href="tel:+91 <?php echo $row['mobile']; ?>" target="_blank"><i class="fas fa-phone-alt" style="font-size:20px;"></i></a> -->
                      </td>
                      
                      <td>
                        <a href="user-profile.php?userID=<?php echo $row['mobile']; ?>"><i class="fas fa-eye" style="font-size:25px;"></i></a>
                      </td>
                      
              </div>
              </div>
              </div>
    
    <!--Withdrawal Points-->
<div class="modal fade" id="withdrowPoints<?php echo $row['sn']; ?>">
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
                        <input type="hidden" name="user_id" value="<?php echo $row['mobile']; ?>" class="form-control" placeholder="Enter Points Here" required/>
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
                        $user_id = $_POST['user_id'];
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
                                return;
                            }
                    }
                ?>
            </div>
          </div>
        </div>
      </div>
                    </tr>
                  <?php
                    $i++;  
                    }                
                  ?>
                  </tbody>
                </table>
                
                <?php if (ceil($total_pages / $num_results_on_page) > 0): 
                                    
                                     ?>
                                    <ul class="pagination">
                                    	<?php if ($page > 1): ?>
                                    	<li class="prev page-item"><a class='page-link' href="<?php echo $_PHP_SELF; ?>?page=<?php echo $page-1 ?><?php echo $search_url_add; ?>">Prev</a></li>
                                    	<?php endif; ?>
                                    
                                    	<?php if ($page > 3): ?>
                                    	<li class="start page-item"><a class='page-link' href="<?php echo $_PHP_SELF; ?>?page=1<?php echo $search_url_add; ?>">1</a></li>
                                    	<li class="dots page-item">...</li>
                                    	<?php endif; ?>
                                    
                                    	<?php if ($page-2 > 0): ?><li class="page page-item"><a class='page-link' href="<?php echo $_PHP_SELF; ?>?page=<?php echo $page-2 ?><?php echo $search_url_add; ?>"><?php echo $page-2 ?></a></li><?php endif; ?>
                                    	<?php if ($page-1 > 0): ?><li class="page page-item"><a class='page-link' href="<?php echo $_PHP_SELF; ?>?page=<?php echo $page-1 ?><?php echo $search_url_add; ?>"><?php echo $page-1 ?></a></li><?php endif; ?>
                                    
                                    	<li class="currentpage page-item"><a class='page-link' href="<?php echo $_PHP_SELF; ?>?page=<?php echo $page ?><?php echo $search_url_add; ?>"><?php echo $page ?></a></li>
                                    
                                    	<?php if ($page+1 < ceil($total_pages / $num_results_on_page)+1): ?><li class="page page-item"><a class='page-link' href="<?php echo $_PHP_SELF; ?>?page=<?php echo $page+1 ?><?php echo $search_url_add; ?>"><?php echo $page+1 ?></a></li><?php endif; ?>
                                    	<?php if ($page+2 < ceil($total_pages / $num_results_on_page)+1): ?><li class="page page-item"><a class='page-link' href="<?php echo $_PHP_SELF; ?>?page=<?php echo $page+2 ?><?php echo $search_url_add; ?>"><?php echo $page+2 ?></a></li><?php endif; ?>
                                    
                                    	<?php if ($page < ceil($total_pages / $num_results_on_page)-2): ?>
                                    	<li class="dots page-item">...</li>
                                    	<li class="end page-item"><a class='page-link' href="<?php echo $_PHP_SELF; ?>?page=<?php echo ceil($total_pages / $num_results_on_page) ?><?php echo $search_url_add; ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
                                    	<?php endif; ?>
                                    
                                    	<?php if ($page < ceil($total_pages / $num_results_on_page)): ?>
                                    	<li class="next page-item"><a class='page-link' href="<?php echo $_PHP_SELF; ?>?page=<?php echo $page+1 ?><?php echo $search_url_add; ?>">Next</a></li>
                                    	<?php endif; ?>
                                    </ul>
                                    <?php endif; ?>
                                    
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

include('footer.php'); ?>
