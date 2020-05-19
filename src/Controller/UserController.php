<?php

namespace App\Controller;

use App\Repository\CategoryRepository as RepositoryCategoryRepository;
use App\Repository\ProductRepository;
use App\Entity\Customer;
use App\Repository\AddressRepository;
use App\Repository\CustomerRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;

use Symfony\Component\HttpFoundation\Request;
//class permets l'utlisation du hashage du password 
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Doctrine\Common\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Integer;
use PhpParser\Builder\Interface_;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class UserController extends AbstractController {

    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }



    function CheckEmail():int{
        $db = mysqli_connect('localhost', 'root', '', 'intermarcher');

        if (isset($_POST['Email'])) {
            $email = $_POST['Email'];
            $sql = "SELECT * FROM customer WHERE email='$email'";
            $results = mysqli_query($db, $sql);
            $row= mysqli_num_rows($results);   
            return $row;    
        }
    }

    function registerPost(Request $request,UserPasswordEncoderInterface $passwordEncoder, ProductRepository $productRepository, RepositoryCategoryRepository $cat){
        //Data de retour dans la view
        $return = ['error'=> false, 'message'=>'' ];

        $int=0;


        //CheckEmail
        if($this-> CheckEmail()<1){
            $int++;
        }else{
            echo("Email already used");
        }
        
        //Password Match
    
  

    if($int ==1){

      //Empty area
        if($_POST){
            if(
            ( isset($_POST['Email']) || !empty(trim($_POST['Email'])))
            &&
            ( isset($_POST['Nom']) || !empty(trim($_POST['Nom'])))
            &&
            ( isset($_POST['password']) || !empty(trim($_POST['password'])))
            )
            {
                if(filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL))
                {
                    $pass="";
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->getRepository(Customer::class);
                   
                    $user = new Customer();

                    $user -> setEmail($_POST['Email']);
                    $user -> setLastname($_POST['Nom']);
                    $user -> setFirstname($_POST['Prenom']);
                    $pass= ($_POST['password']);
                    $passworEncoded = $passwordEncoder->encodePassword($user, $pass);
                    $user -> setPassword($passworEncoded);
                    
                    $entityManager->persist($user);
                    $entityManager->flush();
                    $this->session->set('id', $user->getIdcustomer());
                    // dd($user);
                    $articles=$productRepository->findAllArticle();
                    $category=$cat->findAll();
                    
                    
                    return $this->render('index.html.twig', [
                        'articles'=>$articles,
                        'category'=>$category
                       
                    ]);
                    
        
        
        
                    
                    
                    
        }else{
                echo("Merci de remplir tous les champs");
                return $this->render('signup.html.twig');
            }
            
        }
        
        }
                  
    }else{
        
        return $this->render('signup.html.twig');
    }          
        
    }
 
    function Edit(AddressRepository $adressRepository){
        $entityManager = $this->getDoctrine()->getManager();
        $customer= new Customer();

       

        $customer ->setLastname($_POST["Nom"]);
        $customer ->setFirstname($_POST["Prenom"]);
        $customer ->setEmail($_POST["Email"]);
        $customer -> setDateOfBirth($_POST["Date"]);

        $entityManager->persist($customer);
        $entityManager->flush();
        
        $address =  $adressRepository->dysplayAddressLivraisonByCustomerId(2);
        $addressFact =  $adressRepository->dysplayAddressFacturationByCustomerId(2);

        
        return $this->render('profile.html.twig',[

            'adressLivraison'=> $address,
            'adressFacturation'=> $addressFact
        ]);
        


    }

    function profile(AddressRepository $adressRepository, ProductRepository $productRepository, RepositoryCategoryRepository $cat)
    {   
        //dd($_SESSION);
       //$id = $_SESSION['_sf2_attributes']['id'];
       $customer= $this->getUser(); 
     
  

        if(empty($_SESSION['_sf2_attributes']) ){ //if login in session is not set
           // require_once('App/controller/HomeController.php'); 
           return $this->redirectToRoute('index');
        }else{

        

        
        
        $address =  $adressRepository->dysplayAddressLivraisonByCustomerId($customer->getIdcustomer());
        $addressFact =  $adressRepository->dysplayAddressFacturationByCustomerId($customer->getIdcustomer());
        
        
        return $this->render('profile.html.twig',[

            'adressLivraison'=> $address,
            'adressFacturation'=> $addressFact
        ]);
        }
        

    }
    
}

