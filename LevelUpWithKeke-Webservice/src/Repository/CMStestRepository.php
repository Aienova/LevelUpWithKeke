<?php

namespace App\Repository;

use App\Entity\CMStest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMStest>
 *
 * @method CMStest|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMStest|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMStest[]    findAll()
 * @method CMStest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMStestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMStest::class);
    }

//    /**
//     * @return CMStest[] Returns an array of CMStest objects
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

//    public function findOneBySomeField($value): ?CMStest
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
