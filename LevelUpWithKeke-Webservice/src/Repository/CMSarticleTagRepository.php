<?php

namespace App\Repository;

use App\Entity\CMSarticleTag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSarticleTag>
 *
 * @method CMSarticleTag|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSarticleTag|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSarticleTag[]    findAll()
 * @method CMSarticleTag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSarticleTagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSarticleTag::class);
    }

//    /**
//     * @return CMSarticleTag[] Returns an array of CMSarticleTag objects
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

//    public function findOneBySomeField($value): ?CMSarticleTag
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
