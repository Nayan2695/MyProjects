<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Login";

$conn = mysqli_connect($servername, $username, $password,$dbname);
if($conn === false)
 {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$request = $_REQUEST['request'];
switch($request)
{
	case 'adddata':
  {
		insertdata();
		break;
  }
  case 'login':
  {
    userlogin();
  }
  case 'addcompanyinfo':
  {
     insertcompanyinfo();
  }
  case 'getinfo':
  {
    getcompanyinfo();
  }
	default:
	break;
}
function errorLog($log)
{
    $logDate=date("\n y-m-d h:i:s: ");
    $logFile=fopen("error_log.txt","a+") or die("Unable to create log file");
    fwrite($logFile,$logDate);
    fwrite($logFile,$log);
}
function insertdata()
{
  global $conn;
	$Fname = $_POST['fname'];
	$Lname = $_POST['lname'];
	$Email = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword =md5($_POST['cpassword']);
  $result=array();
	$result["result"]=-1;
	$result["msg"]="Could not add data.";
  if($password!=$cpassword){
     echo json_encode($result);
     exit;
  }
  $query="SELECT Email FROM user WHERE Email='".$Email."'";
  //errorLog($query);
  $queryresult=mysqli_query($conn,$query);
  if($queryresult->num_rows==0)
  {
    $query2="insert into user(FirstName,LastName,Email,Password) values ('$Fname', '$Lname','$Email', '$password')";
    //errorLog($query2);
    $queryresult2= mysqli_query($conn,$query2);
    if($queryresult2)
    {
      $result["result"]=1;
      $result["msg"]="Data added successfully.";
    }
  }
	echo json_encode($result);
	mysqli_close($conn);
	exit;
}
function userlogin()
{
  global $conn;
  $email=$_POST['MAILID'];
  $password=md5($_POST['Password'] );
  $result=array();
  $result["result"]=-1;
	$result["msg"]="Invalid username / password";
  $query1="SELECT id FROM user WHERE Email='$email' AND Password='$password'";
  $queryresult1= mysqli_query($conn,$query1);
  if($queryresult1->num_rows>0)
   {
     $result["result"]=1;
     $result["msg"]="logged in successfully";
  }
  echo json_encode($result);
	mysqli_close($conn);
	exit;
}
function insertcompanyinfo()
{
  global $conn;
	$name = $_POST['name'];
	$Address = $_POST['Address'];
	$City = $_POST['City'];
	$State = $_POST['State'];
	$Zipcode = $_POST['ZipCode'];
  $Country = $_POST['Country'];
  $result=array();
	$result["result"]=-1;
	$result["msg"]="Could not add data.";
  if($Zipcode== null || $Zipcode == " " && $Country == null || $Country == " ")
  {
    echo json_encode($result);
    exit;
  }
  if(empty($name))
  {
   echo json_encode($result);
   exit;
  }
	$qry1="insert into companyinfo(CompanyName,Address,City,State,ZipCode,Country) values ('$name', '$Address','$City', '$State','$Zipcode','$Country')";
  errorLog($qry1);
	$queryresult1 = mysqli_query($conn,$qry1);
  if($queryresult1)
  {
    $result["result"]=1;
    $result["msg"]="Data added successfully.";
  }
	echo json_encode($result);
	mysqli_close($conn);
	exit;
}
function getcompanyinfo()
{
  global $conn;
	$result=array();
	$result["result"]=-1;
	$result["data"]=array();
	$result["msg"]="No data found.";
	$query3 ="SELECT C.CompanyName,C.Address,C.City,C.State,C.ZipCode,C.Country FROM companyinfo C";
  $queryresult3= mysqli_query($conn,$query3);
	if($queryresult3->num_rows>0)
	{
		$result["result"]=1;
		$result["msg"]="Data found.";
		while($rows = mysqli_fetch_assoc($queryresult3))
		{
			array_push($result["data"],$rows);
		}
	}
	echo json_encode($result);
	mysqli_close($conn);
	exit;
}
?>
