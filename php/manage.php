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
		$results['idUser'] = $user['id'];
	}
	$resultsJSON = json_encode($results);

	echo ''.$resultsJSON.'';
}


if($option == 'feed'){
	$eventModel = new Event();
	$events = $eventModel->get_events();	
	$results = array();

	foreach ($events as $row) {
		$result['id'] = $row['id'];
		$result['name'] = $row['name'];
		$result['description'] = $row['description'];
		$result['image'] = $row['image'];
		$result['num_p'] = $eventModel->get_num_profiles($row['id'])[0]['COUNT(*)'];
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
		$result['name'] = $event['name'];
		$result['description'] = $event['description'];
		$result['image'] = $event['image'];
		$result['type'] = $event['type'];
		$result['place'] = $event['place'];
		$result['quota'] = $event['quota'];
		$result['participants'] = $eventModel->get_profiles($idEvent);
	}

	$resultsJSON = json_encode($result);

	echo ''.$resultsJSON.'';
}

if($option == 'profile'){
	$idUser = $_GET['idUser'];
	$profileModel = new Profile();
	if(!($profileModel->get_profile($idUser))){
		$result['status'] = "EMPTY";
	}else{
		$results = $profileModel->get_profile($idUser)[0];
		$result['status'] = "OK";
		$result['names'] = $results['names'];
		$result['birthday'] = $results['birthday'];
		$result['email'] = $results['email'];
		$result['phone'] = $results['phone'];
		$result['image'] = $results['image'];
		//
		//$likeModel = new Like();
		//print_r($likeModel->get_likes());
		//$likes = $likeModel->get_likes();
		$likes = $profileModel->get_profile_likes($idUser);
		$var = array();
		foreach ($likes as $row) {
			array_push($var, $row['name']);
		}
		$result['likes'] = $var;

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

if($option == 'register'){
	$username = $_GET['username'];
	$password = $_GET['password'];
 	$userModel = new User();
 	if(!($userModel->new_user($username, $password))){
 		$result['status'] = 'ERROR';
 	}else{
 		$result['status'] = 'OK';
 	}

 	$resultsJSON = json_encode($result);
	echo ''.$resultsJSON.'';
}

if($option == 'join'){
	$idEvent = $_GET['idEvent'];
	$idUser = $_GET['idUser'];
	$eventModel = new Event();
	if(!($eventModel->join($idEvent, $idUser))){
		$result['status'] = 'ERROR';
	}else{
		$result['result'] = 'OK';
	}
	$resultsJSON = json_encode($result);
	echo ''.$resultsJSON.'';
}

?>