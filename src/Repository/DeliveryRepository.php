<?php

namespace App\Repository;
use App\Entity\Delivery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DeliveryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Delivery::class);
    }

    public function findOneDeliveryById($value): ?array
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->andWhere('p.orderIdorder = :val')
            ->setParameter('val', $value)
            
            ->getQuery()
            ->getResult();
    }
}