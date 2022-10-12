<?php

// le fichier est utilisé pour tte les pages et c'est lui qui va rediriger à chaque fois, il verra la requete demandée et redirigera sur le bon fichier en fonction
// Il faut utiliser des objets pour représenté mes requetes et mes réponse, 
// ces objets, ils ont déja étaient crée, j'utilise donc des interface qui sont issus du psr7 qui sont reconnu et standariser pour php


// Charger mon autloader
require '../vendor/autoload.php';

// Initalider le Renderer
/*$renderer = new \Framework\Renderer();
$renderer->addPath(dirname(__DIR__) .'/views');*/

// Lorsque j'initialise l'appli, utilisé un system de module
// Classe qui represente mon application, initialisation de App


/* $app = new \Framework\App([
    // passé le nampespace qui va correspondre a bloc module
    BlogModule::class
]);*/ 

$app = new \Framework\App();



// stocker ma réponse et generer la requete avec Guzzle
$response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());


// il faut que php affiche les bon contenu et renvoi les bon header
// Convertir une reponse ps7 vers un outpout http avec http-interop
\Http\Response\send($response);


