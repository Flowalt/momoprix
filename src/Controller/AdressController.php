<?php

namespace App\Controller;
use App\Entity\Address;
use App\Entity\Customer;




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
        $customer= new Customer();
        
        $id= $_POST['Id'];

        $address-> setAddress($_POST['adresse']);
        $address -> setCity($_POST['ville']);
        $address-> setCp($_POST['cp']);
        $address->setType("livraison");
        $address->setElevator($_POST['ascenseur']);
        $address->setCustomerIdcustomer($customer->setIdcustomer($id));
       
        $entityManager->persist($address);
        $entityManager->flush();
    }
}