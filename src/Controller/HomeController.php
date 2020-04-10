<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class HomeController extends AbstractController {

    function index(){
        //On appelle la liste de tous les articles
        $articles=$this->getDoctrine()->getRepository(Product::class)->findAll();
        
        return $this->render('index.html.twig', [
            'articles'=>$articles,
           
        ]);
    }

    //filtrer par prix
    function indexFilterPrice(ProductRepository $productRepository){
        
        $article=$productRepository->findByPrice();
        
        
       
        
        return $this->render('index.html.twig', [
            'articles'=>$article,
           
        ]);
    }

    function indexFilterName(ProductRepository $productRepository){
      
        //filtrer par nom
        $article = $productRepository->findByName();

        return $this->render('index.html.twig', [
            'articles'=>$article,
           
        ]);
        
    }

    function login(){
        return $this->render('login.html.twig');
    }

    function register(){
        return $this->render('signup.html.twig');
    }



}