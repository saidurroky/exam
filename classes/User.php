<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
	include_once ($filepath.'/../lib/Session.php');

	class User{
		private $db;
		private $fm;
		function __construct(){
			$this -> db = new Database();
			$this -> fm = new Format();
		}

		public function getAllUser(){
			$query = "SELECT * FROM tbl_user ORDER BY userId asc";
			$result = $this ->db ->select($query);
			return $result;
		}

		public function getUserData($userid){
			$query = "SELECT * FROM tbl_user WHERE userId = '$userid'";
			$result = $this ->db ->select($query);
			return $result;
		}

		public function updateUserData($userid, $data){
			$name = $this ->fm -> validation($data['name']);
			$username = $this ->fm -> validation($data['username']);
			$email = $this ->fm -> validation($data['email']);
			
			$name = mysqli_real_escape_string($this ->db ->link, $name);
			$username = mysqli_real_escape_string($this ->db ->link, $username);
			$email = mysqli_real_escape_string($this ->db ->link, $email); 

			$query = "UPDATE tbl_user 
			    		SET 
			    		name 	  = '$name',
			    		username  = '$username',
			    		email     = '$email'
			    		WHERE userId = '$userid'";

			$updatedrow = $this ->db ->update($query);

			if($updatedrow){

				$msg = "<span class='success'>User Data Updated</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>User Data Not Updated</span>";
				return $msg;
			}
		}

		public function disableUser($userId){
			$userId = mysqli_real_escape_string($this ->db ->link, $userId);
			$query = "UPDATE tbl_user 
			    		SET 
			    		status = '2'
			    		WHERE userId = '$userId'";

			$updatedrow = $this ->db ->update($query);

			if($updatedrow){

				$msg = "<span class='success'>User Disabled</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>User Not Disabled</span>";
				return $msg;
			}
		}
		public function enableUser($userId){
			$userId = mysqli_real_escape_string($this ->db ->link, $userId);
			$query = "UPDATE tbl_user 
			    		SET 
			    		status = '1'
			    		WHERE userId = '$userId'";

			$updatedrow = $this ->db ->update($query);

			if($updatedrow){

				$msg = "<span class='success'>User Enabled</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>User Not Enabled</span>";
				return $msg;
			}
		}
		public function deleteUser($userId){
			$userId = mysqli_real_escape_string($this ->db ->link, $userId);
			$query = "DELETE FROM tbl_user WHERE userId = '$userId'";

			$deletedrow = $this ->db ->delete($query);

			if($deletedrow){

				$msg = "<span class='success'>User removed</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>User Not removed</span>";
				return $msg;
			}
		}

		public function userRegistration($name, $username, $password, $email){
			$name = $this ->fm -> validation($name);
			$username = $this ->fm -> validation($username);
			$password = $this ->fm -> validation($password);
			$email = $this ->fm -> validation($email);
			
			$name = mysqli_real_escape_string($this ->db ->link, $name);
			$username = mysqli_real_escape_string($this ->db ->link, $username);
			
			$email = mysqli_real_escape_string($this ->db ->link, $email); 
			
			if($name == "" || $username == "" || $password == "" || $email ==""){
		    	echo "<span class='error'>fields must not be empty</span>";
				exit();
		    }elseif(filter_var($email,FILTER_VALIDATE_EMAIL) === false){
		    	echo "<span class='error'>Invalid Email Address!!!</span>";
				exit();
			}else{
		    	$mailquery = "SELECT * FROM tbl_user WHERE email = '$email'";

		    	$mailchk = $this ->db ->select($mailquery);

			    if($mailchk !=false){
			    	echo "<span class='error'>Email already exists</span>";
					exit();
			    }else{
			    	$password = mysqli_real_escape_string($this ->db ->link, md5($password));
			    	$query = "INSERT INTO tbl_user(name,username,password,email) 
			    	VALUES('$name', '$username', '$password', '$email')";
			   		$inserted_row = $this ->db ->insert($query);

					if($inserted_row){

						echo "<span class='success'>You registred successfully</span>";
						exit();
					}else{
						echo "<span class='error'>Sorry something went wrong</span>";
						exit();
					}
				}
		    }
		}

		public function userLogin($email, $password){
			$email = $this ->fm -> validation($email);
			$password = $this ->fm -> validation($password);
			$email = mysqli_real_escape_string($this ->db ->link, $email); 
			
			if($email == "" || $password == ""){
				echo "empty";
				exit();
			}else{
				$password = mysqli_real_escape_string($this ->db ->link, md5($password));

				$query = "SELECT * FROM tbl_user WHERE email = '$email' AND password = '$password'";

		    	$result = $this ->db ->select($query);

			    if($result !=false){
			    	$value = $result ->fetch_assoc();
			    	if($value['status'] == 2){
			    		echo "disable";
						exit();
			    	}else{
			    		Session::init();
			    		Session::set("login",true);
			    		Session::set("userId", $value['userId']);
			    		Session::set("username", $value['username']);
			    		Session::set("name", $value['name']);
			    		
			    	}
			    }else{
			    	echo "error";
			    	exit();
			    }
			}
		}
	}
?>