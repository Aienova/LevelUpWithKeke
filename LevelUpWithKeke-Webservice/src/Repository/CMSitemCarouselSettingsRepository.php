<?php

namespace App\Repository;

use App\Entity\CMSitemCarouselSettings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSitemCarouselSettings>
 *
 * @method CMSitemCarouselSettings|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSitemCarouselSettings|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSitemCarouselSettings[]    findAll()
 * @method CMSitemCarouselSettings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSitemCarouselSettingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSitemCarouselSettings::class);
    }

//    /**
//     * @return CMSitemCarouselSettings[] Returns an array of CMSitemCarouselSettings objects
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

//    public function findOneBySomeField($value): ?CMSitemCarouselSettings
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
