<?php

namespace App\Repository;

use App\Entity\CMSsocialmedia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSsocialmedia>
 *
 * @method CMSsocialmedia|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSsocialmedia|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSsocialmedia[]    findAll()
 * @method CMSsocialmedia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSsocialmediaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSsocialmedia::class);
    }

//    /**
//     * @return CMSsocialmedia[] Returns an array of CMSsocialmedia objects
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

//    public function findOneBySomeField($value): ?CMSsocialmedia
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
