<?php     
 if($_SESSION['super_admin'] == 1){
?>
     <nav class="navbar navbar-default container-fluid-max">
        <div class="container-fluid ">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <a class="navbar-brand" href="index.php">CURVE ADMIN</a>
          </div>
      
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            
            <ul class="nav navbar-nav navbar-right">
              <li><a href="index.php">Blotter</a></li>
              <li><a href="users.php">Manage Users</a></li>
              <li><a href="email_options.php">Email Options</a></li>
              <li><a href="clients.php">Client List</a></li>
              <li><a href="client_trader.php">Client Trader List</a></li>                 
              <li><a href="brokerage.php">Brokerage</a></li>
              
              <li><a href="ccyrate.php">CCY Rate</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav> 
 <?php
  }
 ?>