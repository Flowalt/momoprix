<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\CategoryRepository as RepositoryCategoryRepository;
use App\Repository\ProductRepository;

class ProductController extends AbstractController {


    
    public function __constructor(
        Product $product
        
    ) {
        $this->product = $product;
        
    }

    function detailsbis($id){
        
        
        $article=$this->getDoctrine()->getRepository(Product::class)->find($id);
        
        
        

        return $this->render('details.html.twig',[
            'article'=> $article

        ]);
    }
    function details(){
        return $this-> render('details.html.twig');

        
    }
    
    //filtrer par prix
    function indexFilterPrice(ProductRepository $productRepository,RepositoryCategoryRepository $cat){
        
        $article=$productRepository->findByPrice();
        $category=$cat->findAll();
        
        
       
        
        return $this->render('index.html.twig', [
            'articles'=>$article,
            'category'=>$category
            
           
        ]);
    }

    function indexFilterName(ProductRepository $productRepository,RepositoryCategoryRepository $cat){
      
        //filtrer par nom
        $article = $productRepository->findByName();
        $category=$cat->findAll();

        return $this->render('index.html.twig', [
            'articles'=>$article,
            'category'=>$category
           
        ]);
        
    }
    

   
     
    

  
}

