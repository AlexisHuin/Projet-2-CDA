<?php
namespace Controller;

use Model\User;
use Controller\View;

class Home extends Main
{
    public function Index()
    {
        View::Init('smarty');
        View::Set('title', 'Home');
        View::Set('h1', 'Smarty : Hello World !');
        View::Display('Home');
    }
}