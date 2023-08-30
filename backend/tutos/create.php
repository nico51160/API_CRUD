<?php

////////zone de controle
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorisation,X-Requested-With');
////////zone de controle

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    ////////reponse api ok 
        http_response_code(200);

///////// Traitement des infos recues
    $data = json_decode(file_get_contents("php://input"), true);
    if(!empty($data['titre']) && !empty($data['description']) && !empty($data['url'] )) {

    } else {
        http_response_code(405);
        $message = array(
            'msgErreur'   => 'une erreur est survenue',
            'explication' => 'les champs titre, dscription et url sont obligatoires'
        );
        echo json_encode($message);
    }
///////// Traitement des infos recues









} else {
    ////////reponse api ko
    http_response_code(405);
    $message = array(
        'msgErreur'   => 'Methode non autorisée',
        'explication' => 'vous devez utiliser la methode POST'
    );
    echo json_encode($message);
    }
