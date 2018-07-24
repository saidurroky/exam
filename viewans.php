<?php
 include 'inc/header.php';
 Session::checkSession();

 $gettotal = $exm->getTotalRows(); 
?>
<style>
	.test a{text-decoration: none;background: #cfcfcf;padding: 8px;border: 1px solid #b0b0b0;display: block;text-align: center;color: #444;margin-top: 27px;font-size: 20px;}
</style>
<div class="main">
<h1>All questions and ans : <?php echo $gettotal; ?></h1>
	<div class="test">
		<table> 
		<?php
			$totalque = $exm->getAllQuestion();
			if ($totalque) {
				while ($crntqstn = $totalque->fetch_assoc()) {
		 ?>
			<tr>
				<td colspan="2">
		
				 <h3>Que <?php echo $crntqstn['quesNo']; ?>: <?php echo $crntqstn['ques']; ?></h3>
				</td>
			</tr>
	<?php 
		$qnumber =  $crntqstn['quesNo'];
		$answer = $exm->getAnswer($qnumber);
		if ($answer) {
			while ($result = $answer->fetch_assoc()) {
			
	?>
			<tr>
				<td>
				 <input type="radio"/>
				 	
					<?php
					 $rightans = $result['rightAns'];
					 if ($rightans == '2') { 
						echo "<span style='color:blue;'>".$result['ans']."</span>";
					 }else{
					 	echo $result['ans'];
					 } ?>
				</td>
			</tr>
			
	<?php } } ?>
			<tr>
			</tr>
	<?php } } ?>		
		</table>
	<a href="starttest.php">Start Test</a>
</div>
 </div>
<?php include 'inc/footer.php'; ?>