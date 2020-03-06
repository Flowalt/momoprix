<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController {

    function index(){
        return $this->render('index.html.twig');
    }

    function login(){
        return $this->render('login.html.twig');
    }

    function register(){
        return $this->render('signup.html.twig');
    }



}