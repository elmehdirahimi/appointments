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



function get_appointment()
{

	return ("SELECT * FROM rendez_vous");

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
