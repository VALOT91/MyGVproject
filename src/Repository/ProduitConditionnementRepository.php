<?php

namespace App\Repository;

use App\Entity\ProduitConditionnement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProduitConditionnement|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProduitConditionnement|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProduitConditionnement[]    findAll()
 * @method ProduitConditionnement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitConditionnementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProduitConditionnement::class);
    }

    // /**
    //  * @return ProduitConditionnement[] Returns an array of ProduitConditionnement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProduitConditionnement
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
