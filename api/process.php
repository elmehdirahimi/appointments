<?php

require_once 'Booking.php';
require_once '../library/config.php';

$cmd = isset($_GET['cmd']) ? $_GET['cmd'] : '';

switch ($cmd) {

	case 'book':
		bookCalendar();
		break;

	case 'calview':
		calendarView();
		break;

	case 'regConfirm':
		regConfirm();
		break;

	case 'delete':
		regDelete();
		break;

	case 'user':
		userDetails();
		break;

	default:
		break;
}



function bookCalendar()
{
	$login_etudiant 		= $_POST['login_etudiant'];
	$date_debut 		= $_POST['date_debut'] . ' ' . $_POST['houre_debut'];
	$date_fin 		= $_POST['date_fin'] . ' ' . $_POST['houre_fin'];

	$sql = "INSERT INTO rendez_vous (login_etudiant,status_rdv,date_debut, date_fin) 
			VALUES ( '$login_etudiant','vide','$date_debut', '$date_fin')";
	dbQuery($sql);
	header('Location: ../index.php?msg=' . urlencode('appointment successfully registered.'));
	exit();
}

function regConfirm()
{
	$userId		= $_GET['userId'];
	$action 	= $_GET['action'];
	$stat		= ($action == 'approve') ? 'APPROVED' : 'DENIED';

	$sql		= "UPDATE tbl_reservations SET status = '$stat' WHERE uid = $userId";
	dbQuery($sql);

	//send email now.
	$data = array();

	header('Location: ../views/?v=DB&msg=' . urlencode('Reservation status successfully changed.'));
	exit();
}

function regDelete()
{
	$userId	= $_GET['userId'];
	$sql1	= "DELETE FROM tbl_reservations WHERE uid = $userId";
	dbQuery($sql1);
	$sql2	= "DELETE FROM tbl_users WHERE id = $userId";
	dbQuery($sql2);

	header('Location: ../views/?v=LIST&msg=' . urlencode('User record successfully deleted.'));
	exit();
}


function get_appointment()
{

	return ("SELECT * FROM rendez_vous");
	// if ($_SESSION['calendar_fd_user']['fonction'] == 'manager') {
	// 	return ("SELECT * FROM rendez_vous");
	// } 
	
	// else {
		
	// 		if ($_SESSION['calendar_fd_user']['fonction'] == 'etudiant') {
	// 			$login = $_SESSION['calendar_fd_user']['login'];
	// 			return ("SELECT * FROM rendez_vous where login_etudiant = '$login'");
	// 		}
		
	// }
	return ("");
}




function calendarView()
{
	$bookings = array();
	$sql	= get_appointment();
	$result = dbQuery($sql);
	while ($row = dbFetchAssoc($result)) {
		extract($row);
		$book = new Booking();
		$book->title = $login_etudiant;
		$book->start = $date_debut;
		$bgClr = '#dede00'; //pending

		if ($status_rdv == 'vide') {
			$bgClr = '#00b818'; /// vert
		} else if ($status_rdv == 'reserver') {
			$bgClr = '#dede00';
		} else if ($status_rdv == 'accepter') {
			$bgClr = '#d16a0a';
		} else if ($status_rdv == 'annuler') {
			$bgClr = '#d10a2b';
		}

		$book->backgroundColor = $bgClr;
		$book->borderColor = $bgClr;
		$book->url = WEB_ROOT . 'views/?v=APPOINTMENT&code_rdv=' . $code_rdv;
		$bookings[] = $book;
	}
	echo json_encode($bookings);
}

function userDetails()
{
	$userId	= $_GET['userId'];
	$hsql	= "SELECT * FROM tbl_users WHERE id = $userId";
	$hresult = dbQuery($hsql);
	$user = array();
	while ($hrow = dbFetchAssoc($hresult)) {
		extract($hrow);
		$user['user_id'] = $id;
		$user['address'] = $address;
		$user['phone_no'] = $phone;
		$user['email'] = $email;
	} //while
	echo json_encode($user);
}
