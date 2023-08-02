<?php
$db_hostname="localhost:3307";
$db_username="root";
$db_password="";
$db_name="test";

$conn=mysqli_connect($db_hostname,$db_username,$db_password,$db_name);
if(!$conn)
{
    echo "Connection Error : ".mysqli_connect_error();
    exit;
}

$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
$password=sha1($password);
$phone_no=$_POST['phone_no'];
$college=$_POST['college'];

$sql_0 = "SELECT * FROM users WHERE email='$email'";
$result_0=mysqli_query($conn , $sql_0);
if(!$result_0)
{    
    $response = array("success"=>false , "message"=>"Something went wrong!!");
    echo json_encode($response);
    return;
    //echo "Error : ".mysqli_error($conn);
    //exit;
}
$row_count = mysqli_num_rows($result_0);
if($row_count != 0)
{    
    $response = array("success"=>false , "message"=>"This E-Mail is already registered with us!");
    echo json_encode($response);
    return;
    //$_SESSION['signup_failed'] = true;
    //header("location:../index.php");
    //exit;
}

$sql="INSERT INTO users(name,email,password,phone_no,college_name) VALUES('$name','$email','$password','$phone_no','$college')";
$result=mysqli_query($conn,$sql);
if(!$result)
{
    $response = array("sucess"=>false , "message"=>"Something went wrong!!!");
    echo json_encode($response);
    return;
    //echo "Error : ".mysqli_error($conn);
    //exit;
}
$response = array("sucess"=>true , "message"=>"Registration Successful!!!");
echo json_encode($response);
return; 
?>
<?php
/*<head>
    <link rel="stylesheet" href="signup.css"/>
</head>
<body>
<h1 class="heading">Registration Successful !!!</h1>
<p style="text-align: center;">Click <a href="../index.php"> here </a> to continue.</p>
</body>*/
?>
