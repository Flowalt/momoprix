<?php
namespace App\Entity;

use Doctrine\ORM\EntityRepository;

class SearchProductRepository extends EntityRepository
{
    public function findByName()
    {
        $name= $_POST['search'];
        return $this->createQueryBuilder('j')
            ->andWhere('j.name Like :name')
            ->setParameter('name','%'. $name.'%')
            ->getQuery()
            ->getResult();
 

  
    }
}