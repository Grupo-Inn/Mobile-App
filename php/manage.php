<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html; charset=UTF-8");
include_once 'models.php';

$option = $_GET['option'];


if($option == 'login'){
	$username = $_GET['username'];
	$password = $_GET['password'];
	$userModel = new User();
	if(!($user = $userModel->get_user($username, $password))){
		$results['status'] = 'EMPTY';
	}else{
		$user = $userModel->get_user($username, $password)[0];
		$results['status'] = 'OK';
		$results['idUser'] = $user['idUsuario'];
	}
	$resultsJSON = json_encode($results);

	echo ''.$resultsJSON.'';
}


if($option == 'feed'){
	$eventModel = new Event();
	$events = $eventModel->get_events();	
	$results = array();

	foreach ($events as $row) {
		$result['id'] = $row['idEvento'];
		$result['name'] = $row['nombre'];
		$result['description'] = $row['descripcion'];
		$result['image'] = $row['url_imagen'];
		array_push($results, $result);
	}

	$resultsJSON = json_encode($results);

	echo ''.$resultsJSON.'';
}

if($option == 'detail'){
	$eventModel = new Event();
	$idEvent = $_GET['idEvent'];	
	if(!($eventModel->get_event($idEvent))){
		$result['status'] = "EMPTY";
	}else{
		$event = $eventModel->get_event($idEvent)[0];
		$result['status'] = "OK";
		$result['name'] = $event['nombre'];
		$result['description'] = $event['descripcion'];
		$result['image'] = $event['url_imagen'];
		$result['type'] = $event['tipo'];
		$result['place'] = $event['lugar'];	
	}

	$resultsJSON = json_encode($result);

	echo ''.$resultsJSON.'';
}

if($option == 'profile'){
	$idUser = $_GET['idUser'];
	$perfilModel = new Profile();
	if(!($perfilModel->get_profile($idUser))){
		$result['status'] = "EMPTY";
	}else{
		$results = $perfilModel->get_profile($idUser)[0];
		$result['status'] = "OK";
		$result['names'] = $results['nombres'];
		$result['birthday'] = $results['f_nacimiento'];
		$result['email'] = $results['correo'];
		$result['phone'] = $results['telefono'];
		$result['image'] = $results['url_imagen'];	
	}

	$resultsJSON = json_encode($result);
	echo ''.$resultsJSON.'';
	
}

if($option == 'notification'){
	$idUser = $_GET['idUser'];
	if(TRUE){
		$result['status'] = "EMPTY";
	}else{
		$result['status'] = "OK";
	}

	$resultsJSON = json_encode($result);
	echo ''.$resultsJSON.'';
}

?>