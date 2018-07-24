<?php include 'inc/header.php'; ?>
<?php 	
	Session::checkLogin(); 
?>

<div class="main">
<h1>Online Exam System - User Login</h1>
	<div class="segment" style="margin-right:30px;">
		<img src="img/test.png"/>
	</div>
	<div class="segment">
	<form action="" method="post">
		<table class="tbl">    
			 <tr>
			   <td>Email</td>
			   <td><input name="email" type="text" id="email"></td>
			 </tr>
			 <tr>
			   <td>Password </td>
			   <td><input name="password" type="password" id="password"></td>
			 </tr>
			 
			  <tr>
			  <td></td>
			   <td><input type="submit" id="login" value="Login">
			   </td>
			 </tr>
       </table>
	   </form>
	   <p>New User ? <a href="register.php">Signup</a> Free</p>

		<span class="empty" style="display:none;color:red">Field must not be empty</span>
		<span class="error" style="display:none;color:red">something wrong</span>
		<span class="disable" style="display:none;color:red">User Disable</span>
	</div>
</div>
<?php include 'inc/footer.php'; ?>