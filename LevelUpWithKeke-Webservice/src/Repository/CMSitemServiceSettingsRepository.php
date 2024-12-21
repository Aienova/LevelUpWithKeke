<?php

namespace App\Repository;

use App\Entity\CMSitemServiceSettings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSitemServiceSettings>
 *
 * @method CMSitemServiceSettings|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSitemServiceSettings|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSitemServiceSettings[]    findAll()
 * @method CMSitemServiceSettings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSitemServiceSettingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSitemServiceSettings::class);
    }

//    /**
//     * @return CMSitemServiceSettings[] Returns an array of CMSitemServiceSettings objects
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

//    public function findOneBySomeField($value): ?CMSitemServiceSettings
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
