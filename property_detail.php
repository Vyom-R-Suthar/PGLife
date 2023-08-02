<?php
session_start();
require "includes/database_connect.php";
if(isset($_SESSION['user_id']))
{
$user_id = $_SESSION['user_id'];
}
else{
    $user_id = null;
}
//$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
$property_id = $_GET['property_id'];

$sql_1="SELECT * FROM properties where id='$property_id'";
$result_1 = mysqli_query($conn ,$sql_1); // this line is to find that is any property of given id is there in database. 
if(!$result_1)
{
    echo "Something went wrong , Contact admin ! : ".mysqli_error($conn);
    return;
}
$property = mysqli_fetch_assoc($result_1);
if(!$property)
{
    echo "NO PROPERTY DETAILS AVAILABLE ! Contact admin";
    return;
}

$sql_2="SELECT
        * FROM properties p 
        INNER JOIN cities c 
        ON p.city_id=c.id 
        WHERE  p.id='$property_id'";
$result_2=mysqli_query($conn,$sql_2);
if(!$result_2)
{
    echo "Error : ".mysqli_error($conn);
    return;
}
$property_city=mysqli_fetch_assoc($result_2);
if(!$property_city)
{
    echo "NOT MATCHED";
    return;
}
$sql_3 = "SELECT * FROM  interested_users_properties iup INNER JOIN properties p ON iup.property_id = p.id WHERE p.id = '$property_id'";
$result_3 = mysqli_query($conn,$sql_3);
if(!$result_3)
{
    echo "Error : ".mysqli_error($conn);
    return ;
}
$interested_users_property = mysqli_fetch_all($result_3,MYSQLI_ASSOC);

$sql_4 = "SELECT * FROM properties_amenities pa INNER JOIN amenities a ON pa.amenity_id = a.id WHERE pa.property_id = '$property_id' ";
$result_4 = mysqli_query($conn,$sql_4);
if(!$result_4)
{
    echo "Error : ".mysqli_error($conn);
    return;
}
$amenities = mysqli_fetch_all($result_4 , MYSQLI_ASSOC);
if(!$amenities)
{
    echo "No amenities are there in this property !";
    return;
}
$sql_5="SELECT * from testimonials t WHERE t.property_id=$property_id";
$result_5=mysqli_query($conn,$sql_5);
if(!$result_5)
{
    echo "Error : ".mysqli_error($conn);
    return ;
}
$testimonials = mysqli_fetch_all($result_5,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $property['name']?> | PG Life</title>

    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet" />
    <link href="css_1/common.css" rel="stylesheet" />
    <link href="css_1/property_detail.css" rel="stylesheet" />
    <link href="css_1/home.css" rel="stylesheet"/>
    
    <script src="https://kit.fontawesome.com/356c2b5dab.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include "includes/header.php";
    include "includes/login_modal.php";
    include "includes/signup_modal.php";
   ?>
    <div id="loading">
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb py-2">
            <li class="breadcrumb-item">
                <a class="color"  href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a class="color" href="property_list.php?city=<?= $property_city['name']?>"><?php echo $property_city['name']?></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                 <?php echo $property['name']?>
            </li>
        </ol>
    </nav>

    <div id="carouselExampleIndicators" class="carousel slide"  data-bs-ride="carousel">
        <?php
        $property_images = glob("img/properties/".$property_id."/*");
        ?>
      <div class="carousel-indicators">
       <?php
         foreach($property_images as $index => $property_image){
       ?>
    <button type="button" data-bs-target="#carouselExampleIndicators" class="<?= $index == 0 ? "active" : "";?>" data-bs-slide-to="<?= $index?>"   aria-label="Slide <?= $index?>" aria-current = "<?= $index == 0 ? "true":"false";?>"></button>
    <?php
    /*
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    */
    }
    ?>
  </div>
  <div class="carousel-inner" >
    <?php
      foreach($property_images as $index => $property_image){
    ?>
    <div class="carousel-item <?= $index == 0 ? "active":"";?> " data-bs-interval="2500" >
      <img src="<?= $property_image ?>" class="d-block w-100" alt="Slide <?php echo $index?>">
    </div>
    <?php
      }
    ?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
    <?php 
    /*<div id="property-images" class="carousel slide" data-ride="carousel">
        <?php
         $property_images = glob("img/properties/".$property_id."/*");
        ?>
        <ol class="carousel-indicators">
            <?php
             foreach($property_images as $index => $property_image){
            ?>
            <li data-target="#property-images" data-slide-to="<?= $index?>" ></li>
            <?php
            }
            ?> 
        </ol>
        <div class="carousel-inner">
            <?php
           foreach($property_images as $index => $property_image){
            ?>
            <div class="carousel-item <?= $index == 0 ? "active" : ""; ?>">
                <img class="d-block w-100" src="<?= $property_image?>" alt="slide">
            </div>
            <?php
            }
            ?>
        </div>
        <a class="carousel-control-prev" href="#property-images" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#property-images"  role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    
    </div>
    */
    ?>
    
    <?php
    $total_rating = ($property['rating_clean'] + $property['rating_food'] + $property['rating_safety'])/3;
    $total_rating = round($total_rating,1);
    ?>
    <div class="property-summary page-container">
        <div class="row no-gutters justify-content-between">
            <div class="star-container" title="<?= $total_rating?>">
                <?php 
                   $rating = $total_rating;
                   for($i = 0;$i < 5;$i++)
                   {
                       if($rating >= $i + 0.8){
                       ?>
                       <i class="fas fa-star"></i>
                       <?php 
                       } elseif($rating >= $i + 0.3){
                       ?>
                       <i class="fas fa-star-half-alt"></i>
                       <?php
                       }  else{
                       ?> 
                       <i class="far fa-star"></i>
                       <?php
                       }   
                   }
                ?>
               
            </div>
            <?php
                      $interested_users_count = 0;
                      $is_interested = false;
                      
                      foreach($interested_users_property as $interested_user_property)
                      {
                          if($interested_user_property['property_id'] == $property_id)
                          {
                              $interested_users_count++;
                              if($interested_user_property['user_id'] == $user_id )
                              {
                                  $is_interested = true;
                                }
                            }
                        }
            ?>
                    <div class="interested-container">
                        <?php 
                         if($is_interested){
                        ?> 
                            <i class="is-interested-image fas fa-heart"></i>
                        <?php } else{
                        ?>
                            <i class="is-interested-image far fa-heart"></i>
                        <?php
                        }
                        ?>
                            <div class="interested-text">
                    <span class="interested-user-count"><?php echo $interested_users_count?></span> interested
                </div>
            </div>
        </div>
        <div class="detail-container">
            <div class="property-name"><?php echo $property['name']?></div>
            <div class="property-address"><?php echo $property['address'] ?></div>
            <div class="property-gender">
                <?php
                  if($property['gender'] == "male"){
                ?>
                  <img src="img/male.png"/>
                <?php 
                  } elseif($property['gender'] == "female"){
                ?>
                  <img src="img/female.png"/>
                <?php 
                  } 
                ?>  
            </div>
        </div>
        <div class="row no-gutters">
            <div class="rent-container col-6">
                <div class="rent"><?php echo number_format($property['rent']) ?>/-</div>
                <div class="rent-unit">per month</div>
            </div>
            <div class="button-container col-6">
                <a href="#" class="btn btn-success">Book Now</a>
            </div>
        </div>
    </div>
    
    <div class="property-amenities">
        <div class="page-container">
            <h1>Amenities</h1>
            <div class="row justify-content-between">
                <div class="col-md-auto">
                    <h5>Building</h5>
                    <div class="amenity-container">
                        <?php 
                        foreach($amenities as $amenity){
                            if($amenity['name'] == "Wifi"){
                        ?>
                            <img src="img/amenities/wifi.svg">
                            <span>Wifi</span>
                        <?php 
                        } elseif($amenity['name'] == "Power Backup"){
                        ?>
                            <img src="img/amenities/powerbackup.svg"/>
                            <span>Power Backup</span>
                        <?php 
                        } elseif($amenity['name'] == "Fire Extinguisher"){
                        ?>
                            <img src="img/amenities/fireext.svg"/>
                            <span>Fire Extinguisher</span> 
                        <?php 
                         } elseif($amenity['name'] == "TV"){
                            ?>
                                <img src="img/amenities/fireext.svg"/>
                                <span>Fire Extinguisher</span> 
                        <?php
                         } elseif($amenity['name'] == "Bed with Mattress"){
                        ?>
                                <img src="img/amenities/bed.svg"/>
                                <span>Bed with Mattress</span> 
                        <?php
                        } elseif($amenity['name'] == "Parking"){
                        ?>
                                <img src="img/amenities/parking.svg"/>
                                <span>Parking</span> 
                        <?php
                        } elseif($amenity['name'] == "Water Purifier"){
                            ?>
                                <img src="img/amenities/cctv.svg"/>
                                <span>Water Purifier</span> 
                        <?php
                        } elseif($amenity['name'] == "Dining"){
                            ?>
                                <img src="img/amenities/dining.svg"/>
                                <span>Dining</span> 
                        <?php
                        } elseif($amenity['name'] == "Air Conditioner"){
                            ?>
                                <img src="img/amenities/cctv.svg"/>
                                <span>Air Conditioner</span> 
                        <?php
                        } elseif($amenity['name'] == "Washing Machine"){
                            ?>
                                <img src="img/amenities/washingmachine.svg"/>
                                <span>Washing Machine</span> 
                        <?php
                        } elseif($amenity['name'] == "Lift"){
                            ?>
                                <img src="img/amenities/lift.svg"/>
                                <span>Lift</span> 
                        <?php
                        } elseif($amenity['name'] == "CCTV"){
                            ?>
                                <img src="img/amenities/cctv.svg"/>
                                <span>CCTV</span> 
                        <?php
                        } elseif($amenity['name'] == "Geyser"){
                            ?>
                                <img src="img/amenities/geyser.svg"/>
                                <span>Geyser</span> 
                        <?php 
                        }
                      }
                    ?>
                    </div>
                    
                </div>


            </div>
        </div>
    </div>

    <div class="property-about page-container">
        <h1>About the Property</h1>
        <p><?php echo $property['description']?></p>
    </div>

    <div class="property-rating">
        <div class="page-container">
            <h1>Property Rating</h1>
            <div class="row align-items-center justify-content-between">
                <div class="col-md-6">
                    <div class="rating-criteria row">
                        <div class="col-6">
                            <i class="rating-criteria-icon fas fa-broom"></i>
                            <span class="rating-criteria-text">Cleanliness</span>
                        </div>
                        <div class="rating-criteria-star-container col-6" title="<?=$property['rating_clean']?>">
                          <?php
                            $rating = $property['rating_clean'];
                            for($i=0;$i<5;$i++)
                             {
                               if($rating>= $i + 0.8){
                            ?>
                                <i style="color: marine;" class="fas fa-star"></i>        
                            <?php
                            } else if($rating>= $i + 0.3){
                            ?>
                                <i style="color: marine;" class="fas fa-star-half-alt"></i>
                            <?php
                            } else{
                            ?>
                                <i style="color: marine;" class="far fa-star"></i>
                            <?php
                            }             
                            }
                          ?>
                       
                        </div>
                    </div>

                    <div class="rating-criteria row">
                        <div class="col-6">
                            <i class="rating-criteria-icon fas fa-utensils"></i>
                            <span class="rating-criteria-text">Food Quality</span>
                        </div>
                        <div class="rating-criteria-star-container col-6" title="<?=$property['rating_food']?>">
                        <?php
                            $rating = $property['rating_food'];
                            for($i=0;$i<5;$i++)
                             {
                               if($rating>= $i + 0.8){
                            ?>
                                <i style="color: marine;" class="fas fa-star"></i>        
                            <?php
                            } else if($rating>= $i + 0.3){
                            ?>
                                <i style="color: marine;" class="fas fa-star-half-alt"></i>
                            <?php
                            } else{
                            ?>
                                <i style="color: marine;" class="far fa-star"></i>
                            <?php
                            }             
                            }
                          ?>
                            
                        </div>
                    </div>

                    <div class="rating-criteria row">
                        <div class="col-6">
                            <i class="rating-criteria-icon fa fa-lock"></i>
                            <span class="rating-criteria-text">Safety</span>
                        </div>
                        <div class="rating-criteria-star-container col-6" title="<?= $property['rating_safety']?>">
                        <?php
                            $rating = $property['rating_safety'];
                            for($i=0;$i<5;$i++)
                             {
                               if($rating>= $i + 0.8){
                            ?>
                                <i style="color: marine;" class="fas fa-star"></i>        
                            <?php
                            } else if($rating>= $i + 0.3){
                            ?>
                                <i style="color: marine;" class="fas fa-star-half-alt"></i>
                            <?php
                            } else{
                            ?>
                                <i style="color: marine;" class="far fa-star"></i>
                            <?php
                            }             
                            }
                          ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="rating-circle">
                        <?php
                        $total_rating = ($property['rating_food']+$property['rating_clean']+$property['rating_safety'])/3;
                        $total_rating=round($total_rating,1);
                        ?>
                        <div class="total-rating"><?php echo $total_rating?></div>
                        <div class="rating-circle-star-container">
                        <?php
                            $rating = $total_rating;
                            for($i=0;$i<5;$i++)
                             {
                               if($rating>= $i + 0.8){
                            ?>
                                <i style="color: marine;" class="fas fa-star"></i>        
                            <?php
                            } else if($rating>= $i + 0.3){
                            ?>
                                <i style="color: marine;" class="fas fa-star-half-alt"></i>
                            <?php
                            } else{
                            ?>
                                <i style="color: marine;" class="far fa-star"></i>
                            <?php
                            }             
                            }
                          ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="property-testimonials page-container">
        <h1>What people say </h1>
        <?php
        foreach($testimonials as $testimonial){
        ?>
        <div class="testimonial-block">
            <div class="testimonial-image-container">
                <img class="testimonial-img" src="img/man.png">
            </div>
            <div class="testimonial-text">
                <i class="fa fa-quote-left" aria-hidden="true"></i>
                <p><?php echo $testimonial['content']?></p>
            </div>
            <div class="testimonial-name">- <?php echo $testimonial['user_name']?></div>
        </div>
        <?php
        }
        ?>
       
    </div>

<?php
    /*<div class="modal fade" id="signup-modal" tabindex="-1" role="dialog" aria-labelledby="signup-heading" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signup-heading">Signup with PGLife</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="signup-form" class="form" role="form">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="full_name" placeholder="Full Name" maxlength="30" required>
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-phone-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="phone" placeholder="Phone Number" maxlength="10" minlength="10" required>
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                            <input type="password" class="form-control" name="password" placeholder="Password" minlength="6" required>
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-university"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="college_name" placeholder="College Name" maxlength="150" required>
                        </div>

                        <div class="form-group">
                            <span>I'm a</span>
                            <input type="radio" class="ml-3" id="gender-male" name="gender" value="male" /> Male
                            <label for="gender-male">
                            </label>
                            <input type="radio" class="ml-3" id="gender-female" name="gender" value="female" />
                            <label for="gender-female">
                                Female
                            </label>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary">Create Account</button>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <span>Already have an account?
                        <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#login-modal">Login</a>
                    </span>
                </div>
            </div>
        </div>
    </div>*/
?>
    
    <?php
    /* <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-heading" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="login-heading">Login with PGLife</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="login-form" class="form" role="form">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                            <input type="password" class="form-control" name="password" placeholder="Password" minlength="6" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary">Login</button>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <span>
                        <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#signup-modal">Click here</a>
                        to register a new account
                    </span>
                </div>
            </div>
        </div>
    </div>*/
    ?>
    <?php
      include "includes/footer.php";
      include "includes/login_modal.php";
      include "includes/signup_modal.php";
      //include "logout.php";
    ?>
    
    <script type="text/javascript" src="js/common.js"></script>
    <script type="text/javascript" src="js/common1.js"></script>
    <script type="text/javascript" src="js/property_detail.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
