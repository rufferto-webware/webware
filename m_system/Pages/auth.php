<?PHP
ob_start();
if(!isset($_SESSION)) session_start();
include_once($_SESSION['file_root'].'/lib/Common.inc.php');
if(empty($_SESSION['login_return_too']))
	$_SESSION['login_return_too']=$_SERVER['HTTP_REFERER'] ; 

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 40%;
  border-radius: 5%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>

<?PHP
$DB= new ww_db;

if(!empty($_POST['l_uname']) && !empty($_POST['l_psw']))
{
	$sql="SELECT *,CONCAT(`fname`,' ',`lname`) as name FROM `system_user` 
					
						WHERE `loginname` = '".$_POST['l_uname']."'";
	$res=$DB->query($sql);
	$num=$DB->numrows($res);
	$t_logon=0;
	if($num==1)
	{
		$var=$DB->fetch_array($res);
		if(password_verify( $_POST['l_psw'],$var['password'] ) )
		{
			$t_logon=1;
		}
	}
	else
	{
		echo "<h2>!!! SOMETHING WENT WRONG !!!!( $num )</h2>";
	}
	
	if($t_logon==1)
	{
		
		echo "Logon complete (".$_SESSION['login_return_too'].")";
		$_SESSION['g_userID']=$var['uID'];
		$_SESSION['g_username']=$var['name'];
		$sql="UPDATE `system_user` SET 	`lastlogin`= NOW()	WHERE `uID` = '".$var['uID']."' ";
		$res=$DB->query($sql);

		if(file_exists('../../Config/web_path.php'))
			@$temp_path= include '../../Config/web_path.php';
		elseif(file_exists('../Config/web_path.php'))
			@$temp_path= include '../Config/web_path.php';
		else	
			@$temp_path= include './Config/web_path.php';

		$_SESSION['file_root']=$temp_path['file_path'];
		$_SESSION['url_root']=$temp_path['web_path'];
		unset($_SESSION['login_return_too']);
		/// security  Group
		$u_group=sec_db_get_user_groups($var['uID']);
		//echo "<p>";var_dump($u_group); 		

		if(is_array($u_group))
		foreach($u_group as $Egroup)
		{
			//echo "<br> adding group: ".$Egroup['name'];
			$group_rights=sec_db_get_group_rights($Egroup['id']);
			$_SESSION['g_priv']['group'][$Egroup['name']]=1;
			//echo "<p>";var_dump($group_rights);
			if(is_array($group_rights))
			foreach($group_rights as $Rgroup)
			{
			//	echo "<p> _SESSION['g_priv']['security'][".$Rgroup['name']."][".$Rgroup['level']."][".$Rgroup['dept']."]=1"	;				
				$_SESSION['g_priv']['security'][$Rgroup['name']][$Rgroup['level']][$Rgroup['dept']]=1;					
			}
		/// security  User
		$u_rights=sec_db_get_user_rights($var['uID']);
//		echo "<p>";var_dump($u_rights); 		
		if(is_array($u_rights))
		foreach($u_rights as $Rgroup)
		{
		//	echo "<p> _SESSION['g_priv']['security'][".$Rgroup['name']."][".$Rgroup['level']."][".$Rgroup['dept']."]=1"	;
			if($Rgroup['access']==1)
			{				
				$_SESSION['g_priv']['security'][$Rgroup['name']][$Rgroup['level']][$Rgroup['dept']]=1;
			}
			else
			{						
				unset($_SESSION['g_priv']['security'][$Rgroup['name']][$Rgroup['level']][$Rgroup['dept']]);
				if(count($_SESSION['g_priv']['security'][$Rgroup['name']][$Rgroup['level']])==0)
					unset($_SESSION['g_priv']['security'][$Rgroup['name']][$Rgroup['level']]);
			}
		}
		
			
		}

		
	//	echo "<p>Rights: <br><pre>";var_dump($_SESSION['g_priv']);
	//	exit();
		echo " <script type='text/javascript'>\n     window.location = '".$_SESSION['login_return_too']."';\n </script>		";
	}
	else
	{
		echo "Logon Failed";
	}
//	exit();
	
}
else
{
	if(!empty($_GET['logoff']) && $_GET['logoff']='Yes')
	{
		
		$login_return_too=$_SESSION['login_return_too'];
		$_SESSION = array();
		if (ini_get("session.use_cookies")) 
		{
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}
		session_destroy();
		session_start(); 
		session_regenerate_id(true);
		
	echo "<BR>: ".$login_return_too;
	echo " <script type='text/javascript'>\n     window.location = '".$login_return_too."';\n </script>		";
	exit();
	//*/
	}	
}	



?>
<div id="id01" class="modal">
  
  <form class="modal-content animate"  method="post">
    <div class="imgcontainer">
	<?PHP echo $_SESSION['login_return_too']; ?>
      <img src="<?PHP echo $_SESSION['url_root'];?>/images/logo.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input id="username" type="text" placeholder="Enter Username" name="l_uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="l_psw" required>
        
      <button type="submit">Login</button>
    </div>

  </form>
</div>

<script>
document.getElementById('id01').style.display='block';
document.getElementById('username').focus();
var status=1;
// Get the modal

var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) 
	{
			remove();
   }
  else 
  {
    if (status==0) 
	  
			modal.style.display='block';
			status=1;
			document.getElementById('username').focus();
  }
}
function remove()
{
			modal.style.display = "none";
			status=0;
 	
}
</script>

</body>
</html>
