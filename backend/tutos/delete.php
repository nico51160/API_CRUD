<?php

////////zone de controle
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorisation,X-Requested-With');
////////zone de controle

if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    ////////reponse api ok

             //////// Traitement des infos recues
             $data = json_decode(file_get_contents("php://input"), true);

             if( !empty($data['tutoID']) ) {
                
     
                         ////////appel methodes
     
                 include('../cnx.php');
                 /*include('../classes/TutoManager.php');
                 include('../classes/Tuto.php');*/
                 spl_autoload_register(function($class) {
                     include('../classes/'.$class.'.php');
                 });
    
                 $manager = new TutoManager($cnx);
                 $verif = $manager->ReadTuto($data['tutoID']);

                 if(!empty($verif->getTutoID)) {
                    http_response_code(200);
                    $manager->DeleteTuto($data['tutoID']);
     
                 $message = array(
                     'msg'   => 'Suppression réussie'
                 );
                 echo json_encode($message);
                 } else {
                    http_response_code(405);
                    $message = array(
                        'msgErreur'   => 'suppression impossible',
                        'explication'   => 'l identifiant n existe pas'
    
            
                    );
                    echo json_encode($message);

                 }


             } else {
                http_response_code(405);
                $message = array(
                    'msgErreur'   => 'une erreur est survenue',
                    'explication'   => 'l identifiant est obligatoire'

        
                    );
                    echo json_encode($message);
                }
                 
                 ////////appel methodes
                 





} else {
    http_response_code(405);
    $message = array(
        'msgErreur'   => 'methode non autorisé',
        'explication' => 'utilisez methode DELETE'
    );
    echo json_encode($message);
}
//////// Traitement des infos recues