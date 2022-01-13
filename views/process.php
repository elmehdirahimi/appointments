<?php

require_once '../library/config.php';
require_once '../library/functions.php';

$cmd = isset($_GET['cmd']) ? $_GET['cmd'] : '';

switch ($cmd) {

	case 'create':
		createUser();
		break;

	case 'updateUser':
		updateUser();
		break;
	case 'deleteUser':
		deleteUser();
		break;
	case 'updateRdv':
		updateRdv();
		break;
	case 'updateStatus':
		updateStatus();
		break;

	case 'rdvreserver':
		rdvreserver();
		break;

	case 'rdvaccepter':
		rdvaccepter();
		break;


	case 'rdvannuler':
		rdvannuler();
		break;


	default:
		break;
}

function createUser()
{
	$nom_user 		= $_POST['nom_user'];
	$prenom_user 	= $_POST['prenom_user'];
	$tel 		= $_POST['tel'];
	$fonction 		= $_POST['fonction'];
	$login		= $_POST['login'];
	$password		= $_POST['password'];

	$hsql	= "SELECT * FROM users WHERE login = '$login'";
	$hresult = dbQuery($hsql);
	if (dbNumRows($hresult) > 0) {
		$errorMessage = 'utilisateur deja existe utiliser  un autre email/login';
		header('Location: ../views/?v=CREATE&err=' . urlencode($errorMessage));
		exit();
	}
	$sql = "INSERT INTO users (login, password,nom_user, prenom_user, tel,fonction)
			VALUES ('$login', '$password','$nom_user', '$prenom_user', '$tel','$fonction')";
	dbQuery($sql);


	header('Location: ../views/?v=USERS&msg=' . urlencode('L\'utilisateur est enregistré avec succès.'));
	exit();
}


function updateUser()
{
	$login		= $_GET['login'];

	$nom_user 		= $_POST['nom_user'];
	$prenom_user 	= $_POST['prenom_user'];
	$tel 		= $_POST['tel'];
	$fonction 		= $_POST['fonction'];

	$type = $_SESSION['calendar_fd_user']['fonction'];
	if ($type == 'manager') {
		$sql	= "UPDATE users SET nom_user = '$nom_user', prenom_user = '$prenom_user',tel = '$tel', fonction = '$fonction' WHERE login = '$login'";
		$result = dbQuery($sql);
		header('Location: ../views/?v=USERS&msg=' . urlencode('utilisateur modifié avec succès'));
	}



	exit();
}

function deleteUser()
{
	$login = $_GET['login'];

	$sql = "DELETE FROM users WHERE login = '$login'";
	dbQuery($sql);
	header('Location: ../views/?v=USERS&msg=' . urlencode('utilisateur supprimé avec succès'));
	exit();
}



function check_update($code_rdv)
{
	$sql1 = "SELECT * FROM rendez_vous WHERE code_rdv= '$code_rdv'";
	$result1 = dbQuery($sql1);
	$row1 = dbFetchAssoc($result1);

	if ($row1['status_rdv'] == 'vente' || $row1['status_rdv'] == 'pas_de_vente') {
		return (false);
	}
	return (true);
}


function updateRdv()
{

	$code_rdv = $_GET['code_rdv'];

	$login_etudiant 		= $_POST['login_etudiant'];
	$status_rdv		= $_POST['status_rdv'];
	$date_debut 		= $_POST['date_debut'] . ' ' . $_POST['houre_debut'];
	$date_fin 		= $_POST['date_fin'] . ' ' . $_POST['houre_fin'];


	if ($_SESSION['calendar_fd_user']['fonction'] == 'manager') {
		if (check_update($code_rdv)) {
			$sql	= "UPDATE rendez_vous SET login_etudiant= '$login_etudiant', status_rdv= '$status_rdv',date_debut= '$date_debut',date_fin= '$date_fin',,code_rdv = '$code_rdv' WHERE code_rdv = '$code_rdv'";
			dbQuery($sql);
			header('Location: ../views/?v=USERS&msg=' . urlencode('rendez-vous modifié avec succès'));
		}
	} else {

		if ($_SESSION['calendar_fd_user']['fonction'] == 'etudiant') {
			if (check_update($code_rdv)) {
				$login = $_SESSION['calendar_fd_user']['login'];
				$sql2 =  "SELECT login_etudiant FROM rendez_vous WHERE code_rdv= '$code_rdv'";
				$result2 = dbQuery($sql2);
				$row2 = dbFetchAssoc($result2);
				if ($login == $row2['login_etudiant']) {
					$sql	= "UPDATE rendez_vous SET login_etudiant= '$login_etudiant', status_rdv= '$status_rdv',date_debut= '$date_debut',date_fin= '$date_fin',code_rdv = '$code_rdv' WHERE code_rdv = '$code_rdv'";
					dbQuery($sql);
					header('Location: ../views/?v=USERS&msg=' . urlencode('rendez-vous modifié avec succès'));
				}
			}
		}
	}

	exit();
}







function updateStatus()
{

	$code_rdv = $_GET['code_rdv'];
	$status_rdv		= $_POST['status_rdv'];

	$sql	= "UPDATE rendez_vous SET  status_rdv= '$status_rdv'  WHERE code_rdv = '$code_rdv'";
	dbQuery($sql);
	header('Location: ../views/?v=APPOINTMENT&code_rdv=' . $code_rdv . '&msg=' . urlencode('status modifié avec succès'));

	// if ($_SESSION['calendar_fd_user']['fonction'] == 'manager') {

	// 	$sql	= "UPDATE rendez_vous SET  status_rdv= '$status_rdv'  WHERE code_rdv = '$code_rdv'";
	// 	dbQuery($sql);
	// 	header('Location: ../views/?v=APPOINTMENT&code_rdv=' . $code_rdv . '&msg=' . urlencode('status modifié avec succès'));
	// } else {

	// 		if ($_SESSION['calendar_fd_user']['fonction'] == 'etudiant') {

	// 			$login = $_SESSION['calendar_fd_user']['login'];
	// 			$sql2 =  "SELECT login_etudiant FROM rendez_vous WHERE code_rdv= '$code_rdv'";
	// 			$result2 = dbQuery($sql2);
	// 			$row2 = dbFetchAssoc($result2);
	// 			if ($login == $row2['login_etudiant']) {
	// 				$sql	= "UPDATE rendez_vous SET  status_rdv= '$status_rdv'  WHERE code_rdv = '$code_rdv'";
	// 				dbQuery($sql);
	// 				header('Location: ../views/?v=APPOINTMENT&code_rdv=' . $code_rdv . '&msg=' . urlencode('status modifié avec succès'));				}
	// 		}

	// }

	exit();
}


function rdvreserver()
{

	$code_rdv = $_GET['code_rdv'];
	$login = $_SESSION['calendar_fd_user']['login'];
	$status = "reserver";

	$sql	= "UPDATE rendez_vous SET  status_rdv='$status' , login_etudiant = '$login'  WHERE code_rdv = '$code_rdv'";
	dbQuery($sql);
	header('Location: ../views/?v=APPOINTMENT&code_rdv=' . $code_rdv . '&msg=' . urlencode('status modifié avec succès'));
	exit();
}

function rdvaccepter()
{

	$code_rdv = $_GET['code_rdv'];
	$login = $_SESSION['calendar_fd_user']['login'];
	$status = "accepter";

	$sql	= "UPDATE rendez_vous SET  status_rdv= '$status' , login_etudiant = '$login'  WHERE code_rdv = '$code_rdv'";
	dbQuery($sql);
	header('Location: ../views/?v=APPOINTMENT&code_rdv=' . $code_rdv . '&msg=' . urlencode('status modifié avec succès'));
	exit();
}


function rdvannuler()
{

	$code_rdv = $_GET['code_rdv'];
	$login = $_SESSION['calendar_fd_user']['login'];
	$status = "annuler";

	$sql	= "UPDATE rendez_vous SET  status_rdv= '$status'  , login_etudiant = '$login' WHERE code_rdv = '$code_rdv'";
	dbQuery($sql);
	header('Location: ../views/?v=APPOINTMENT&code_rdv=' . $code_rdv . '&msg=' . urlencode('status modifié avec succès'));
	exit();
}
