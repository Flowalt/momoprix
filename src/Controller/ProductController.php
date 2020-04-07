<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ProductController extends AbstractController {

    function details($id){
        //On appelle la liste de tous les articles
        $article=$this->getDoctrine()->getRepository(Product::class)->find($id);
        return $this->render('detailsProduct.html.twig', [
            'article'=>$article
        ]);

       
    }
   
     
    }

  


