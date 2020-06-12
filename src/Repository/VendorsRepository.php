<?php

namespace App\Repository;

use App\Entity\Vendors;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vendors|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vendors|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vendors[]    findAll()
 * @method Vendors[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VendorsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vendors::class);
    }

    // /**
    //  * @return Vendors[] Returns an array of Vendors objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vendors
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
