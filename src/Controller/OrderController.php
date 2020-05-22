<?php

namespace App\Controller;

use App\Entity\Address;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Order;
use App\Repository\AddressRepository;

class OrderController extends AbstractController {

    function order(){
        return $this->render('checkout.html.twig');
    }

    function createOrder(AddressRepository $addressRepository){
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->getRepository(Order::class);

        $order = new Order();

        $customer = $this -> getUser(); 
        
        $firstname = $customer -> getFirstname() ;
        $lastname = $customer -> getLastname();

        
        $order -> setCustomerIdcustomer($customer);
        $order -> setLibell("'order for'$firstname.''.$lastname");
        $order -> setPrixht($_POST["prixHT"]);
        $order -> setStatus("Non payé");
        $order -> setPrixttc($_POST["prixTTC"]);
        
        
        $order -> setAddressIdaddress();
       
        $entityManager->persist($order);
        $entityManager->flush();
       
        // dd($user);
        
        return $this  -> redirectToRoute('login');
    }


}