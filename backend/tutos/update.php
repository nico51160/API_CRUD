<?php

////////zone de controle
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorisation,X-Requested-With');
////////zone de controle

if($_SERVER['REQUEST_METHOD'] == 'PUT') {
    ////////reponse api ok
         //////// Traitement des infos recues
         $data = json_decode(file_get_contents("php://input"), true);

         if( !empty($data['tutoID']) && !empty($data['titre']) && !empty($data['description']) && !empty($data['url']) ) {
             http_response_code(200);
 
                     ////////appel methodes
 
             include('../cnx.php');
             /*include('../classes/TutoManager.php');
             include('../classes/Tuto.php');*/
             spl_autoload_register(function($class) {
                 include('../classes/'.$class.'.php');
             });
 
             $tuto = new Tuto();
             $tuto->setTutoID($data['tutoID']);
             $tuto->setTitre($data['titre']);
             $tuto->setDescription($data['description']);
             $tuto->setUrl($data['url']);
 
 
 
             $manager = new TutoManager($cnx);
             $manager->UpdateTuto($tuto);
 
             $message = array(
                 'msg'   => 'Modification réussie'
             );
             echo json_encode($message);
         }
             
             ////////appel methodes



} else {
    http_response_code(405);
    $message = array(
        'msgErreur'   => 'une erreur est survenue',
        'explication' => 'les champs titre, dscription et url sont obligatoires'
    );
    echo json_encode($message);
}
//////// Traitement des infos recues