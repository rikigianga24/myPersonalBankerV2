<?php

namespace App\Repository;

use App\Entity\Transazione;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Transazione|null find($id, $lockMode = null, $lockVersion = null)
 * @method Transazione|null findOneBy(array $criteria, array $orderBy = null)
 * @method Transazione[]    findAll()
 * @method Transazione[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransazioneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transazione::class);
    }

    public function findAllByIban(string $iban)
    {
        return $this->createQueryBuilder('t')
            ->where('t.ibanMittente = :iban')
            ->setParameter('iban', $iban)
            ->orderBy('t.id','DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }
    //SELECT email FROM transazione INNER JOIN conto_corrente USING(iban) INNER JOIN user USING(iban) WHERE transazione.id=1
    public function findOneBySomeField($id_transazione){
        $em=$this->getEntityManager();
        $query=$em->createQuery("SELECT u.email FROM App\Entity\User u JOIN App\Entity\ContoCorrente cc WITH u.iban = cc.iban JOIN App\Entity\Transazione tr WITH cc.iban = tr.ibanMittente WHERE tr.id=$id_transazione")->setMaxResults(1);
        return array_column($query->getResult(), "email");
    }

    public function findLast($iban){
        $em=$this->getEntityManager();
        $query=$em->createQuery("SELECT u.id FROM App\Entity\Transazione u JOIN App\Entity\ContoCorrente cc WITH u.ibanMittente = cc.iban WHERE u.ibanMittente=:iban ORDER BY u.id DESC" )
        ->setParameters([
            'iban' => $iban
        ])
        ->setMaxResults(1);
        return array_column($query->getResult(), "id");
    }

    /*
    public function findOneBySomeField($value): ?Transazione
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
