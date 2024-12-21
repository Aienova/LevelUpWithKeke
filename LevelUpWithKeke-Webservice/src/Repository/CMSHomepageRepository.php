<?php

namespace App\Repository;

use App\Entity\CMShomepage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMShomepage>
 *
 * @method CMShomepage|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMShomepage|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMShomepage[]    findAll()
 * @method CMShomepage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSHomepageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMShomepage::class);
    }

//    /**
//     * @return CMShomepage[] Returns an array of CMShomepage objects
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

//    public function findOneBySomeField($value): ?CMShomepage
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
