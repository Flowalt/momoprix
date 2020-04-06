<?php

namespace App\Controller;

use App\Entity\Product;
use AppBundle\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class CartController extends AbstractController {

    public function __constructor(
        Product $product
        
    ) {
        $this->product = $product;
        
    }

   public function addProduct($id,SessionInterface  $session){   
      
       $panier = $session->get('panier',[]);
       
      if(!empty($panier[$id])){
          $panier[$id]++;
      }else{
        $panier[$id]=1;
      }
       
       $session-> set('panier', $panier);
       dd($session->get('panier'));

    }

    public function panier(SessionInterface $session, App\Controller\ProductRepository $productRepository){

    
    $panier = $session->get('panier',[]);
    $panierWithData = [];
    foreach($panier as $id => $quantity){
        $panierWithData[]=[
            
            'quantity'=> $quantity
        ];
    }

    }
}