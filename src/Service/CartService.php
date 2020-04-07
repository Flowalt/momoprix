<?php

namespace App\Service\Cart;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ManagerRegistry;


class CartService{

    protected $session;
    

    public function __construct(ManagerRegistry $registry, SessionInterface $session)
    {
        $this->session= $session;
        
        parent::__construct($registry);
    }

    public function add(int $id){

        $panier = $this->session->get('panier',[]);
       
        if(!empty($panier[$id])){
            $panier[$id]++;
        }else{
          $panier[$id]=1;
        }
         
         $this->session-> set('panier', $panier);

    }

    public function remove(int $id){


    }

    //public function getFullCart(): array{}

    //public function getTotal(): flaot{}



}