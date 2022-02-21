<?php

namespace App\Repository;

use App\Entity\Conditionnement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Conditionnement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Conditionnement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Conditionnement[]    findAll()
 * @method Conditionnement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConditionnementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Conditionnement::class);
    }

    // /**
    //  * @return Conditionnement[] Returns an array of Conditionnement objects
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
    public function findOneBySomeField($value): ?Conditionnement
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
