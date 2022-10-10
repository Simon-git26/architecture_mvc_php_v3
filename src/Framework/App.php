<?php

// ma classe se situe dans le namespace Framework
namespace Framework;

// Objet Response
use GuzzleHttp\Psr7\Response;
// Librairie pour mes methods Request et Response
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class App {

    // Requete en param et response en sortie de la fonction
    public function run(ServerRequestInterface $request): ResponseInterface {
        // recuperer mon url, sur ma requete jai ma methode getUri et dans cette methode je n'est besoin que du chemin
        $uri = $request->getUri()->getPath();

        // Simon mon url n'est pas vide et fini par un / alors je fait une redirection
        if (!empty($uri) && $uri[-1] === "/") {
            // Crée une instance de Response et lui appliquer mes methods
            $response = (new Response())
            ->withStatus(301)
            ->withHeader('Location', substr($uri, 0, -1));

            return $response;
        }

        if ($uri === '/blog') {
            return new Response(200, [], '<h1>Bienvenu sur le blog</h1>');
        }

        // sinon
        // renvoyer un status, pas de header et mon body
        return $response = new Response(404, [], '<h1>Erreur 404</h1>');
    }
}