<?php

namespace App\Repository;

use App\Entity\CMSarticleCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSarticleCategory>
 *
 * @method CMSarticleCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSarticleCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSarticleCategory[]    findAll()
 * @method CMSarticleCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSarticleCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSarticleCategory::class);
    }

//    /**
//     * @return CMSarticleCategory[] Returns an array of CMSarticleCategory objects
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

//    public function findOneBySomeField($value): ?CMSarticleCategory
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
