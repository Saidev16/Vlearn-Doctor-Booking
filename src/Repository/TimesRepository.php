<?php

namespace App\Repository;

use App\Entity\Times;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Times|null find($id, $lockMode = null, $lockVersion = null)
 * @method Times|null findOneBy(array $criteria, array $orderBy = null)
 * @method Times[]    findAll()
 * @method Times[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TimesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Times::class);
    }

    // /**
    //  * @return Times[] Returns an array of Times objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Times
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
