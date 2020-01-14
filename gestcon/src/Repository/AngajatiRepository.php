<?php

namespace App\Repository;

use App\Entity\Angajati;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Angajati|null find($id, $lockMode = null, $lockVersion = null)
 * @method Angajati|null findOneBy(array $criteria, array $orderBy = null)
 * @method Angajati[]    findAll()
 * @method Angajati[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AngajatiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Angajati::class);
    }

    // /**
    //  * @return Angajati[] Returns an array of Angajati objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Angajati
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
