<?php
session_start();
include "includes/database_connect.php";
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
$sql_1 = "SELECT * FROM users WHERE id = '$user_id'";
$result_1 = mysqli_query($conn,$sql_1);
if(!$result_1)
{
  echo "Error : ".mysqli_error($conn);
  return ;
}
$user = mysqli_fetch_assoc($result_1);

$sql_2 = "SELECT * FROM interested_users_properties iup INNER JOIN properties p ON iup.property_id = p.id WHERE iup.user_id = '$user_id'";
$result_2 = mysqli_query($conn,$sql_2);
if(!$result_2)
{
  echo "Error : ".mysqli_error($conn);
  return;
}
$interested_user_properties = mysqli_fetch_all($result_2,MYSQLI_ASSOC);
/*if(!$interested_user_properties)
{
  echo "Not interested in any property";
  return;
}*/

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <script src="https://kit.fontawesome.com/356c2b5dab.js" crossorigin="anonymous"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="css_1/dashboard.css"/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@500&display=swap" rel="stylesheet">
        <link href="css_1/home.css" rel="stylesheet"/>
        <script src="https://kit.fontawesome.com/356c2b5dab.js" crossorigin="anonymous"></script>
        <style>
           .no_property{
             margin-left: -200px;
           }
           @media(max-width : 768px)
           {
             .no_property{
               margin-left: 50px;
             }
           }
        </style>
    </head>
    <body>
        <?php
        include "includes/header.php";
        include "includes/login_modal.php";
        include "includes/signup_modal.php";
        ?>
        <div class="breadcrumb-color">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li style="margin-left: 15px;" class="breadcrumb-item active"><a href="index.php">Home</a></li>
              <li style="margin-left: 15px ;  color:black" class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
      </div>
      
      <div class="user">
        <div class="user-photo">
          <i id="photo" class="fa-solid fa-user fa-4x"></i><br/>
          <div class="detail">
          <b><?php echo $user['name']?></b>
            <b><?php echo $user['email']?></b>
            <b><?php echo $user['phone_no']?></b>
            <b>Internshala</b>
          </div>
        </div>
      </div>
      <div class="favourite-properties">
        <h2 class="heading">My Favourite Properties</h2>
        <div pro1>

          <?php
            foreach($interested_user_properties as $interested_user_property){
              $property_images = glob("img/properties/".$interested_user_property['id']."/*");
          ?>
          <div class="card mb-3" style="max-width: 800px;">
            <div class="row g-0">
              <div class="col-md-4">
                <img src= "<?= $property_images[0]?>" class="img-fluid rounded-start" alt="Image unavailable"  >
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title"><?php echo$interested_user_property['name']?></h5>
                  <p  class="card-text"><?php echo $interested_user_property['address']?></p>
                  <p class="card-text">Rs. <?php echo number_format($interested_user_property['rent'])?></p>
                  <?php
                  //<button type="button" class="btn btn-success" href="index.php">View</button>
                  ?>
                  <div class="button-container col-6">
                        <a  href="property_detail.php?property_id=<?= $interested_user_property['id']?>" class="btn btn-success">View</a>
                    </div>
                  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
              </div>
            </div>
          </div>
          <?php
            }
          ?>
        </div>
        <?php
           if(mysqli_num_rows($result_2) == 0)
           {?>
             <h5 class="no_property">No Properties to list !"</h5>
           <?php }
        ?>
      </div>

      

    

      <?php
      include "includes/footer.php";
      ?>
          
    </body>
</html>