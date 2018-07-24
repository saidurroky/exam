<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath."/../lib/Session.php");
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');

	class Process{
		private $db;
		private $fm;
		function __construct(){
			$this -> db = new Database();
			$this -> fm = new Format();
		}

		public function getProcess($data){
			$selectedAns = mysqli_real_escape_string($this ->db ->link, $data['ans']);
			$number = mysqli_real_escape_string($this ->db ->link, $data['number']);

			$next = $number + 1;

			if(!isset($_SESSION['score'])){
				$_SESSION['score'] = 0;
			}

			$total = $this ->getTotal();
			$right    = $this ->rightAns($number);

			if($right == $selectedAns){
				$_SESSION['score']++;
			}

			if($number == $total){
				header("location:final.php");
				exit();
			}else{
				header("location:test.php?q=".$next);
			}
		}

		private function getTotal(){
			$query = "SELECT * FROM tbl_ques";
			$result = $this ->db ->select($query);
			$totalrows = $result ->num_rows;
			return $totalrows;
		}

		private function rightAns($number){
			$query = "SELECT * FROM tbl_ans WHERE quesNo = '$number' AND rightAns = '2' ";
			$totalrows = $this ->db ->select($query) ->fetch_assoc();
			$result = $totalrows['id'];
			return $result;
		}
	}
?>