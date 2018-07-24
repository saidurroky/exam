<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');

	class Exam{
		private $db;
		private $fm;
		function __construct(){
			$this -> db = new Database();
			$this -> fm = new Format();
		}

		public function getAllQuestion(){
			$query = "SELECT * FROM tbl_ques ORDER BY quesNo asc";
			$result = $this ->db ->select($query);
			return $result;
		}

		public function deleteQuestion($quesNo){
			$tables = array( "tbl_ans", "tbl_ques");

			foreach ($tables as $table) {
				$query = "DELETE FROM $table WHERE quesNo = '$quesNo'";

				$deletedrow = $this ->db ->delete($query);
				}
			if($deletedrow){

				$msg = "<span class='success'>Question deleted successfully</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Question is not deleted</span>";
				return $msg;
			}
		}
		public function getTotalRows(){
			$query = "SELECT * FROM tbl_ques";
			$result = $this ->db ->select($query);
			$totalrows = $result ->num_rows;
			return $totalrows;
		}

		public function getFirstQuestion(){
			$query = "SELECT * FROM tbl_ques";
			$result = $this ->db ->select($query);
			$total = $result ->fetch_assoc();
			return $total;
		}

		public function getCrrntQuestion($qnumber){
			$query = "SELECT * FROM tbl_ques WHERE quesNo = '$qnumber' ";
			$result = $this ->db ->select($query);
			$total = $result ->fetch_assoc();
			return $total;
		}

		public function getAnswer($qnumber){
			$query = "SELECT * FROM tbl_ans WHERE quesNo = '$qnumber' ";
			$result = $this ->db ->select($query);
			return $result;
		}

		public function addQuestion($data){
			$quesNo = mysqli_real_escape_string($this ->db ->link, $data['quesNo']);
			$ques = mysqli_real_escape_string($this ->db ->link, $data['ques']);
			$ans = array();
			$ans[1] =$data['ans1'];
			$ans[2] =$data['ans2'];
			$ans[3] =$data['ans3'];
			$ans[4] =$data['ans4'];
			$rightAns =$data['rightAns'];
			$query = "INSERT INTO tbl_ques(quesNo, ques) VALUES('$quesNo', '$ques')";
			$inserted_row = $this ->db ->insert($query);
			if($inserted_row){
				foreach ($ans as $key => $answer) {
					if($answer != ''){
						if($rightAns == $key){
							$rightquery = "INSERT INTO tbl_ans(quesNo, rightAns, ans) VALUES('$quesNo', '2', '$answer')";
						}else{
							$rightquery = "INSERT INTO tbl_ans(quesNo, rightAns, ans) VALUES('$quesNo', '1', '$answer')";
						}
						$inserted = $this ->db ->insert($rightquery);

						if($inserted){
							continue;
						}else{
							die('Error...');
						}
					}
				}

				$msg = "<span class='success'>Question added successfully</span>";
				return $msg;
			}
		}
	}
?>