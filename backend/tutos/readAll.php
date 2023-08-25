<?php

////////zone de controle
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorisation,X-Requested-With');
////////zone de controle


if($_SERVER['REQUEST_METHOD'] == 'GET') {
////////reponse api ok 
    http_response_code(200);

////////appel methodes

    include('../cnx.php');
    /*include('../classes/TutoManager.php');
    include('../classes/Tuto.php');*/
    spl_autoload_register(function($class) {
        include('../classes/'.$class.'.php');
    });

    $manager = new TutoManager($cnx);
    $tutos = $manager->ReadAllTuto();
    $count = $manager->CompterTuto();
////////appel methodes

////////envoi donnés json
    if($count > 0) {

        foreach($tutos as $tuto) {
            $msg = array(
                'titre'       => $tuto->getTitre(),
                'description' => $tuto->getDescription(),
                'url'         => $tuto->getUrl()

            );
            $messages[] = $msg;
        }
        echo json_encode($messages);
////////envoi donnés json

////////reponse api ok 

    } else {

        $message = array(
            'msgErreur'   => 'Aucune donnée de disponible'
        );
        echo json_encode($message);
    }
////////reponse api ok 
} else {
////////reponse api ko
    http_response_code(405);
    $message = array(
        'msgErreur'   => 'Methode non autorisée',
        'explication' => 'vous devez utiliser la methode GET'
    );
    echo json_encode($message);
}


