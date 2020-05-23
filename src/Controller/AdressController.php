<?php

namespace App\Controller;
use App\Entity\Address;
use App\Entity\Customer;
use Symfony\Component\Security\Core\Security;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class AdressController extends AbstractController {


    

    public function addAdress(){

        return $this->render("addAdress.html.twig");
    }

    public function addAddressDelivery(){

        $entityManager = $this->getDoctrine()->getManager();

      
       
        $address = new Address();
        $customer= $this->getUser(); 
        
        
        
        $address-> setAddress($_POST['adresse']);
        $address -> setCity($_POST['ville']);
        $address-> setCp($_POST['cp']);
        $address->setType("livraison");
        if($_POST['my-radio'] == 'oui')
        $address->setElevator(true);
        if($_POST['my-radio'] == 'non')
        $address->setElevator(false);
      
        $address->setCustomerIdcustomer($customer);
       
        $entityManager->persist($address);
        $entityManager->flush();

        return $this->redirectToRoute('profil');
    }

    public function addAddressFacturation(){

        $entityManager = $this->getDoctrine()->getManager();

      
       
        $address = new Address();
        $customer= $this->getUser(); 
        
        
        
        $address-> setAddress($_POST['adresse']);
        $address -> setCity($_POST['ville']);
        $address-> setCp($_POST['cp']);
        $address->setType("facturation");
        if($_POST['my-radio'] == 'oui')
        $address->setElevator(true);
        if($_POST['my-radio'] == 'non')
        $address->setElevator(false);
      
        $address->setCustomerIdcustomer($customer);
       
        $entityManager->persist($address);
        $entityManager->flush();

        return $this->redirectToRoute('profil');
    }
}