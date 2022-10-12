<?php

namespace Framework\Renderer;

interface RendererInterface {

    
    // La fonction ajoute des chemins qui seront plus tard utilisé par le renderer
    // le nampespace et le chemin qui par default est egale à null
    public function addPath($namespace, $path = null): void;


    public function render($view, $params = []): string;


    public function addGlobal($key, $value): void;
};

