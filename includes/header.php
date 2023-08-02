<div class="header sticky-top">
            <?php
            //session_start();
            ?>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                  <a class="navbar-brand" href="index.php"><img src="img/logo.png" width="130px" height="50px"/></a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <?php
                    if(!isset($_SESSION['user_id'])){
                    ?>
                    <div class="navbar-nav">
                      <?php
                      if(isset($_SESSION['login_failed']))
                      {?>
                        <b style="color: red ">Login Failed !</b>
                      <?php }
                      ?>
                      <?php
                      if(isset($_SESSION['signup_failed']))
                      {?>
                         <b style="color: red ">Email is already registered !</b>
                      <?php }
                      ?>
                      <a class="login" class="nav-link active" aria-current="page" data-bs-toggle="modal" href="" data-bs-target="#login"><i class="fa-solid fa-right-to-bracket fa-bounce"></i>  Login </a>
                      
                      <a class="signup" class="nav-link active" aria-current="page" data-bs-toggle="modal" href="" data-bs-target="#Signup"><i class="fa-solid fa-user fa-bounce"></i>  Signup</a>
                     <?php 
                    }else {
                     ?> 
                      <div class='nav-name'>
                        Hi,<b><?php echo $_SESSION['name']?></b>
                      </div>
                      <?php // <li class="nav-item">?>
                        <a id="dashboard" class="nav-link" href="dashboard.php">
                         <i class="fas fa-user fa-bounce"></i> Dashboard
                        </a>
                      <div> | </div>  
                     <?php //</li>?>
                    <div class="nav-vl"></div>
                      <?php //<li class="nav-item">?>
                        <a id="logout" class="nav-link" href="logout.php">
                          <i class="fas fa-sign-out-alt fa-bounce"></i> Logout
                       </a>
                      <?php //</li>?>
                      <?php
                      }
                      ?>
                    </div>
                  </div>
                </div>
              </nav>
        </div>