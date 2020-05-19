<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ManagerRegistry;
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
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

return $this->redirectToRoute('index');

        
    }

}