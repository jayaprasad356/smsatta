<HTML>
    
<head>
    <title>Betplay Installer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</head>

<body>
    
    <style>
        .header 
        {
            padding: 5vh 5vw;
            background: #3c6fff;
            color: white;
        }
        
        .footer 
        {
            padding: 5vh 5vw;
            background: #3c6fff;
            color: white;
        }
        
        .step {
            margin-top: 5vh;
                    margin-bottom: 15px;
                    background: #ececec;
                    padding: 10px 19px;
                    border-radius: 9px;
        }
        
        .form-group { margin-top: 15px; }
        
        form button {
            margin-top:20px;
            width:100%;
        }
        
    </style>
    
      
     <div class="col-sm-12 header">
            <h3>Betplay Installer</h3>
            <p>This installer help you to install script on your server</p>
            <p class="alert alert-info">Your purchase code will binded with this domain after installation and it's not changable after installlation, So make sure you do not proceed to install with temporary domain, For testing purpose user localhost like xampp or wampp, For any query contact us at <a href="mailto:betplay@codegente.com">betplay@codegente.com</a></p>
        </div>
        
    <div class="container">    
  
    
    <div class="row">
       
        
        <form action='installer/installer.php' method="POST">
            
            <div class="step"><span>Step 1</span> <h4>Verification</h4></div>
            
            <div class="form-group">
                <label for="exampleInputEmail1">Buying Source</label>
                <select class="form-select" name="source" aria-label="Buying Source" aria-describedby="buyerhelp" >
                  <option value="codegente">Direct Purchase / Codegente Website</option>
                  <option value="codecanyon">CodeCanyon</option>
                </select>
                <small id="buyerhelp" class="form-text text-muted">Select Source from you bought the script</small>
            </div>
                       
            <div class="form-group">
                <label for="exampleInputEmail1">Purchase Code</label>
                <input type="text" name="purchase_code" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Purchase Code" required>
                <small id="emailHelp" class="form-text text-muted">Enter purchase code you received by codecanyon or codegente team, If you not received any code on direct purchase contact us <a href="mailto:betplay@codegente.com">betplay@codegente.com</a></small>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Installation Domain</label>
                <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $_SERVER['SERVER_NAME']; ?>" aria-describedby="emailHelp" disabled>
                <small id="emailHelp" class="form-text text-muted">Automatically detected by our system to complete the installation</small>
            </div>

            <div class="step"><span>Step 2</span> <h4>Database Configration</h4></div>
            
            <div class="form-group">
                <label for="exampleInputEmail1">Database Host</label>
                <input type="text" name="host" name="source" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Database host" value="localhost" required>
                <small id="emailHelp" class="form-text text-muted">Enter database hostname, Mostly localhost is default value for this</small>
            </div>
            
            <div class="form-group">
                <label for="exampleInputEmail1">Database Username</label>
                <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Database Username" required>
                <small id="emailHelp" class="form-text text-muted">Enter database Username who is authrized to read, write and modify the database</small>
            </div>
            
            <div class="form-group">
                <label for="exampleInputEmail1">Database Password</label>
                <input type="text" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Database Password" required>
                <small id="emailHelp" class="form-text text-muted">Enter database password</small>
            </div>
            
              <div class="form-group">
                <label for="exampleInputEmail1">Database Name</label>
                <input type="text" name="database" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Database Name" required>
                <small id="emailHelp" class="form-text text-muted">Enter database name</small>
            </div>
            
            <button type="submit" class="btn btn-primary">Start Installation</button>
          
        </form>
    </div>
    
    </div>
    
    <footer class="text-center text-lg-start">
      <!-- Copyright -->
      <div class="text-center p-3">
        © 2017-<?php echo date('Y'); ?> All Copyright Reserved by Codegente:
        <a class="text-dark" href="https://www.codegente.com/">www.codegente.com</a>
      </div>
      <!-- Copyright -->
</footer>
    

</body>


        
    
</HTML>