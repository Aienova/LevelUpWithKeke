<?php

namespace App\Repository;

use App\Entity\CMSitemBookingSettings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSitemBookingSettings>
 *
 * @method CMSitemBookingSettings|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSitemBookingSettings|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSitemBookingSettings[]    findAll()
 * @method CMSitemBookingSettings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSitemBookingSettingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSitemBookingSettings::class);
    }

//    /**
//     * @return CMSitemBookingSettings[] Returns an array of CMSitemBookingSettings objects
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

//    public function findOneBySomeField($value): ?CMSitemBookingSettings
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
