<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController {

    function index(){
        //On appelle la liste de tous les articles
        $articles=$this->getDoctrine()->getRepository(Product::class)->findAll();
        return $this->render('index.html.twig', [
            'articles'=>$articles
        ]);
    }

   

    function register(){
        return $this->render('signup.html.twig');
    }



}