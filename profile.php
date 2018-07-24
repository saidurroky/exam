<?php include 'inc/header.php'; ?>
<?php 	
	Session::checkSession(); 
	$userid = Session::get("userId");
?>
<?php
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$updateuser = $usr ->updateUserData($userid, $_POST);
	}
?>
<style>
.profile{width: 440px;margin: 0 auto; border: 1px solid #ddd;padding:30px 50px  50px 140px;};
</style>

<div class="main">
<h1>Online Exam System - Your Profile</h1>
	<div class="profile">

	<form action="" method="post">
		<?php
			$getdata = $usr ->getUserData($userid);

			if($getdata){
				while ($result = $getdata ->fetch_assoc()) {
		?>
		<table class="tbl"> 
		<?php
			if(isset($updateuser)){
				echo $updateuser;
			}
		?>   
			 <tr>
			   <td>Name</td>
			   <td><input name="name" type="text" id="name" value="<?php echo $result['name'] ;?>"></td>
			 </tr>
			 <tr>
			   <td>Username </td>
			   <td><input name="username" type="text" id="username" value="<?php echo $result['username'] ;?>"></td>
			 </tr>
			  <tr>
			   <td>Email</td>
			   <td><input name="email" type="text" id="email" value="<?php echo $result['email'] ;?>"></td>
			 </tr>
			  <tr>
			  <td></td>
			   <td><input type="submit" id="update" value="Update">
			   </td>
			 </tr>
       </table>
     <?php } } ?>   
	   </form>
 
	</div>
</div>

<?php include 'inc/footer.php'; ?>