<?php 
session_start();
//require "../includes/database_connect.php";
$conn = mysqli_connect("localhost:3307","root","","test");
if(!$conn){
    echo json_encode("Something went wrong ! cannot made connection to database");
    return;
}
if (!isset($_SESSION['user_id'])) {
    echo json_encode(array("success"=>false , "is_logged_in"=>false));
    return;
}
$user_id = $_SESSION['user_id'];
$property_id = $_GET['property_id'];

$sql_1 = "SELECT * FROM interested_users_properties WHERE user_id= $user_id AND property_id = $property_id";
$result1 = mysqli_query($conn,$sql_1);
if(!$result1){
    echo json_encode(array("success"=> false ,"property_id"=>$property_id ,"message"=>"Something went wrong-1 !"));
    return;
}
$row = mysqli_fetch_assoc($result1);
if(mysqli_num_rows($result1) > 0){
    $sql_2 = "DELETE FROM interested_users_properties WHERE user_id = $user_id AND property_id = $property_id";
    $result2 = mysqli_query($conn,$sql_2);
   if(!$result2){
       echo json_encode(array("success"=>false ,"property_id"=>$property_id ,"message"=>"Something went wrong-2 !"));
       return;
   }
   else
   {
       echo json_encode(array("success"=>true , "is_interested"=>false , "property_id"=>$property_id));
       return;
   }
} else {
   $sql_3 = "INSERT INTO interested_users_properties(user_id,property_id) VALUES('$user_id','$property_id')";
   $result3 = mysqli_query($conn,$sql_3);
   if(!$result3){
       echo json_encode(array("success" =>false ,"property_id"=>$property_id ,"message"=>"Something went wrong-3!"));
       return;
   }
   else
   {
       echo json_encode(array("success" => true , "is_interested"=>true , "property_id"=>$property_id));
       return;
   }
}
