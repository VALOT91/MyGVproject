<?php

namespace App\Repository;

use App\Entity\Tarif;
use App\Entity\Produit_conditionnement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Search\SearchTarif;
use Doctrine\ORM\QueryBuilder;
 

/**
 * @method Tarif|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tarif|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tarif[]    findAll()
 * @method Tarif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TarifRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tarif::class, Produit_conditionnement::class);
         
    }

    public function findByFilter(SearchTarif $search)
    {
        $query = $this->findAllQuery();
        // les deux requetes sont antagonistes -- priorité au filtre par produit
        if($search->getFilterByReference() && empty($search->getFilterByProduct()))
        {     
          
            $query =  $query->innerjoin('App\Entity\ProduitConditionnement', 'r', 'WITH','p.produit_conditionnement=r.id') 
                            ->andwhere('r.reference LIKE :reference');
            $query->setParameter('reference','%' . $search->getFilterByReference() . '%');

        }
        if($search->getFilterByTarifType())
        {
            $query = $query->andWhere('p.type_prix LIKE :type_prix');
            $query->setParameter('type_prix','%' . $search->getFilterByTarifType() . '%');
        }

        if($search->getFilterByProduct())
        {
            $query = $query
             ->innerjoin('App\Entity\ProduitConditionnement', 'r', 'WITH','p.produit_conditionnement=r.id') 
                           ->innerjoin('App\Entity\Product', 's', 'WITH','r.produit=s.id') 
                           ->andwhere('r.produit = :product');
                            
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
    //  * @return Tarif[] Returns an array of Tarif objects
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
    public function findOneBySomeField($value): ?Tarif
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
