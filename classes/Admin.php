<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../lib/Session.php');
	include_once ($filepath.'/../helpers/Format.php');

	class Admin{
		private $db;
		private $fm;
		function __construct(){
			$this -> db = new Database();
			$this -> fm = new Format();
		}

		public function getAdminData($data){
			$adminUser = $this ->fm -> validation($data['adminUser']);
			$adminPass = $this ->fm -> validation($data['adminPass']);

			$adminUser = mysqli_real_escape_string($this ->db ->link, $adminUser);
			$adminPass = mysqli_real_escape_string($this ->db ->link, md5($adminPass));

			if(empty($adminUser) || empty($adminPass)){

				$loginmsg = "<span class='error'>USERNAME AND PASSWORD must not be empty</span>";
				return $loginmsg;
			}else{

				$query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' ";

				$result = $this ->db ->select($query);

				if($result != false){
						$value = $result -> fetch_assoc();
						
						Session::set("adminLogin", true);
						Session::set("adminId", $value['adminId']);
						Session::set("adminUser", $value['adminUser']);
						
						header("location: index.php");

					}else{
						$loginmsg = "<span class='error'>USERNAME AND PASSWORD don't match</span>";
						return $loginmsg;
					}
				}
		}



	}
?>