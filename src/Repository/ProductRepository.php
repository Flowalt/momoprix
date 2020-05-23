<?php

namespace App\Repository;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }


    //tout afficher

    public function findAllArticle()
    {
       
        return $this->createQueryBuilder('j')
           
            ->getQuery()
            ->getResult();

    }
    
 

   //filter par nom
    public function findByName()
    {
        $name= $_POST['search'];
        return $this->createQueryBuilder('j')
            ->andWhere('j.name Like :name')
            ->setParameter('name','%'. $name.'%')
            ->getQuery()
            ->getResult();

    }

    // filtrer par prix
    public function findByPrice()
    {
        $low= $_POST['lowprice'];
        $high=$_POST['highprice'];
      
        return $this->createQueryBuilder('j')
            ->andWhere('j.price >= :low')
            ->andWhere('j.price <= :high')
            ->setParameter('low',$low)
            ->setParameter('high',$high)
            ->getQuery()
            ->getResult();

    }
    
     //filter par catégories
     public function findByCategory()
     {
        return $this->createQueryBuilder('j')
            ->andWhere('j.categoryIdcategory = :id')
            ->setParameter('id',$_POST["categories"])
            ->getQuery()
            ->getResult();

     }

}
     
     