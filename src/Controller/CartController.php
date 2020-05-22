<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\AddressRepository;
use App\Repository\ProductRepository as RepositoryProductRepository;
use AppBundle\Repository\ProductRepository;
use ProductRepository as GlobalProductRepository;
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
       return $this->redirectToRoute ('index');
    }

    public function removeProduct($id, SessionInterface $session){
        $panier = $session->get('panier',[]);
        if(!empty($panier)){
            unset($panier[$id]);
        }

        $session->set('panier', $panier);
        return $this->redirectToRoute ('cart');
    }

    

    public function panier(SessionInterface $session, RepositoryProductRepository $productRepository, AddressRepository $addressRepository )
    {

    
        
    $panier = $session->get('panier',[]);


    $panierWithData = [];
    $total=0;
    foreach($panier as $id => $quantity){
        $panierWithData[]=[
            'product'=> $productRepository->find($id),
            
            'quantity'=> $quantity
        ];

        $total=0;

        foreach($panierWithData as $item){
            $totalItem= $item['product']->getPrice()* $item['quantity'];
            $total += $totalItem;
        }
    }

    $customer = $this -> getUser();
    $address =  $addressRepository->dysplayAddressLivraisonByCustomerId($customer->getIdcustomer());
    $addressFact = $addressRepository->dysplayAddressFacturationByCustomerId($customer->getIdcustomer());

    return $this-> render('checkout.html.twig', [
        'items' => $panierWithData,
        'total' => $total,
        'adressLivraison' => $address,
        'adressFacturation' => $addressFact
    ]);
    
    //return $this->redirectToRoute('cart');
        
    

    }

    public function addQuantity($id,SessionInterface $session){

        $panier = $session->get('panier',[]);
       
        if(!empty($panier[$id])){
            $panier[$id]+=1;
        }
         
         $session-> set('panier', $panier);
         return $this->redirectToRoute ('cart');
      }

      public function deleteQuantity($id,SessionInterface $session){

        $panier = $session->get('panier',[]);
       
        if(!empty($panier[$id]) && $panier[$id]>1){
            $panier[$id]-=1;
        }
        

         
         $session-> set('panier', $panier);
         return $this->redirectToRoute ('cart');
      }

    
}