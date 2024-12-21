<?php

namespace App\Repository;

use App\Entity\FormItemSettings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FormItemSettings>
 *
 * @method FormItemSettings|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormItemSettings|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormItemSettings[]    findAll()
 * @method FormItemSettings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormItemSettingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormItemSettings::class);
    }

//    /**
//     * @return FormItemSettings[] Returns an array of FormItemSettings objects
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

//    public function findOneBySomeField($value): ?FormItemSettings
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
