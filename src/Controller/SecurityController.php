<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController {

    function login(Request $request, AuthenticationUtils $utils){
        $error = $utils->getLastAuthenticationError();

         $lastUsername = $utils->getLastUsername();
        return $this->render('login.html.twig',[
            'error'=> $error,
            'last_username' => $lastUsername 
        ]
    );
    }
}