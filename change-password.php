<?php
session_start();
error_reporting(0);
include('config.php');
if(strlen($_SESSION['login'])==0)
    {   
    header("Location: index.php"); 
    }
    else{
// full Code for change password

if(isset($_POST['change']))   	
{
$email=$_SESSION['login'];
$oldpass=md5($_POST['oldpass']);
 $newpass=md5($_POST['newpass']);
 // Code for vefify current Password
 $query2 = $dbh->prepare("SELECT Password FROM  tblregistration WHERE EmailId =:email and Password=:oldpass");
$query2->bindParam(':email', $email, PDO::PARAM_STR);
$query2->bindParam(':oldpass', $oldpass, PDO::PARAM_STR);
$query2-> execute();
$results = $query2->fetchAll(PDO::FETCH_OBJ);
if($query2->rowCount() > 0)
{

//Ocde for check last 3 password by using array_push and in_array
$query=$dbh->prepare("SELECT * FROM tblpasswordhistory WHERE UserEmail=:email order by id desc limit 3");
$query->bindParam(':email', $email, PDO::PARAM_STR);
$query-> execute();
$resultss = $query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
$passwrd=array();
foreach($resultss as $rt)
{
array_push($passwrd,$rt->password);
}

if(in_array($newpass,$passwrd))
{
    
$error="Your new Password should not be same as any of the prevoius 3 Passwords";

}

else {
// code for update the password	
$con="update tblregistration set Password=:cmppass where EmailId=:email";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1->bindParam(':cmppass', $newpass, PDO::PARAM_STR);
$chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
$chngpwd1->execute();
//Code for insertion new password in tblpassword history 
$sql="INSERT INTO tblpasswordhistory(UserEmail,password) VALUES(:email,:newpassrd)";
$query = $dbh->prepare($sql);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':newpassrd',$newpass,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Password changed successfully ";
}
}
}
else{
$error="Current password not matched ";
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
<script type="text/javascript">
function valid()
{
if(document.chngpwd.newpass.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.chngpwd.newpass.focus();
return false;
}
return true;
}
</script>
</head>
<body>
	<div class="main">
		<div class="header" >
			<h1>Welcome ----<?php echo htmlentities($_SESSION['fname']);?> | <a href="logout.php">Logout</a></h1>
		</div>
			<form   name="chngpwd" method="post" onSubmit="return valid();">
				<ul class="left-form">
					<h2>User Change Password</h2>
 <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

					<li>
						<input type="password"   placeholder="Current Password" name="oldpass" id="oldpass" autocomplete="off" required/>
					
						<div class="clear"> </div>
					</li> 
					<li>
						<input type="password"   placeholder="New Password" name="newpass" id="newpass" autocomplete="off" required/>
						
						<div class="clear"> </div>
					</li> 
					<li>
						<input type="password"  name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" autocomplete="off" required/>
					
						<div class="clear"> </div>
					</li> 
					
				
					<input type="submit" name="change" value="Change">
						<div class="clear"> </div>
				</ul>
				</form>
				<div class="clear"> </div>
		</div>
			<!-----start-copyright---->
   					<div class="copy-right">
						<p>Powered By <a href="https://phpgurukul.com" target="_blank"> PHPGurukul</a></p> 
					</div>
				<!-----//end-copyright---->

	
</body>
</html>
<?php } ?>