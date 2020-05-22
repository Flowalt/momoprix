<?php

namespace App\Repository;
use App\Entity\Address;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AddressRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Address::class);
    }

    public function dysplayAddressLivraisonByCustomerId($id){

        return $this->createQueryBuilder('ad')
            ->where('ad.customerIdcustomer=:id')
            ->andWhere('ad.type =:liv')
            ->setParameter('id', $id)
            ->setParameter('liv', "livraison")
            ->getQuery()
            ->execute();

            
    }

    public function findOneAddressById($value): ?array
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->andWhere('p.idaddress = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }

    public function dysplayAddressFacturationByCustomerId($id){

        

        return $this->createQueryBuilder('ad')
            ->where('ad.customerIdcustomer=:id')
            ->andWhere('ad.type =:fact')
            ->setParameter('id', $id)
            ->setParameter('fact', "facturation")
            ->getQuery()
            ->execute();

            
    }

    public function findOneByIdJoinedToAddress()
{
    $entityManager = $this->getEntityManager();

    $query = $entityManager->createQuery(
        'SELECT p
        FROM App\Entity\Address p
        
        WHERE p.customerIdcustomer = :id'
    )->setParameter('id', 2);

    return $query->getOneOrNullResult();
}


  


}
