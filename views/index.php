<?php
require_once '../library/config.php';
require_once '../library/functions.php';

checkFDUser();

$view = (isset($_GET['v']) && $_GET['v'] != '') ? $_GET['v'] : '';

switch ($view) {
	case 'LIST':
		$content 	= 'rendez_vous_list.php';
		$pageTitle 	= 'list des rendez-vous';
		break;

	case 'USERS':
		$content 	= 'userlist.php';
		$pageTitle 	= 'list des utilisateurs';
		break;

	case 'CREATE':
		$content 	= 'userform.php';
		$pageTitle 	= 'nouvel utilisateur';
		break;

	case 'APPOINTMENT':
		$content 	= 'rdv_detailles.php';
		$pageTitle 	= 'mon compte';
		break;
	case 'UPDATERDV':
		$content 	= 'appointment.php';
		$pageTitle 	= 'mon compte';
		break;
	case 'UPDATEUSER':
		$content 	= 'userUpdatefForm.php';
		$pageTitle 	= 'modifier un utilisateur';
		break;
	default:
		$content 	= 'dashboard.php';
		$pageTitle 	= 'Calendar Dashboard';
}

require_once '../include/template.php';
