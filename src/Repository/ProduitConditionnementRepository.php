<?php

namespace App\Repository;

use App\Entity\ProduitConditionnement;
use Doctrine\Persistence\ManagerRegistry;
use App\Search\SearchProductConditionnement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;

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

   
    public function findByFilter(SearchProductConditionnement $search)
    {
        $query = $this->findAllQuery();  // cree la requete avec l'alias p

        if($search->getFilterByReference())   // y at-il du texte dans le filtre ???
        {
            $query = $query->andWhere('p.reference LIKE :reference');
            $query->setParameter('reference','%' . $search->getFilterByreference() . '%');
        }

        if($search->getFilterByProduct())
        {
            $query = $query->andWhere('p.produit = :produit');
            $query->setParameter('produit', $search->getFilterByProduct()->getId());
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
