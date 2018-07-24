<?php
 include 'inc/header.php';
 Session::checkSession();

 if (isset($_GET['q'])) {
 	$qnumber = (int)$_GET['q'];
 }else{
 	header("Location.exam.php");
 }

 $gettotal = $exm->getTotalRows(); 
 $crntqstn = $exm->getCrrntQuestion($qnumber);

 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 	$process = $pro->getProcess($_POST);
 }
?>
<div class="main">
<h1>Question <?php echo $crntqstn['quesNo']; ?> of <?php echo $gettotal; ?></h1>
	<div class="test">
		<form method="post" action="">
		<table> 
			<tr>
				<td colspan="2">
				 <h3>Que <?php echo $crntqstn['quesNo']; ?>: <?php echo $crntqstn['ques']; ?></h3>
				</td>
			</tr>
	<?php 
		$answer = $exm->getAnswer($qnumber);
		if ($answer) {
			while ($result = $answer->fetch_assoc()) {
			
	?>
			<tr>
				<td>
				 <input type="radio" name="ans" value="<?php echo $result['id']; ?>" /><?php echo $result['ans']; ?>
				</td>
			</tr>
			
	<?php } } ?>
			<tr>
			  <td>
				<input type="submit" name="submit" value="Next Question"/>
				<input type="hidden" name="number" value="<?php echo $qnumber; ?>" />
			</td>
			</tr>
		</table>
	</form>
</div>
 </div>
<?php include 'inc/footer.php'; ?>