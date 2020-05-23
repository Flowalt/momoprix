<?php

namespace App\Repository;
use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function findOneOrderById($value): ?array
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->andWhere('p.customerIdcustomer = :val')
            ->orderBy('p.idorder', 'DESC')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }

}

