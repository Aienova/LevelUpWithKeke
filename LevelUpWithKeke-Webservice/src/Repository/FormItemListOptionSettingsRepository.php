<?php

namespace App\Repository;

use App\Entity\FormItemListOptionSettings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FormItemListOptionSettings>
 *
 * @method FormItemListOptionSettings|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormItemListOptionSettings|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormItemListOptionSettings[]    findAll()
 * @method FormItemListOptionSettings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormItemListOptionSettingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormItemListOptionSettings::class);
    }

//    /**
//     * @return FormItemListOptionSettings[] Returns an array of FormItemListOptionSettings objects
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

//    public function findOneBySomeField($value): ?FormItemListOptionSettings
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

   public function findByList($list): array
   {
       return $this->createQueryBuilder('f')
           ->andWhere('f.formItemListSettings = :list')
            ->setParameter('list', $list)
          ->orderBy('f.id', 'ASC')
           ->getQuery()
           ->getResult()
       ;
   }
}
