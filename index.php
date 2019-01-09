<?php
session_start();
error_reporting(0);
include('config.php');
if(isset($_POST['submit']))
  {
$fullname=$_POST['fname'];
$email=$_POST['email'];
$password=md5($_POST['password']);
// Code for check email availability
$rt="SELECT * from tblregistration where EmailId=:email";
$query2= $dbh -> prepare($rt);
$query2->bindParam(':email', $email, PDO::PARAM_STR);
$query2-> execute();
$results = $query2->fetchAll(PDO::FETCH_OBJ);
if($query2->rowCount() > 0)
{
$error="Email id already registered ";
}
else{
$sql="INSERT INTO  tblregistration(FullName,EmailId,Password) VALUES(:fullname,:email,:password)";
$query = $dbh->prepare($sql);
$query->bindParam(':fullname',$fullname,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
// code for insert password into passhistory table.
$ret="INSERT INTO tblpasswordhistory(UserEmail,password) VALUES(:email,:password)";
$query1 = $dbh->prepare($ret);
$query1->bindParam(':email',$email,PDO::PARAM_STR);
$query1->bindParam(':password',$password,PDO::PARAM_STR);
$query1->execute();	
$msg="Your info submitted successfully";
}
else 
{
$error="Something went wrong. Please try again";
}
}
}
// code for login
if(isset($_POST['login']))
{
$email=$_POST['emailid'];
$password=md5($_POST['password']);
$sql ="SELECT EmailId,Password,FullName FROM tblregistration WHERE EmailId=:email and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0)
{
foreach ($results as $result) {
$_SESSION['fname']=$result->FullName;
$_SESSION['login']=$_POST['emailid'];
echo "<script type='text/javascript'> document.location ='change-password.php'; </script>";

}

} 

else{
echo "<script>alert('Invalid Details');</script>";
}
}

?>


<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<link href="css/style.css" rel='stylesheet' type='text/css' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text.css'/>
		<style>
    .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
</style>
</head>
<body>
	<div class="main">
		<div class="header" >
			<h1>Login or Create a Free Account!</h1>
		</div>
			<form method="post">
				<ul class="left-form">
					<h2>New Account:</h2>
 <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

					<li>
						<input type="text"   placeholder="Full Name" name="fname" id="fname" autocomplete="off" required/>
					
						<div class="clear"> </div>
					</li> 
					<li>
						<input type="email"   placeholder="Email" name="email" id="email" autocomplete="off" required/>
						
						<div class="clear"> </div>
					</li> 
					<li>
						<input type="password"  name="password" id="password" placeholder="password" autocomplete="off" required/>
					
						<div class="clear"> </div>
					</li> 
					
				
					<input type="submit" name="submit" value="Create Account">
						<div class="clear"> </div>
				</ul>
				</form>

				<form method="post">
				<ul class="right-form">
					<h3>Login:</h3>
					<div>
						<li><input type="text"  placeholder="Reg Email" name="emailid" autocomplete="off" required/></li>
						<li> <input type="password"  placeholder="Password" name="password" required/></li>
							<h4>I forgot my Password!</h4>
							<input type="submit" name="login" value="Login" >
					</div>
					<div class="clear"> </div>
				</ul>
				<div class="clear"> </div>
					
			</form>
			
		</div>
			<!-----start-copyright---->
   					<div class="copy-right">
						<p>Powered By <a href="https://phpgurukul.com" target="_blank"> PHPGurukul</a></p> 
					</div>
				<!-----//end-copyright---->

	
</body>
</html>