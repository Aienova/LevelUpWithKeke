<?php

namespace App\Repository;

use App\Entity\CMSitem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSitem>
 *
 * @method CMSitem|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSitem|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSitem[]    findAll()
 * @method CMSitem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSitemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSitem::class);
    }

//    /**
//     * @return CMSitem[] Returns an array of CMSitem objects
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

//    public function findOneBySomeField($value): ?CMSitem
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
