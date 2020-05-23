<?php

namespace App\Controller;

use App\Entity\Address;
use App\Controller\Delivery;
use App\Entity\Delivery as EntityDelivery;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Order;
use App\Repository\AddressRepository;
use App\Repository\DeliveryRepository;
use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class OrderController extends AbstractController {

    function order(OrderRepository $orderRepository, DeliveryRepository $deli){
        
        $customer = $this -> getUser();
        $idcustomer = $customer -> getIdcustomer();
        $order = $orderRepository -> findOneOrderById($idcustomer);
        $idorder= $order[0];
       
        $delir = $deli -> findOneDeliveryById($order[0]);
       
        
        return $this->render('payement.html.twig',[

            'order'=> $idorder,
            'delivery'=> $delir[0]
        ]);
    }

    function createOrder(AddressRepository $addressRepository, OrderRepository $orders, SessionInterface $session){
        
      
        
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

        
        
        $delivery = new DeliveryController();
        $delivery -> add($orders, $customer ->getIdcustomer());

        
        unset($_SESSION['_sf2_attributes']['panier']);
        return $this  -> redirectToRoute('order');
    }


}