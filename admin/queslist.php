<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classes/Exam.php');
	$exm = new Exam();
?>
<?php
	if(isset($_GET['delque'])){
		$quesNo = $_GET['delque'];
		$delquestion = $exm ->deleteQuestion($quesNo);
	}
?>
<div class="main">
	<h1>Admin Panel - Question List</h1>
	<?php
		if(isset($delquestion)){
			echo $delquestion;
		}
	?>
	<div class="manageuser">
		<table class="tblone">
			<tr>
				<th width="10%">No.</th>
				<th width="70%">Questions</th>
				<th width="20%">Action</th>
			</tr>
<?php
	$getqsn = $exm ->getAllQuestion();
	if($getqsn){
		$i = 0;
		while ($result = $getqsn ->fetch_assoc()) {
			$i++;
?>
			<tr>
				<td><?php echo $i ;?></td>
				<td><?php echo $result['ques'] ;?></td>
				<td>
					<a onclick="return confirm('Are you sure to Delete')" href="?delque=<?php echo $result['quesNo'] ;?>">Remove</a>
				</td>
			</tr>
<?php } } ?>
		</table>
	</div>

	
</div>
<?php include 'inc/footer.php'; ?>