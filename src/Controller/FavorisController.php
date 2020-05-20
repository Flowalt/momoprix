<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Repository\FavorisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\RedirectController;

class FavorisController extends AbstractController {

    function index(){
        return $this->render('favoris.html.twig');
    }


  function addFavoris(){

  
    $Customer = $this -> getUser();
    $idCustomer= $Customer->getIdcustomer();
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $split = substr ( $url, 34, 1 );



    //$idProduct="1";
    //$idCustomer= $Customer ->          

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "intermarcher";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO favoris (customer_idcustomer, product_idproduct)
    VALUES ('$idCustomer','$split' )";



    if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
    }   else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);


      return $this->redirectToRoute('index');
  }

  function displayFavoris(){
    
    $tokenInterface = $this->get('security.token_storage')->getToken();
    $isAuthenticated = $tokenInterface->isAuthenticated();

    if($isAuthenticated == true){
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "intermarcher";
  
      // Create connection    
      $conn = mysqli_connect($servername, $username, $password, $dbname);
  
      $Customer = $this ->getUser();
      $idCustomer= $Customer->getIdcustomer();
  
      $sql = "SELECT * FROM favoris f INNER JOIN product p On p.idproduct = f.product_idproduct where f.customer_idcustomer = $idCustomer ";
  
      $result = mysqli_query($conn,$sql);
      $rows = array();
      while($r = mysqli_fetch_array($result)) {
        $rows[] = $r;
      }
      json_encode($rows);
      mysqli_close($conn);
      return $this->render('favoris.html.twig', [
        'favoris'=>$rows
  
      ]);
    
    }else{
        return  $this->redirectToRoute('login');

    }

    

  }

   



  


     

}