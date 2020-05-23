<?php 
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\RedirectController;

class HistoryController extends AbstractController {

    function history(OrderRepository $orderRepository){
    
        
      
       
       $Customer = $this -> getUser();
       $idCustomer= $Customer->getIdcustomer();

       $order = $orderRepository -> findOrderById($idCustomer);
       
          return $this->render('history.html.twig', [
            'order'=>$order
      
          ]);
          
          }
    
        
    
        
    
      }



