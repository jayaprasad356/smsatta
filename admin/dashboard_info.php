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
<div class="modal fade" id="addinfo">
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
                        <textarea type="text"  rows="3" name="description" value="" class="form-control" placeholder="Enter description" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button class="btn btn-success" type="submit" name="btnAdd">Submit</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
                
                <?php
                    if(isset($_POST['btnAdd'])){
                       
                       extract($_REQUEST);
                       
                       $code = rand(10000,999999);
                       
                       $walletAdd = mysqli_query($con,"INSERT INTO `dashboard_info` (`title`, `description`) VALUES
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
                    <a href="#addinfo" data-toggle="modal" class="btn btn-primary">Add New Info</a>
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
                      <th>Description Mobile</th>
                      <th>Update</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i = (($page-1)*10)+1; while ($row = fetch($result)) { 
                                            
                                            
                                            ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $row['title']; ?></td>
                      <td><?php echo $row['description']; ?></td>                  
                      <td>
                          <a href="#editInfo<?php echo $row['sn']; ?>" data-toggle="modal" class="btn btn-danger btn-md"class="btn btn-sm btn-danger">Edit</a>
                      </td>
                      
              </div>
              </div>
              </div>

<!--Add Points-->
    <div class="modal fade" id="editInfo<?php echo $row['sn']; ?>">
        <div class="modal-dialog">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Edit Dashboard Info</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" autocomplete="off">
                    <input type="hidden" name="info_id" value="<?php echo $row['sn']; ?>" required/>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" value="<?php echo $result[0]['title']; ?>" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea rows="3" type="text" name="description" value="<?php echo $result[0]['description']; ?>" class="form-control" required ></textarea>
                    </div>
                    
                    <div class="form-group">
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button class="btn btn-success" type="submit" name="btnEdit">Submit</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
                <?php
                    if(isset($_POST['btnEdit'])){
                        $info_id = $_POST['info_id'];
                        
                       $walletAdd = mysqli_query($con,"update `dashboard_info` set title='$title',description='$description' where sn='$info_id'");
            
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
                    }?>
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
