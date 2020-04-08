<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ProductController extends AbstractController {


    
    public function __constructor(
        Product $product
        
    ) {
        $this->product = $product;
        
    }

    function detailsbis($id){
        
        
        $article=$this->getDoctrine()->getRepository(Product::class)->find($id);
        
        
        

        return $this->render('details.html.twig',[
            'article'=> $article

        ]);
    }
    function details(){
        return $this-> render('details.html.twig');

        
    }
    

    

   
     
    

  
}

