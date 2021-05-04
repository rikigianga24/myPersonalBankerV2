<?php

namespace App\Repository;

use App\Entity\ContoCorrente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContoCorrente|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContoCorrente|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContoCorrente[]    findAll()
 * @method ContoCorrente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContoCorrenteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContoCorrente::class);
    }

    // /**
    //  * @return ContoCorrente[] Returns an array of ContoCorrente objects
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
    public function findOneBySomeField($value): ?ContoCorrente
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
