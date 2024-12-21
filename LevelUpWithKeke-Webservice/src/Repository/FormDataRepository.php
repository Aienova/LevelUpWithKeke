<?php

namespace App\Repository;

use App\Entity\FormData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FormData>
 *
 * @method FormData|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormData|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormData[]    findAll()
 * @method FormData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormData::class);
    }

//    /**
//     * @return FormData[] Returns an array of FormData objects
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

//    public function findOneBySomeField($value): ?FormData
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function findByCustomerAndNotarize($customer,$notarize): array
    {
        return $this->createQueryBuilder('f')
           ->andWhere('f.customer = :customer')
           ->andWhere('f.notarize = :notarize')
          ->setParameter('notarize', $notarize)
          ->setParameter('customer', $customer)
           ->orderBy('f.id', 'ASC')
          ->getQuery()
           ->getResult()
        ;
    }


    public function findByFormAnd($form): array
    {
        return $this->createQueryBuilder('f')
           ->andWhere('f.form = :form')
          ->setParameter('form', $form)
           ->orderBy('f.id', 'ASC')
          ->getQuery()
           ->getResult()
        ;
    }
}
