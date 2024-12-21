<?php

namespace App\Repository;

use App\Entity\FormItemListSettings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FormItemListSettings>
 *
 * @method FormItemListSettings|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormItemListSettings|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormItemListSettings[]    findAll()
 * @method FormItemListSettings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormItemListSettingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormItemListSettings::class);
    }

//    /**
//     * @return FormItemListSettings[] Returns an array of FormItemListSettings objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FormItemListSettings
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
