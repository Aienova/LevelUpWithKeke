<?php

namespace App\Repository;

use App\Entity\CMSbanner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSbanner>
 *
 * @method CMSbanner|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSbanner|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSbanner[]    findAll()
 * @method CMSbanner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSbannerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSbanner::class);
    }

//    /**
//     * @return CMSbanner[] Returns an array of CMSbanner objects
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

//    public function findOneBySomeField($value): ?CMSbanner
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
