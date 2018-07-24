<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classes/Exam.php');
	$exm = new Exam();
?>
<style>
.adminpanel{width: 480px;color: #999;margin: 20px auto 0;padding: 10px;border: 1px solid #ddd}
</style>
<?php
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$addquestion = $exm -> addQuestion($_POST);
	}

	//get ques no

	$getqsnNo = $exm ->getTotalRows();
	$number = $getqsnNo+1;
?>
<div class="main">
	<h1>Admin Panel - Add Question</h1>
	<?php
		if(isset($addquestion)){
			echo $addquestion;
		}
	?>

	<div class="adminpanel">
		<form actio="" method="post">
			<table>
				<tr>
					<td>Question no</td>
					<td>:</td>
					<td><input type="number" value="<?php
														if(isset($number)){
															echo $number ;
														}  ?>" name="quesNo"></td>
				</tr>
				<tr>
					<td>Question</td>
					<td>:</td>
					<td><input type="text" name="ques" placeholder="enter your question"></td>
				</tr>
				<tr>
					<td>Choise One</td>
					<td>:</td>
					<td><input type="text" name="ans1" placeholder="enter your Choise One"></td>
				</tr>
				<tr>
					<td>Choise Two</td>
					<td>:</td>
					<td><input type="text" name="ans2" placeholder="enter your Choise Two"></td>
				</tr>
				<tr>
					<td>Choise Three</td>
					<td>:</td>
					<td><input type="text" name="ans3" placeholder="enter your Choise Three"></td>
				</tr>
				<tr>
					<td>Choise Four</td>
					<td>:</td>
					<td><input type="text" name="ans4" placeholder="enter your Choise Four"></td>
				</tr>
				<tr>
					<td>Correct Answer</td>
					<td>:</td>
					<td><input type="number" name="rightAns" required ></td>
				</tr>
				<tr>
					<td colspan="3" align="center" >
						<input type="submit" value="Add Question">
					</td>
				</tr>
			</table>
		</form>
	</div>

	
</div>
<?php include 'inc/footer.php'; ?>