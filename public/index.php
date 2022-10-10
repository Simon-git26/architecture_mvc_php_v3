<?php

// le fichier est utilisé pour tte les pages et c'est lui qui va rediriger à chaque fois, il verra la requete demandée et redirigera sur le bon fichier en fonction

// Charger mon autloader
require '../vendor/autoload.php';


// Classe qui represente mon application, initialisation de App
$app = new \Framework\App();



// stocker ma réponse et generer la requete avec Guzzle
$response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());