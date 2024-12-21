<?php

namespace App\Repository;

use App\Entity\CMSfontWeight;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSfontWeight>
 *
 * @method CMSfontWeight|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSfontWeight|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSfontWeight[]    findAll()
 * @method CMSfontWeight[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSfontWeightRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSfontWeight::class);
    }

//    /**
//     * @return CMSfontWeight[] Returns an array of CMSfontWeight objects
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

//    public function findOneBySomeField($value): ?CMSfontWeight
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }



    public function findByFontWeight($name): ?CMSfontWeight
    {
        return $this->createQueryBuilder('c')
           ->andWhere('c.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
