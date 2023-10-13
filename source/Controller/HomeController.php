<?php
namespace Controller;

use Model\UserModel;
use Controller\ViewController;

class HomeController extends MainController
{
    public function Index()
    {
        ViewController::Init('smarty');
        ViewController::Set('title', 'Home');
        ViewController::Set('h1', 'Smarty : Hello World !');
        ViewController::Display('HomeView');
    }
}