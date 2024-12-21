<?php

namespace App\Repository;

use App\Entity\CMSjobOffer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSjobOffer>
 *
 * @method CMSjobOffer|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSjobOffer|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSjobOffer[]    findAll()
 * @method CMSjobOffer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSjobOfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSjobOffer::class);
    }

//    /**
//     * @return CMSjobOffer[] Returns an array of CMSjobOffer objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CMSjobOffer
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function findByTag($tag): ?CMSjobOffer
    {
       return $this->createQueryBuilder('c')
           ->andWhere('c.tag = :tag')
           ->setParameter('tag', $tag)
           ->getQuery()
           ->getOneOrNullResult()
       ;
    }

}
