<?php 
	include 'inc/header.php';
	Session::checkSession();
?>
<style>
	.strttest{border: 1px solid #f4f4f4;margin: 0 auto;padding: 20px;width: 594px;}
	.strttest h2{border-bottom: 1px solid #ddd;font-size: 22px;margin-bottom: 10px;padding-bottom: 10px;text-align: center;}
	.strttest p{margin: 13px 0 6px 0;}
	.strttest ul {list-style: none; margin: 0;padding: 0;}
	.strttest ul li{margin-bottom: 5px;}
	.strttest a{text-decoration: none;background: #cfcfcf;padding: 8px;border: 1px solid #b0b0b0;display: block;text-align: center;color: #444;margin-top: 27px;font-size: 20px;}
</style>
<div class="main">
<h1>You Are Done ! </h1>
	<div class="strttest">
		<p>Congrats ! You have just completed the test.</p>
		<p>Final Score : 
			<?php
				if (isset($_SESSION['score'])) {
					echo $_SESSION['score'];
					unset($_SESSION['score']);
				}
			 ?>
		</p>
		<a href="viewans.php">View Answer</a>
		<a href="starttest.php">Start Test</a>
	</div>
	
  </div>
<?php include 'inc/footer.php'; ?>