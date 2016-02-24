<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html; charset=UTF-8");
include_once 'models.php';

$option = $_GET['option'];


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

if($option == 'profile'){
	$idUser = $_GET['idUser'];
	$perfilModel = new Profile();
	if(!($perfilModel->get_profile($idUser))){
		$result['status'] = "ERROR";
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

?>