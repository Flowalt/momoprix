<?php

namespace App\Repository;
use App\Entity\Customer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CustomerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Customer::class);
    }



public function findOneByIdJoinedToAddress()
{
    $entityManager = $this->getEntityManager();

    $query = $entityManager->createQuery(
        'SELECT p, c
        FROM App\Entity\Customer p
        INNER JOIN p.customer_idcustomer c
        WHERE c.id = :id'
    )->setParameter('id', 2);

    return $query->getOneOrNullResult();
}



}
