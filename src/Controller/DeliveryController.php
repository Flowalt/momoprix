<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\RedirectController;

class DeliveryController extends AbstractController {

    function add(OrderRepository $orderRepository, $idcustomer ){


        $adr = $_POST["Livraison"];

        //$idProduct="1";*
     
        
        $order = $orderRepository -> findOneOrderById($idcustomer);        
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "intermarcher";
        
        $now = new \DateTime();
        $now->add(new \DateInterval('P4D'));
        $date_delivery= $now->format('Y-m-d');
        
        $idd= $order[0];
        

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection

        
        
        $sql = "INSERT INTO `delivery`(`date_delivery`, `schedule`,`order_idorder`, `address_idaddress`)
        VALUES ('$date_delivery','8H-18H', '$idd', '$adr')";

        
        

        $conn->query($sql);

        
    
        mysqli_close($conn);
    
    
          
      }

}
