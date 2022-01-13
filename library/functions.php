<?php


function checkFDUser()
{
	// if the session id is not set, redirect to login page
	if (!isset($_SESSION['calendar_fd_user'])) {
		header('Location: ' . WEB_ROOT . 'login.php');
		exit;
	}
	// the user want to logout
	if (isset($_GET['logout'])) {
		doLogout();
	}
}

function doLogin()
{
	$login 	= $_POST['login'];
	$pwd 	= $_POST['pwd'];

	$errorMessage = '';

	$sql 	= "SELECT * FROM users WHERE login = '$login' AND password = '$pwd'";
	$result = dbQuery($sql);

	if (dbNumRows($result) == 1) {
		$row = dbFetchAssoc($result);
		$_SESSION['calendar_fd_user'] = $row;
		$_SESSION['calendar_fd_user_name'] = $row['username'];
		header('Location: index.php');
		exit();
	} else {
		$errorMessage = 'Invalid login or password. Please try again or contact to support.';
	}
	return $errorMessage;
}


/*
	Logout a user
*/
function doLogout()
{
	if (isset($_SESSION['calendar_fd_user'])) {
		unset($_SESSION['calendar_fd_user']);
		//session_unregister('hlbank_user');
	}
	header('Location: index.php');
	exit();
}

function getBookingRecords()
{
	$per_page = 10;
	$page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : 1;
	$start 	= ($page - 1) * $per_page;
	$sql 	= "SELECT u.login AS uid, u.nom, u.tel, u.email,
			   r.ucount, r.rdate, r.status, r.comments   
			   FROM users u, tbl_reservations r 
			   WHERE u.id = r.uid  
			   ORDER BY r.id DESC LIMIT $start, $per_page";
	//echo $sql;
	$result = dbQuery($sql);
	$records = array();
	while ($row = dbFetchAssoc($result)) {
		extract($row);
		$records[] = array(
			"user_id" => $uid,
			"user_name" => $name,
			"user_phone" => $phone,
			"user_email" => $email,
			"count" => $ucount,
			"res_date" => $rdate,
			"status" => $status,
			"comments" => $comments
		);
	} //while
	return $records;
}


function getUsersRecords()
{
	$per_page = 20;
	$page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : 1;
	$start 	= ($page - 1) * $per_page;

	$type = $_SESSION['calendar_fd_user']['fonction'];
	if ($type == 'manager') {
		$login = $_SESSION['calendar_fd_user']['login'];
		$sql = "SELECT  * FROM users  WHERE fonction != 'manager' ORDER BY nom_user DESC";
		$result = dbQuery($sql);
		$records = array();
		while ($row = dbFetchAssoc($result)) {
			extract($row);
			$records[] = array(
				"login" => $login,
				"nom_user" => $nom_user,
				"prenom_user" => $prenom_user,
				"tel" => $tel,
				"fonction" => $fonction
			);
		}
		return $records;
	}
	return null;
}


function getOneUserRecords()
{

	$login = $_GET['login'];

	$type = $_SESSION['calendar_fd_user']['fonction'];
	if ($type == 'manager') {
		$sql = "SELECT  * FROM users  WHERE login = '$login'";
		$result = dbQuery($sql);
		$row = dbFetchAssoc($result);
		return $row;
	}
	return null;
}


function getOneaAppointment()
{
	$code_rdv = $_GET['code_rdv'];
	$sql = "";

	$sql = "SELECT * FROM rendez_vous where code_rdv = '$code_rdv'";
	// if ($_SESSION['calendar_fd_user']['fonction'] == 'manager') {
	// 	$sql = "SELECT * FROM rendez_vous where code_rdv = '$code_rdv'";
	// } else {

	// 		if ($_SESSION['calendar_fd_user']['fonction'] == 'etudiant') {
	// 			$login = $_SESSION['calendar_fd_user']['login'];
	// 			$sql = "SELECT * FROM rendez_vous where login_etudiant = '$login' and code_rdv = '$code_rdv'";
	// 		} else {
	// 			return null;
	// 		}
		
	// }
	$result = dbQuery($sql);
	$row = dbFetchAssoc($result);
	return $row;
}













function getHolidayRecords()
{
	$per_page = 10;
	$page 	= (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : 1;
	$start 	= ($page - 1) * $per_page;
	$sql 	= "SELECT * FROM tbl_holidays ORDER BY id DESC LIMIT $start, $per_page";
	//echo $sql;
	$result = dbQuery($sql);
	$records = array();
	while ($row = dbFetchAssoc($result)) {
		extract($row);
		$records[] = array("hid" => $id, "hdate" => $date, "hreason" => $reason);
	} //while
	return $records;
}

function generateHolidayPagination()
{
	$per_page = 10;
	$sql 	= "SELECT * FROM tbl_holidays";
	$result = dbQuery($sql);
	$count 	= dbNumRows($result);
	$pages 	= ceil($count / $per_page);
	$pageno = '<ul class="pagination pagination-sm no-margin pull-right">';
	for ($i = 1; $i <= $pages; $i++) {
		$pageno .= "<li><a href=\"?v=HOLY&page=$i\">" . $i . "</a></li>";
	}
	$pageno .= 	"</ul>";
	return $pageno;
}

function generatePagination()
{
	$per_page = 10;
	$sql 	= "SELECT * FROM tbl_users";
	$result = dbQuery($sql);
	$count 	= dbNumRows($result);
	$pages 	= ceil($count / $per_page);
	$pageno = '<ul class="pagination pagination-sm no-margin pull-right">';
	for ($i = 1; $i <= $pages; $i++) {
		//<li><a href="#">1</a></li>
		//$pageno .= "<a href=\"?v=USER&page=$i\"><li id=\".$i.\">".$i."</li></a> ";
		$pageno .= "<li><a href=\"?v=USER&page=$i\">" . $i . "</a></li>";
	}
	$pageno .= 	"</ul>";
	return $pageno;
}
