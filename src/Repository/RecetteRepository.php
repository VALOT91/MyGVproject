<?php

namespace App\Repository;

use App\Entity\Recette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Search\SearchRecette;
use Doctrine\ORM\QueryBuilder;
 

/**
 * @method Recette|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recette|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recette[]    findAll()
 * @method Recette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recette::class);
    }
    public function findByFilter(SearchRecette $search)
    {
        $query = $this->findAllQuery();
        
        
        if($search->getFilterByNom())
        {
            $query = $query->andWhere('p.nom LIKE :nom');
            $query->setParameter('nom','%' . $search->getFilterByNom() . '%');
        }

        if($search->getFilterByProduct())
        {
            $query = $query
             ->innerjoin('App\Entity\Product', 'r', 'WITH','p.product=r.id') 
             ->andwhere('r.id = :product')
            ;
                            
            $query->setParameter('product', $search->getFilterByProduct()->getId());
        }

        return $query->getQuery()->getResult();
    }

    /**
     * @return QueryBuilder
     */
    public function findAllQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p');
    }
    // /**
    //  * @return Recette[] Returns an array of Recette objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Recette
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
