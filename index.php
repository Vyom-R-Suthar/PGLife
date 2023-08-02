<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <script src="https://kit.fontawesome.com/356c2b5dab.js" crossorigin="anonymous"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="css_1/home.css"/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@500&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/356c2b5dab.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php
          include "includes/header.php";
          $_SESSION['index'] = true;
        ?>
        <div id="loading">
        </div>
        <div class="breadcrumb-color">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li  id="breadcrumb-home" style="color: aliceblue;" class="breadcrumb-item active"><a href="index.php">Home</a></li>
            </ol>
        </nav>
        </div>
        <div class="image">
            <div class="heading">
                <h2 class="h2">Enter City</h2>
                <form method="GET" action="property_list.php">
                    <input class="search" type="text" name="city" placeholder="   eg : Delhi" required/>
                    <button style="margin-left: -7px; margin-top : -5px;" type="submit" class="btn btn-success">
                        <i class="fa fa-search fa-xs"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="cities">
            <h2 class="major-cities">Major Citites</h2>
            <div class="mumbai">
                <a href="property_list.php?city=Mumbai">
                <img class="mumbai-image" src="img/mumbai.png"/>
                </a>
            </div>
            <div class="banglore">
                <a href="property_list.php?city=Bangluru">
                <img class="banglore-image" src="img/bangalore.png"/>
                </a>
            </div>
            <div class="delhi">
                <a href="property_list.php?city=Delhi">
                <img class="delhi-image" src="img/delhi.png"/>
                </a>
            </div>
            <div class="hyderabad">
                <a href="property_list.php?city=Hyderabad">
                <img class="hyderabad-image" src="img/hyderabad.png"/>
                </a>
            </div>
        </div>
        
        <?php
        include "includes/footer.php";
        ?>
       
        



    
  
  <!-- Modal -->
  <?php
     include "includes/login_modal.php";
  ?>

    <?php
    include "includes/signup_modal.php";
    ?>
    <script type="text/javascript" src="js/common.js"></script>
    <script type="text/javascript" src="js/common1.js"></script>
</body>
</html>