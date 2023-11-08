<?php

namespace Controller;

class ContactController extends MainController {
    public function Contact(): void {

        
        ViewController::Set('title', 'Contact');
        ViewController::Display('ContactView');
    }
}