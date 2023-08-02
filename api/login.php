<?php
/*<head>
    <link href="../home.css" rel="stylesheet"/>
    <link href="../css/bootstrap.min.css" rel="stylesheet"/>
</head>
*/
?>
<?php
session_start();
$conn=mysqli_connect("localhost:3307","root","","test");
if(!$conn)
{
    echo "Connection Error : ".mysqli_connect_error();
    exit;
}
$email=$_POST['email'];
$password=$_POST['password'];
//$password=sha1($password);
$sql="SELECT * from users where email='$email' and password='$password'";
$result=mysqli_query($conn,$sql);
if(!$result)
{   $response = array("success"=>false , "message" => "Something went wrong ");
    echo json_encode($response);
    return;
    //echo "Error : ".mysqli_error($conn);
    //exit;
}
$row=mysqli_fetch_assoc($result);
if(!$row)
{   $response = array("success"=>false , "message"=> "E-Mail and password do not match !");
    echo json_encode($response);
    return;
    //$_SESSION['login_failed']=true;
    //header("location:../index.php");
    //exit ; 
}
$response = array("success"=> true , "message"=> "Logged in successfully!");
$_SESSION['user_id']=$row['id'];
$_SESSION['name']=$row['name'];
$_SESSION['email']=$row['email'];
//header("location:../index.php");

mysqli_close($conn);
echo json_encode($response);
return;
?>