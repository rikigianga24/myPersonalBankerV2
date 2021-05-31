<?php

namespace App\Repository;

use App\Entity\CartaPrepagata;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method CartaPrepagata|null find($id, $lockMode = null, $lockVersion = null)
 * @method CartaPrepagata|null findOneBy(array $criteria, array $orderBy = null)
 * @method CartaPrepagata[]    findAll()
 * @method CartaPrepagata[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartaPrepagataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartaPrepagata::class);
    }

    // /**
    //  * @return CartaPrepagata[] Returns an array of CartaPrepagata objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CartaPrepagata
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
