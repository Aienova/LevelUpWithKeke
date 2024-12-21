<?php

namespace App\Repository;

use App\Entity\CMSpayment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSpayment>
 *
 * @method CMSpayment|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSpayment|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSpayment[]    findAll()
 * @method CMSpayment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSpaymentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSpayment::class);
    }

//    /**
//     * @return CMSpayment[] Returns an array of CMSpayment objects
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

//    public function findOneBySomeField($value): ?CMSpayment
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
