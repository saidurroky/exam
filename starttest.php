<?php 
	include 'inc/header.php';
	Session::checkSession();
	
	$exm = new Exam();
	$getfrstques = $exm->getFirstQuestion();
	$gettotal = $exm->getTotalRows();
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
<h1>Welcome to Online Exam</h1>
	
	<div class="strttest">
		<h2>Test your exam</h2>
		<p>This is multiple quiz test your knowledge</p>
		<ul>
			<li><strong>Number of questions : </strong><?php echo $gettotal; ?></li>
			<li><strong>Question Type : </strong>Multiple Choice</li>
		</ul>
		<a href="test.php?q=<?php echo $getfrstques['quesNo']; ?>">Start Test</a>
	</div>
	
 </div>
<?php include 'inc/footer.php'; ?>