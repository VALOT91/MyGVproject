<?php

namespace App\Repository;

use App\Entity\CommandeShopLine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommandeShopLine|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandeShopLine|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandeShopLine[]    findAll()
 * @method CommandeShopLine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeShopLineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandeShopLine::class);
    }

    // /**
    //  * @return CommandeShopLine[] Returns an array of CommandeShopLine objects
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
    public function findOneBySomeField($value): ?CommandeShopLine
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
