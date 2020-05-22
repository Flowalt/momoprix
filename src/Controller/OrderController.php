<?php

namespace App\Controller;

use App\Entity\Address;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Order;
use App\Repository\AddressRepository;
use Symfony\Component\Validator\Constraints\DateTime;

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
        $order -> setLibell("commande pour $firstname $lastname");
        $order -> setPrixht($_POST["prixHT"]);
        $order -> setStatus("Non payer");
        $order -> setPrixttc($_POST["prixTTC"]);
        $order -> setDateOrder(new \DateTime());
        $address =  $addressRepository-> findOneAddressById($_POST["Facturation"]);
        $order -> setAddressIdaddress($address[0]);

        $entityManager->persist($order);
        $entityManager->flush();

        return $this  -> redirectToRoute('login');
    }


}