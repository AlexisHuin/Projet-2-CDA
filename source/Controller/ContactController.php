<?php

namespace Controller;

class ContactController extends MainController
{

    //* fonction pour afficher la page Contact

    public function Contact(): void
    {


        ViewController::Set('title', 'Contact');
        ViewController::Display('ContactView');
    }
}
