<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classes/User.php');
	$usr = new User();

?>
<?php
	if(isset($_GET['dis'])){
		$disId = $_GET['dis'];
		$disUser = $usr ->disableUser($disId);
	}
	if(isset($_GET['ena'])){
		$enaId = $_GET['ena'];
		$enaUser = $usr ->enableUser($enaId);
	}
	if(isset($_GET['del'])){
		$delId = $_GET['del'];
		$delUser = $usr ->deleteUser($delId);
	}
?>
<div class="main">
	<h1>Admin Panel - Manage User</h1>
	<?php
		if(isset($disUser)){
			echo $disUser ;
		}
		if(isset($enaUser)){
			echo $enaUser ;
		}
		if(isset($delUser)){
			echo $delUser ;
		}
	?>
	<div class="manageuser">
		<table class="tblone">
			<tr>
				<th>No.</th>
				<th>Name</th>
				<th>Username</th>
				<th>Email</th>
				<th>Action</th>
			</tr>
<?php
	$getuser = $usr ->getAllUser();
	if($getuser){
		$i = 0;
		while ($result = $getuser ->fetch_assoc()) {
			$i++;
?>
			<tr>
				<td><?php echo $i ;?></td>
				<td>
					<?php 
						if($result['status'] == '2'){
							echo "<span class='error'>".$result['name']."</span>";
						}else{
							echo $result['name'];
						}

					?>
				</td>
				<td><?php echo $result['username'] ;?></td>
				<td><?php echo $result['email'] ;?></td>
				<td>
					<?php if($result['status'] == '1'){ ?>
					<a onclick="return confirm('Are you sure to Disable')" href="?dis=<?php echo $result['userId'] ;?>">Disable</a>
					
					<?php }else{ ?>
					<a onclick="return confirm('Are you sure to Enable')" href="?ena=<?php echo $result['userId'] ;?>">Enable</a>
					<?php } ?>
					|| <a onclick="return confirm('Are you sure to Delete')" href="?del=<?php echo $result['userId'] ;?>">Remove</a>
				</td>
			</tr>
<?php } } ?>
		</table>
	</div>

	
</div>
<?php include 'inc/footer.php'; ?>