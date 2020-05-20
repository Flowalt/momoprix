<?php

namespace App\Repository;
use App\Entity\Product;

use Doctrine\Common\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as ConfigurationSecurity;
use Symfony\Bridge\Doctrine\Form\Type\DoctrineType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class FavorisRepository 
{
    /*public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }*/            

    function displayFavoris(){
      
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "intermarcher";

        // Create connection    
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        
         
        $Customer = $this ->getUser();
        $idCustomer= $Customer->getIdcustomer();

        $sql = "SELECT * FROM favoris f INNER JOIN product p On p.idproduct = f.product_idproduct where f.customer_idcustomer = $idCustomer ";

        mysqli_query($conn, $sql);
        mysqli_close($conn);

     
      
        }

}


}
    

   

   
    
     

