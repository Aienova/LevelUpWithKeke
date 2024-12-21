<?php

namespace App\Repository;

use App\Entity\CMSWebsite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSWebsite>
 *
 * @method CMSWebsite|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSWebsite|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSWebsite[]    findAll()
 * @method CMSWebsite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSWebsiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSWebsite::class);
    }

//    /**
//     * @return CMSWebsite[] Returns an array of CMSWebsite objects
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

//    public function findOneBySomeField($value): ?CMSWebsite
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
