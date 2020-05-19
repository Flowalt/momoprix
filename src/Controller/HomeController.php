<?php

namespace App\Controller;

use App\Entity\CategoryRepository;
use App\Entity\Product;
use App\Repository\CategoryRepository as RepositoryCategoryRepository;
use App\Repository\ProductRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class HomeController extends AbstractController {

    function index(ProductRepository $productRepository, RepositoryCategoryRepository $cat){
        //On appelle la liste de tous les articles
        //$articles=$this->getDoctrine()->getRepository(Product::class)->findAll();
        //$category=$this->getDoctrine()->getRepository(Product::class)->findAll();
        
        $articles=$productRepository->findAllArticle();
        $category=$cat->findAll();
        
        
        return $this->render('index.html.twig', [
            'articles'=>$articles,
            'category'=>$category
           
        ]);
    }

    

    //filtre de catégories
    function indexFilterCategory(ProductRepository $productRepository,RepositoryCategoryRepository $cat){
        
        $article = $productRepository->findByCategory();
        $category=$cat->findAll();

        return $this->render('index.html.twig', [
            'articles'=>$article,
            'category'=>$category
           
        ]);
    }


    function login(){
        return $this->render('login.html.twig');
    }

    function register(){
        return $this->render('signup.html.twig');
    }



}