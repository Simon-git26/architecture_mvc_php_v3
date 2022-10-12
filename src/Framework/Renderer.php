<?php

namespace Framework;

class Renderer {

    // création de ma constante pour le namespace par default
    const DEFAULT_NAMESPACE = '__MAIN_DEFAULT';

    // Tableaux qui va contenir mes chemins
    private $paths = [];


    // La fonction ajoute des chemins qui seront plus tard utilisé par le renderer
    // le nampespace et le chemin qui par default est egale à null
    public function addPath($namespace, $path = null): void {
        // Si mon chemin est null
        if (is_null($path)) {
            // utiliser le namespace par defaut
            $this->paths[self::DEFAULT_NAMESPACE] = $namespace;
        } else {
            // on utilise le chemin préciser en premier param
            $this->paths[$namespace] = $path;
        }
    }


    public function render($view, $params = []): string {
        // est ce que jai un namespace dans le chemin de la vue
        if ($this->hasNamespace($view)) {
            // Il me faut le chemin
            $path = $this->replaceNamespace($view) . '.php';
        } else {
            // sinon je recupere le chemin 
            // recuperer le chemin qui correspond au namespace par default et je rajoute le nom de la view avec $view et l'extensions
            $path = $this->paths[self::DEFAULT_NAMESPACE] . DIRECTORY_SEPARATOR . $view . '.php';
        }
        
        // Pour temporiser la sortie donc mettre en memoire les infos qui vont etre en sortie
        ob_start();
        // Injecter le renderer dans mes vue
        $renderer = $this;
        // sortir les variables qui sont dans le tableau en param
        extract($params);
        // require mon chemin
        require($path);
        // recuperer le contenu 
        return ob_get_clean();
    }



    // Verifier si j'ai un namespace //  chemin de la view en param qui sera une string
    private function hasNamespace($view): bool {
        // je return ma view et je prend le caractere a index 0 et je verifice si cest un @, si oui alors jai un namespace
        return $view[0] === '@';
    }



    // recuperer le namespace
    private function getNamespace($view): string {
        return substr($view, 1, strpos($view, '/') - 1);
    }



    // remplacer dans ma string le @blog par exemple par le bon nampespace
    private function replaceNamespace($view): string {
        $namespace = $this->getNamespace($view);

        // chercher @ namespace et le remplacer par le chemin definis au niveau des addPath
        return str_replace('@' . $namespace, $this->paths[$namespace], $view);
    }
};