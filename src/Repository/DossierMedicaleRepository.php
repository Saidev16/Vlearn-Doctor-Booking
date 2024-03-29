<?php

namespace App\Repository;

use App\Entity\DossierMedicale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DossierMedicale|null find($id, $lockMode = null, $lockVersion = null)
 * @method DossierMedicale|null findOneBy(array $criteria, array $orderBy = null)
 * @method DossierMedicale[]    findAll()
 * @method DossierMedicale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DossierMedicaleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DossierMedicale::class);
    }

    // /**
    //  * @return DossierMedicale[] Returns an array of DossierMedicale objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DossierMedicale
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
