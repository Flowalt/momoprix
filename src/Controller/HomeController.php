<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class HomeController extends AbstractController {

    function index(){
        //On appelle la liste de tous les articles
        $articles=$this->getDoctrine()->getRepository(Product::class)->findAll();
        
        return $this->render('index.html.twig', [
            'articles'=>$articles,
           
        ]);
    }
    function indexFilterPrice(){
        //On appelle la liste de tous les articles
        $articles=$this->getDoctrine()->getRepository(Product::class)->findAll();
        
        return $this->render('index.html.twig', [
            'articles'=>$articles,
           
        ]);
    }

    function indexFilterName($name){
        //On appelle la liste de tous les articles
        $articles=$this->getDoctrine()->getRepository(Product::class)->find($name);
        
        return $this->render('index.html.twig', [
            'article'=>$articles,
           
        ]);
    }

    function login(){
        return $this->render('login.html.twig');
    }

    function register(){
        return $this->render('signup.html.twig');
    }



}