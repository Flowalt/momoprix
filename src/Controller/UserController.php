<?php

namespace App\Controller;

use App\Entity\Customer;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


use Symfony\Component\HttpFoundation\Request;
//class permets l'utlisation du hashage du password 
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Doctrine\Common\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Integer;
use PhpParser\Builder\Interface_;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController {

    

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

    function registerPost(Request $request,UserPasswordEncoderInterface $passwordEncoder){
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
    
        /*if($_POST){
        if(($_POST['password']!= $_POST['repassword'])){
            echo("Oops! Password did not match! Try again.");
        }else{
            $int++;
        }  
    }*/

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
                    // dd($user);
                    return $this->render('index.html.twig');
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



    /*public function loginPost(Request $request,UserPasswordEncoderInterface $passwordEncoder)
    {
        if($_POST){
            
            $user = new Customer();
            $pass= ($_POST['password']);
            $email= ($_POST['Email']);
        
        
            $passworEncoded = $passwordEncoder->isPasswordValid($user, $pass);
            echo($passworEncoded." , " .$email);
            $conn = mysqli_connect("localhost","root","","intermarcher");
            $result = mysqli_query($conn,"SELECT * FROM customer WHERE email='".$email."'and password='".$passworEncoded."' ");
            $count  = mysqli_num_rows($result);
            
            if($count==0) {
                $message = "Invalid Username or Password!";
                echo($message);
                return $this->render('login.html.twig');
            } else {
                $message = "You are successfully authenticated!";
                echo($message);
                return $this->render('index.html.twig');
            }
        
        }
    }*/

    
    
    function profile()
    {
    
    }
    
}

