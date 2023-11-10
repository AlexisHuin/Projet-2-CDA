<?php

namespace Controller;

class BundleController extends MainController {

    // fonction pour afficher la page Contact

    public function Bundle(): void {

        
        ViewController::Set('title', 'Gérer mes bundles');
        ViewController::Display('BundleView');
    }
}