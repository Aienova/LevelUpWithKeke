<?php

namespace App\Repository;

use App\Entity\CMSmenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSmenu>
 *
 * @method CMSmenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSmenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSmenu[]    findAll()
 * @method CMSmenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSmenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSmenu::class);
    }

//    /**
//     * @return CMSmenu[] Returns an array of CMSmenu objects
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

//    public function findOneBySomeField($value): ?CMSmenu
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
