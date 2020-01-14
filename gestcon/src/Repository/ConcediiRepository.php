<?php

namespace App\Repository;

use App\Entity\Concedii;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Concedii|null find($id, $lockMode = null, $lockVersion = null)
 * @method Concedii|null findOneBy(array $criteria, array $orderBy = null)
 * @method Concedii[]    findAll()
 * @method Concedii[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConcediiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Concedii::class);
    }

    // /**
    //  * @return Concedii[] Returns an array of Concedii objects
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
    public function findOneBySomeField($value): ?Concedii
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
